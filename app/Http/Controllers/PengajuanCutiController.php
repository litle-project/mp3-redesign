<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\User;
use App\Models\PengajuanCuti;
use App\Models\PersetujuanCuti;
use Exception;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Milon\Barcode\DNS1D;

class PengajuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Data Pengajuan Cuti';
        $data['pengajuan_cutis'] = PengajuanCuti::
            where('user_id',Auth::user()->id)
            ->orwhereHas('persetujuanCutiDetail')
            ->orderBy('id', 'desc')->get();
        return view('pengajuan-cuti.index', $data);
    }
    public function approval()
    {
        $data['page_title'] = 'Data Approval Cuti';
        $data['pengajuan_cutis'] = PengajuanCuti::orderBy('id', 'desc')->get();
        return view('pengajuan-cuti.index', $data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Data Pengajuan Cuti';
        $data['users'] = User::get();
        return view('pengajuan-cuti.create', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // --- BAGIAN VALIDASI
        $messages = [];

        $request->validate([
            'perihal_cuti' => 'required',
        ], $messages);

        if(Auth::user()->role_atasan_name == '' ){
            return redirect()->route('pengajuan-cuti.index')->with(['failed' => 'Anda tidak memiliki atasan langsung']);
        }

        try {

            DB::beginTransaction();
            $pengajuan_cuti = new PengajuanCuti();
            $pengajuan_cuti->nomor_permohonan = $this->generateNomor();
            $pengajuan_cuti->perihal_cuti = $request->perihal_cuti;
            $pengajuan_cuti->tanggal_mulai_cuti = $request->tanggal_mulai_cuti;
            $pengajuan_cuti->tanggal_selesai_cuti = $request->tanggal_selesai_cuti;
            $pengajuan_cuti->alamat_pemohon = $request->alamat_pemohon;
            $pengajuan_cuti->nomor_telepon_darurat = $request->nomor_telepon_darurat;
            $pengajuan_cuti->status = 'Dalam Proses';
            $pengajuan_cuti->user_id = Auth::user()->id;
            $pengajuan_cuti->keterangan = $request->keterangan;
            $pengajuan_cuti->total_hari_cuti = $request->total_hari_cuti;
            $pengajuan_cuti->save();

            // --- BUAT APPROVAL KE ATASAN LANGSUNG
            $persetujuanCuti['timestamp'] = date('Y-m-d H:i:s');
            $persetujuanCuti['pengajuan_cuti_id'] = $pengajuan_cuti->id;
            $persetujuanCuti['position'] = 'Atasan Langsung';
            $persetujuanCuti['role_to_name'] = Auth::user()->role_atasan_name;
            $persetujuanCuti['role_to_id'] = null;
            $persetujuanCuti['status'] = 'Pending';
            $persetujuanCuti['keterangan'] = $request->keterangan;
            $persetujuanCuti['user_id'] = Auth::user()->id;
            $persetujuanCuti['title'] = 'Cuti telah diajukan menunggu persetujuan atasan langsung';
            $persetujuanCuti['type'] = '';

            PersetujuanCuti::create($persetujuanCuti);
            DB::commit();
            return redirect()->route('pengajuan-cuti.index')->with(['success' => 'Cuti Anda Telah Berhasil Diajukan, Harap Menunggu Untuk Proses Persetujuan Cuti !']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('pengajuan-cuti.index')->with(['failed' => $e->getMessage()]);
        }
    }


    public function review($id)
    {
        $data['page_title'] = 'PERMOHONAN CUTI';
        $data['users'] = User::get();
        $data['data'] = PengajuanCuti::find($id);
        $data['data_cuti'] = Cuti::latest()->first();

        $batasCuti = Cuti::latest()->first()->batas_cuti ?? 0;
        $cutiDisetujui = PengajuanCuti::where('user_id', $data['data']->user_id)->where('status', 'Disetujui')->get()->sum('total_hari_cuti');
        $data['sisa_cuti'] = $batasCuti - $cutiDisetujui;
        $data['kedisiplinan_pegawai'] = 100;
        return view('pengajuan-cuti.review', $data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Tambah Data Pengajuan Cuti';
        $data['user'] = User::get();
        return view('pengajuan-cuti.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function suratIzinPdf(Request $request, $id)
    {
        $data['title'] = 'Surat Izin Cuti';

        $pengajuanCuti = PengajuanCuti::where('id', $id)
            ->first();
        $data['data'] = $pengajuanCuti;
        // if ($request->v == 'html') {
            // return view('pdf.surat-izin-cuti', $data);
            // }
            // dd($data);

        $pdf = PDF::loadView('pdf.surat-izin-cuti', $data)->setOptions(['isRemoteEnabled' => true])->setPaper('a4', 'potrait');
        return $pdf->stream($pengajuanCuti->nomor_permohonan . ' (Suart Izin Cuti).pdf');
    }

    private function generateNomor()
    {
        $bulanRomawi = $this->getRomawi(date('m'));
        $year_now = date('Y');

        $obj = DB::table('pengajuan_cutis')
        ->select('nomor_permohonan')
        ->latest('id')
            ->where('nomor_permohonan', 'ilike', '%/' . $bulanRomawi . '/' . $year_now . '%')
            ->first();
        if ($obj) {
            $increment = explode('/', $obj->nomor_permohonan);
            $increment = explode('/', $increment[0]);
            $generateOrder_nr = str_pad($increment[0] + 1, 3, "0", STR_PAD_LEFT) . '/MP3/Cuti/' . $bulanRomawi . '/' . $year_now;
        } else {
            $generateOrder_nr = str_pad(1, 3, "0", STR_PAD_LEFT) . '/MP3/Cuti/' . $bulanRomawi . '/' . $year_now;
        }
        return $generateOrder_nr;
    }

    private function getRomawi($bln)
    {
        switch ($bln) {
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }
}
