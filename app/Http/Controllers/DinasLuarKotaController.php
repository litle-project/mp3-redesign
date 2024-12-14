<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDinasLuarKota;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DinasLuarKotaController extends Controller
{
    public function index(Request $request){
        $data['page_title'] = 'Dinas Luar Kota';
        $getDataDinas = TransaksiDinasLuarKota::orderBy('created_at', 'DESC')->where('created_by', Auth::user()->name)->get()->pluck('created_by');
        $getDataNotif = $data['dinas_luar_kota'] = TransaksiDinasLuarKota::whereHas('PegawaiDinasLuarKota', function($q){
                            $q->where('user_id', Auth::user()->id);
                        })->orderBy('id', 'desc')->get();
        $data['notif'] = '';

        if (Auth::user()->name == 'Admin' || Auth::user()->name == 'kadisnav') {
            $dinaslLuarKota = TransaksiDinasLuarKota::orderBy('created_at', 'DESC');
            if($request->get('select_period') == 'bulan'){
                if ($request->get('select_month') == "all") {
                    $dinaslLuarKota = $dinaslLuarKota->where('created_at', 'like', $request->get('select_year').'%');
                }else{
                    $dinaslLuarKota = $dinaslLuarKota->where('created_at', 'like', $request->get('select_year').'-'.$request->get('select_month').'%');
                }
            }else if($request->get('select_period') == 'tahun'){
                $dinaslLuarKota = $dinaslLuarKota->where('created_at', 'like', $request->get('select_year').'%');
            } else {
                $dinaslLuarKota = $dinaslLuarKota;
            }

            $data['dinas_luar_kota'] = $dinaslLuarKota->get();

        } else if($getDataDinas->count() > 0){
            $dinaslLuarKota1 = TransaksiDinasLuarKota::whereHas('PegawaiDinasLuarKota', function($q){
                $q->where('user_id', );
            })->orWhereIn('created_by', $getDataDinas)->orderBy('id', 'desc');

            if($request->get('select_period') == 'bulan'){
                if ($request->get('select_month') == "all") {
                    $dinaslLuarKota1 = $dinaslLuarKota1->where('created_at', 'like', $request->get('select_year').'%');
                }else{
                    $dinaslLuarKota1 = $dinaslLuarKota1->where('created_at', 'like', $request->get('select_year').'-'.$request->get('select_month').'%');
                }
            }else if($request->get('select_period') == 'tahun'){
                $dinaslLuarKota1 = $dinaslLuarKota1->where('created_at', 'like', $request->get('select_year').'%');
            } else {
                $dinaslLuarKota1 = $dinaslLuarKota1;
            }

            
            if ($getDataNotif->count() > 0) {
                $data['notif'] = 'ON';
            }else{
                $data['notif'] = '';
            }

            $data['dinas_luar_kota'] = $dinaslLuarKota1->get();
        }else{
            $dinaslLuarKota2 = TransaksiDinasLuarKota::whereHas('PegawaiDinasLuarKota', function($q){
                $q->where('user_id', Auth::user()->id);
            })->orderBy('id', 'desc');

            if($request->get('select_period') == 'bulan'){
                if ($request->get('select_month') == "all") {
                    $dinaslLuarKota2 = $dinaslLuarKota2->where('created_at', 'like', $request->get('select_year').'%');
                }else{
                    $dinaslLuarKota2 = $dinaslLuarKota2->where('created_at', 'like', $request->get('select_year').'-'.$request->get('select_month').'%');
                }
            }else if($request->get('select_period') == 'tahun'){
                $dinaslLuarKota2 = $dinaslLuarKota2->where('created_at', 'like', $request->get('select_year').'%');
            } else {
                $dinaslLuarKota2 = $dinaslLuarKota2;
            }

            if ($getDataNotif->count() > 0) {
                $data['notif'] = 'ON';
            }else{
                $data['notif'] = '';
            }

            $data['dinas_luar_kota'] = $dinaslLuarKota2->get();

        }

        $data['user_count'] = User::where('role_atasan_name', Auth::user()->getRoleNames()[0])->get()->count();
        return view('dinas-luar-kota.index', $data);
    }

    public function create(){
        $data['page_title'] = 'Dinas Luar Kota';
        $getIdUser = User::get()->pluck('id');

        // Check Role User
        $roleUserNow = strtolower(Auth::user()->getRoleNames()[0]);
        if ($roleUserNow == 'kadisnav') {
            $data['users'] = User::whereDoesntHave('PegawaiDinasLuarKota',function($q) use($getIdUser){
                $q->whereIn('user_id', $getIdUser);
            })->get();
        }else{
            $data['users'] = User::whereDoesntHave('PegawaiDinasLuarKota',function($q) use($getIdUser){
                $q->whereIn('user_id', $getIdUser);
            })->where('role_atasan_name', Auth::user()->getRoleNames()[0])->get();
        }

        return view('dinas-luar-kota.create', $data);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'perihal' => 'required',
            'tanggal_mulai_dinas' => 'required',
            'tanggal_selesai_dinas' => 'required',
            'kota_kedinasan' => 'required',
            'user_id' => 'nullable',
            'filename.*' => ['mimes:pdf,word,docx,ppt,pptx,csv,xlsx,jpeg,png,jpg,gif,svg', 'max:15000', 'nullable'],
            'alamat_kedinasan' => 'nullable',
            'keterangan' => 'nullable',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
        ]);

        try {
            DB::beginTransaction();

            $dinas_luar = new TransaksiDinasLuarKota();
            $dinas_luar->no_surat = $this->noSurat();
            $dinas_luar->perihal_dinas = $validateData['perihal'];
            $dinas_luar->tanggal_mulai_dinas = $validateData['tanggal_mulai_dinas'];
            $dinas_luar->tanggal_selesai_dinas = $validateData['tanggal_selesai_dinas'];
            $dinas_luar->kota_kedinasan = $validateData['kota_kedinasan'];
            $dinas_luar->alamat_kedinasan = $validateData['alamat_kedinasan'];
            $dinas_luar->keterangan = $validateData['keterangan'];
            $dinas_luar->longitude = $validateData['longitude'];
            $dinas_luar->latitude = $validateData['latitude'];
            $dinas_luar->created_by = Auth::user()->name;
            $dinas_luar->save();

            $dinas_luar->Users()->attach($validateData['user_id']);

            // check supporting document file
            if ($request->hasFile('filename')) {
                $documents = [];

                foreach ($request->file('filename') as $file) { 
                    $name = $file->getClientOriginalName();

                    // check duplicate name
                    $i = 1;
                    while(file_exists('dokumen/dokumen-dinas-luar/'.$name))
                    {           
                        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)."($i).".$file->getClientOriginalExtension();
                        $i++;
                    }
                    $destinationPath = public_path('dokumen/dokumen-dinas-luar/');
                    $file->move($destinationPath, $name);
                    
                    //set calibration data
                    $documents[] = [
                        'filename' => $name ?? null,
                        'dinas_luar_id' => $dinas_luar->id ?? null,
                        'created_at' => date('Y-m-d H:i:s')
                    ];

                }

                //save calibration
                $dinas_luar->dokumenDinasLuarKotas()->insert($documents);
            }
            
            DB::commit();
            return redirect()->route('dinas-luar-kota.index')->with(['success' => 'Data berhasil dibuat !']);

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('dinas-luar-kota.index')->with(['failed' => $e->getMessage()]);
        }
    }
    public function show($id){
        $data['page_title'] = 'Review Perintah Dinas';
        $data['data'] = TransaksiDinasLuarKota::findOrFail($id);

        return view('dinas-luar-kota.review', $data);
    }

    public function noSurat()
    {
        $year = date('Y');
        $get_number = TransaksiDinasLuarKota::where('no_surat', 'ILIKE', '%/MP3/Dinas/VI/' . $year)->latest('no_surat')->first();
        if ($get_number) {
            $number = substr($get_number->no_surat, 0, 3);
            $no_surat = str_pad($number + 1, 3, "0", STR_PAD_LEFT) . '/MP3/Dinas/VI/' . $year;
        }else{
            $no_surat = '001/MP3/Dinas/VI/' . $year;
        }

        return $no_surat;
    }
}
