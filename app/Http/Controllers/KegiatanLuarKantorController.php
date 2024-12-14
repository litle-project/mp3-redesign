<?php

namespace App\Http\Controllers;

use App\Models\ApprovalKegiatanLuarKantor;
use App\Models\DokumenPendukungKegiatanLuarKantor;
use App\Models\KegiatanLuarKantor;
use App\Models\PersonilLuarKantor;
use App\Models\TambahJamKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KegiatanLuarKantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Kegiatan Luar Kantor';
        $kegiatanLuarKantor = KegiatanLuarKantor::orderBy('id','desc');

        if($request->get('select_period') == 'bulan'){
            if ($request->get('select_month') == "all") {
                $kegiatanLuarKantor = $kegiatanLuarKantor->where('created_at', 'like', $request->get('select_year').'%');
            }else{
                $kegiatanLuarKantor = $kegiatanLuarKantor->where('created_at', 'like', $request->get('select_year').'-'.$request->get('select_month').'%');
            }
        }else if($request->get('select_period') == 'tahun'){
            $kegiatanLuarKantor = $kegiatanLuarKantor->where('created_at', 'like', $request->get('select_year').'%');
        } else {
            $kegiatanLuarKantor = $kegiatanLuarKantor;
        }

        $data['data'] = $kegiatanLuarKantor->get();



        return view('kegiatan-luar-kantor.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Buat Kegiatan Luar Kantor';
        return view('kegiatan-luar-kantor.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $kegiatanLuarKantor['nomor_surat'] =$this->generateNomorSurat();
            $kegiatanLuarKantor['timestamp'] =date('Y-m-d H:i:s');

            $kegiatanLuarKantor['perihal'] = $request->perihal;
            $kegiatanLuarKantor['personil_yang_ditugaskan'] = $request->personil_yang_ditugaskan;
            $kegiatanLuarKantor['urgensi'] = $request->urgensi;
            $kegiatanLuarKantor['tanggal_kegiatan'] = date('Y-m-d');

            $kegiatanLuarKantor['jam_mulai_kegiatan'] = $request->jam_mulai_kegiatan;
            $kegiatanLuarKantor['jam_selesai_kegiatan'] = $request->jam_selesai_kegiatan;
            $kegiatanLuarKantor['total_jam'] = $this->totalHour($request->jam_selesai_kegiatan, $request->jam_mulai_kegiatan);
            $kegiatanLuarKantor['entitas'] = $request->entitas;
            $kegiatanLuarKantor['entitas_alamat'] = $request->entitas_alamat;
            $kegiatanLuarKantor['user_id'] = Auth::user()->id;
            $kegiatanLuarKantor['status'] = 'Dalam Proses';
            $kegiatanLuarKantor['keterangan'] =$request->keterangan;

            $kegiatanLuarKantor = KegiatanLuarKantor::create($kegiatanLuarKantor);

            if ($request->personil_yang_ditugaskan == 'Pilih Personil') {
                $personilIds = [];
                foreach ($request->personil_id as $key => $pi) {
                    $personilIds[] = [
                        'kegiatan_luar_kantor_id' => $kegiatanLuarKantor->id,
                        'pegawai_id' => $pi,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                }
                PersonilLuarKantor::insert($personilIds);
            }

            // Upload Multiple Dokumen Pendukung
            if ($request->dokumen_pendukung) {
                foreach ($request->dokumen_pendukung as $key => $filePendukung) {
                    // --- UPLOAD FILE
                    $file = $filePendukung;
                    $formatFilePendukung = $key . '_' . Auth::user()->id . '_' . $kegiatanLuarKantor->id . '_' . time() . '_' . bin2hex(random_bytes(5)) . '_DOKUMENPENDUKUNG';
                    $name = $formatFilePendukung . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('dokumen-kegiatan-luar-kantor/');
                    $file->move($destinationPath, $name);
                    $dataFilePendukung['file_name'] = $name;

                    // --- INSERT FILE
                    $dataFilePendukung['original_file_name'] = $file->getClientOriginalName();
                    $dataFilePendukung['kegiatan_luar_kantor_id'] = $kegiatanLuarKantor->id;
                    $dataFilePendukung['user_id'] = Auth::user()->id;
                    DokumenPendukungKegiatanLuarKantor::create($dataFilePendukung);
                }
            }

            // Check Apakah Kegiatan Untuk Atasan Atau Bawahan
            if ($request->personil_yang_ditugaskan == 'Pilih Personil') {
                // UNTUK BAWAHAN TANPA APPROVAL
                KegiatanLuarKantor::where('id',$kegiatanLuarKantor->id)
                    ->update([
                        'status'=>'Disetujui',
                        'posisi' => 'Valid'
                    ]);

            }else{
                // MINTA APPROVAL KE ATASAN LANGSUNG
                $approvalKL['timestamp'] = date("Y-m-d H:i:s");
                $approvalKL['persetujuan'] = $request->persetujuan;
                $approvalKL['arahan'] = $request->arahan;
                $approvalKL['kegiatan_luar_kantor_id'] = $kegiatanLuarKantor->id;
                $approvalKL['position'] = "Atasan Langsung";
                $approvalKL['role_to_name'] = Auth::user()->role_atasan_name;
                $approvalKL['role_to_id'] = null;
                $approvalKL['status'] = 'Pending';
                $approvalKL['user_id'] = Auth::user()->id;
                $approvalKL['type'] = 'Atasan Langsung';
                $approvalKL['title'] = 'Kegiatan Luar Kantor Telah diajukan ke Atasan Langsung';
                ApprovalKegiatanLuarKantor::create($approvalKL);
                KegiatanLuarKantor::where('id', $kegiatanLuarKantor->id)
                    ->update([
                        'status' => 'Disetujui',
                        'posisi' => 'Atasan Langsung'
                    ]);

            }

            DB::commit();
            return redirect()->route('master-data.kegiatan-luar-kantor.index')->with(['success' => 'Kegiatan Luar Kantor berhasil dibuat !']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('master-data.kegiatan-luar-kantor.index')->with(['failed' => $th->getMessage()]);
        }

    }


    private function totalHour($t1, $t2){
        $t1 = strtotime(date('Y-m-d ').$t1.':00');
        $t2 = strtotime(date('Y-m-d ').$t2.':00');
        $diff = $t1 - $t2;
        return $hours = $diff / (60 * 60);
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
        //
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

    public function review($id)
    {
        $data['page_title'] = 'KEGIATAN LUAR KANTOR';
        $data['data'] = KegiatanLuarKantor::find($id);

        return view('kegiatan-luar-kantor.review', $data);
    }

    public function approvalAtasanLangsung(Request $request,$id)
    {
        try {
            DB::beginTransaction();
            if ($request->persetujuan == 'Tolak') {
                $approvalKL['timestamp'] = date("Y-m-d H:i:s");
                $approvalKL['persetujuan'] = $request->persetujuan;
                $approvalKL['arahan'] = $request->arahan;
                $approvalKL['kegiatan_luar_kantor_id'] = $id;
                $approvalKL['position'] = "Tolak";
                $approvalKL['role_to_name'] = "";
                $approvalKL['role_to_id'] = null;
                $approvalKL['status'] = 'Done';
                $approvalKL['user_id'] = Auth::user()->id;
                $approvalKL['type'] = 'Tolak';
                $approvalKL['title'] = 'Kegiatan Luar Kantor Telah Ditolak ' . Auth::user()->roles->first->name ?? null;
                ApprovalKegiatanLuarKantor::create($approvalKL);

                KegiatanLuarKantor::where('id', $id)
                    ->update([
                        'status' => 'Ditolak',
                        'posisi' => 'Tolak'
                    ]);

            } elseif ($request->persetujuan == 'Setuju'){
                // MINTA APPROVAL KE ATASAN LANGSUNG
                $approvalKL['timestamp'] = date("Y-m-d H:i:s");
                $approvalKL['persetujuan'] = $request->persetujuan;
                $approvalKL['arahan'] = $request->arahan;
                $approvalKL['kegiatan_luar_kantor_id'] = $id;
                $approvalKL['position'] = "Kepala Distrik Navigasi";
                $approvalKL['role_to_name'] = "Kepala Distrik Navigasi";
                $approvalKL['role_to_id'] = null;
                $approvalKL['status'] = 'Pending';
                $approvalKL['user_id'] = Auth::user()->id;
                $approvalKL['type'] = 'Kepala Distrik Navigasi';
                $approvalKL['title'] = 'Kegiatan Luar Kantor Telah diajukan ke Kepala Distrik Navigasi';
                ApprovalKegiatanLuarKantor::create($approvalKL);

                KegiatanLuarKantor::where('id', $id)
                    ->update([
                        'status' => 'Dalam Proses',
                        'posisi' => 'Kepala Distrik Navigasi'
                    ]);
            }else{
                dd('INVALID !', $request->persetujuan);
            }

            DB::commit();
            return redirect()->route('master-data.kegiatan-luar-kantor.index')->with(['success' => 'Tindak Lanjut Berhasil !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('master-data.kegiatan-luar-kantor.index')->with(['failed' => $th->getMessage()]);
        }

    }

    public function approvalKadisnav(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            if ($request->persetujuan == 'Tolak') {
                $approvalKL['timestamp'] = date("Y-m-d H:i:s");
                $approvalKL['persetujuan'] = $request->persetujuan;
                $approvalKL['arahan'] = $request->arahan;
                $approvalKL['kegiatan_luar_kantor_id'] = $id;
                $approvalKL['position'] = "Tolak";
                $approvalKL['role_to_name'] = "";
                $approvalKL['role_to_id'] = null;
                $approvalKL['status'] = 'Done';
                $approvalKL['user_id'] = Auth::user()->id;
                $approvalKL['type'] = 'Tolak';
                $approvalKL['title'] = 'Kegiatan Luar Kantor Telah Ditolak ' . Auth::user()->roles->first->name ?? null;
                ApprovalKegiatanLuarKantor::create($approvalKL);

                KegiatanLuarKantor::where('id', $id)
                    ->update([
                        'status' => 'Ditolak',
                        'posisi' => 'Tolak'
                    ]);
            } elseif ($request->persetujuan == 'Setuju') {
                // MINTA APPROVAL KE ATASAN LANGSUNG
                $approvalKL['timestamp'] = date("Y-m-d H:i:s");
                $approvalKL['persetujuan'] = $request->persetujuan;
                $approvalKL['arahan'] = $request->arahan;
                $approvalKL['kegiatan_luar_kantor_id'] = $id;
                $approvalKL['position'] = "Kepala Distrik Navigasi";
                $approvalKL['role_to_name'] = "";
                $approvalKL['role_to_id'] = null;
                $approvalKL['status'] = 'Pending';
                $approvalKL['user_id'] = Auth::user()->id;
                $approvalKL['type'] = 'Kepala Distrik Navigasi';
                $approvalKL['title'] = 'Kegiatan Luar Kantor Telah disetujui Kepala Distrik Navigasi';
                ApprovalKegiatanLuarKantor::create($approvalKL);

                KegiatanLuarKantor::where('id', $id)
                    ->update([
                        'status' => 'Disetujui',
                        'posisi' => 'Valid'
                    ]);
            } else {
                dd('INVALID !', $request->persetujuan);
            }

            DB::commit();
            return redirect()->route('master-data.kegiatan-luar-kantor.index')->with(['success' => 'Tindak Lanjut Berhasil !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('master-data.kegiatan-luar-kantor.index')->with(['failed' => $th->getMessage()]);
        }
    }

    public function tambahJam(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $tambahanJam['tambahan_jam'] =$request->tambahan_jam;
            $tambahanJam['keterangan'] =$request->keterangan;
            $tambahanJam['kegiatan_luar_kantor_id']= $id;
            $tambahanJam['user_id'] =Auth::user()->id;
            $tambahanJam['title'] ='Menunggu Approval Atasan Langsung';
            $tambahanJam['status'] ='pending';
            $tambahanJam['role_to_name'] = Auth::user()->role_atasan_name;
            $tambahanJam['role_to_id'] = null;
            TambahJamKegiatan::create($tambahanJam);
            DB::commit();
            return redirect()->back()->with(['success' => 'Pengajuan Tambahan Jam Berhasil !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }
    public function tambahJamApprove(Request $request, $id)
    {
        try {
            DB::beginTransaction();
                $tambahanJam['tambahan_jam'] =$request->tambahan_jam;
                $tambahanJam['title'] ='Pengajuan Tambahan Jam Disetujui';
                $tambahanJam['status'] ='done';
                $tambahanJam['approve_by'] =Auth::user()->id;
                TambahJamKegiatan::where('id',$id)
                    ->update($tambahanJam);
            DB::commit();
            return redirect()->back()->with(['success' => 'Pengajuan Tambahan Jam Disetujui !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }
    public function tambahJamReject(Request $request, $id)
    {
        try {
            DB::beginTransaction();
                $tambahanJam['title'] ='Pengajuan Tambahan Jam Ditolak';
                $tambahanJam['status'] ='reject';
                $tambahanJam['approve_by'] = Auth::user()->id;
                TambahJamKegiatan::where('id',$id)
                    ->update($tambahanJam);
            DB::commit();
            return redirect()->back()->with(['success' => 'Pengajuan Tambahan Jam Ditolak !']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }

    private function generateNomorSurat()
    {
        $bulanRomawi = $this->getRomawi(date('m'));
        $year_now = date('Y');

        $obj = DB::table('kegiatan_luar_kantor')
            ->select('nomor_surat')
            ->latest('id')
            ->where('nomor_surat', 'ilike', '%/' . $bulanRomawi . '/' . $year_now . '%')
            ->first();
        if ($obj) {
            $increment = explode('/', $obj->nomor_surat);
            $increment = explode('/', $increment[0]);
            $generateOrder_nr = str_pad($increment[0] + 1, 3, "0", STR_PAD_LEFT) . '/MP3/KLK/' . $bulanRomawi . '/' . $year_now;
        } else {
            $generateOrder_nr = str_pad(1, 3, "0", STR_PAD_LEFT) . '/MP3/KLK/' . $bulanRomawi.'/'.$year_now;
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
