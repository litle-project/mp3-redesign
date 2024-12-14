<?php

namespace App\Http\Controllers;

use App\Models\Lembur;
use App\Models\LemburUser;
use App\Models\User;
use Exception;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
class LemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'LEMBUR';

        $getDataCreator = Lembur::orderBy('created_at', 'desc')->where('created_by', Auth::user()->name)->get()->pluck('created_by');

        if (Auth::user()->name == 'Admin' || Auth::user()->name == 'kadisnav') {
            $lembur = Lembur::orderBy('id', 'desc');
            if ($request->get('select_period') == 'hari') {
                $lembur = $lembur->where('created_at', 'like', $request->get('select_date').'%');
            }else if($request->get('select_period') == 'bulan'){
                if ($request->get('select_month') == "all") {
                    $lembur = $lembur->where('created_at', 'like', $request->get('select_year').'%');
                }else{
                    $lembur = $lembur->where('created_at', 'like', $request->get('select_year').'-'.$request->get('select_month').'%');
                }
            }else if($request->get('select_period') == 'tahun'){
                $lembur = $lembur->where('created_at', 'like', $request->get('select_year').'%');
            } else {
                $lembur = $lembur;
            }
            
        $data['lemburs'] = $lembur->get();

        } else if ($getDataCreator) {
            $lembur1 = Lembur::whereHas('LemburUsers', function($q){
                $q->where('user_id', Auth::user()->id);
            })->orWhereIn('created_by', $getDataCreator)->orderBy('id', 'desc');

            if ($request->get('select_period') == 'hari') {
                $lembur1 = $lembur1->where('created_at', 'like', $request->get('select_date').'%');
            }else if($request->get('select_period') == 'bulan'){
                if ($request->get('select_month') == "all") {
                    $lembur1 = $lembur1->where('created_at', 'like', $request->get('select_year').'%');
                }else{
                    $lembur1 = $lembur1->where('created_at', 'like', $request->get('select_year').'-'.$request->get('select_month').'%');
                }
            }else if($request->get('select_period') == 'tahun'){
                $lembur1 = $lembur1->where('created_at', 'like', $request->get('select_year').'%');
            } else {
                $lembur1 = $lembur1;
            }
            
        $data['lemburs'] = $lembur1->get();

        } else {
            $lembur2 = Lembur::whereHas('LemburUsers', function($q){
                $q->where('user_id', Auth::user()->id);
            })->orderBy('id', 'desc');

            if ($request->get('select_period') == 'hari') {
                $lembur2 = $lembur2->where('created_at', 'like', $request->get('select_date').'%');
            }else if($request->get('select_period') == 'bulan'){
                if ($request->get('select_month') == "all") {
                    $lembur2 = $lembur2->where('created_at', 'like', $request->get('select_year').'%');
                }else{
                    $lembur2 = $lembur2->where('created_at', 'like', $request->get('select_year').'-'.$request->get('select_month').'%');
                }
            }else if($request->get('select_period') == 'tahun'){
                $lembur2 = $lembur2->where('created_at', 'like', $request->get('select_year').'%');
            } else {
                $lembur2 = $lembur2;
            }
            
        $data['lemburs'] = $lembur2->get();
        }   
        
        $role_this_user = User::findOrFail(Auth::user()->id);
        $role_name = $role_this_user->roles->first()->name ?? '';
        $data['user_count'] = User::where('role_atasan_name', $role_name)->get()->count();

        // sum total jam
        $calculate = Lembur::whereHas('LemburUsers', function($q){
            $q->where('user_id', Auth::user()->id);
        })->get()->sum('total_jam');
        $data['total_jam'] = $calculate; 

        if (Auth::user()->name == 'Admin' || Auth::user()->name == 'kadisnav') {
            $lembur1 = Lembur::orderBy('id', 'desc')->get();
        } else {
            $endMonth = date('t-m-Y');
            $dataLembur = Lembur::whereHas('LemburUsers', function($q){
                $q->where('user_id', Auth::user()->id);
            })->latest()->get()->pluck('tstamp');


            if ($endMonth) {
                Lembur::query()->update([
                    'total_jam' => 0,
                ]);
            } 
            // dd($dataLembur[0]);
        }
      

        return view('lembur.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'PERINTAH LEMBUR';
        $data['users'] = User::where('name', '!=', Auth::user()->name)->get();
        return view('lembur.create', $data);
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
             $lembur = new Lembur();
             $lembur->nomor_perintah_lembur = $request->nomor_perintah_lembur;
             $lembur->perihal_lembur = $request->perihal_lembur;
             $lembur->rencana_output_kerja_lembur = $request->rencana_output_kerja_lembur;
             $lembur->tanggal_lembur = $request->tanggal_lembur;
             $lembur->dari_jam = $request->dari_jam;
             $lembur->sampai_jam = $request->sampai_jam;
             $lembur->keterangan = $request->keterangan;
             $lembur->total_jam = $request->total_jam / 60;
             $lembur->jam_terakhir = $request->total_jam / 60;
             $lembur->tstamp = date('d-m-Y', strtotime($request->tanggal_lembur));
             $lembur->save();

             $pegawai = [];
            foreach ($request->user_id as $key => $value) {
                # code...
                $pegawai[] = [
                    'lembur_id' => $lembur->id,
                    'user_id' => $request->user_id[$key],
                    'creator_id' => Auth::user()->id
                ];
            }

             LemburUser::insert($pegawai);

              // check supporting document file
        if ($request->hasFile('dokumen')) {
            $documents = [];

            foreach ($request->file('dokumen') as $file) { 
                $name = $file->getClientOriginalName();

                // check duplicate name
                $i = 1;
                while(file_exists('docs/'.$name))
                {           
                    $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)."($i).".$file->getClientOriginalExtension();
                    $i++;
                }
                $destinationPath = public_path('docs');
                $file->move($destinationPath, $name);
                
                //set calibration data
                $documents[] = [
                    'dokumen' => $name ?? null,
                    'lembur_id' => $lembur->id,
                ];
            }

            //save calibration
            $lembur->documents()->insert($documents);
        }
           
 
             DB::commit();
             return redirect()->route('lembur.index')->with(['success' => 'Perintah Lembur Sukses Ditambahkan !']);
         } catch (Exception $e) {
             DB::rollback();
             return redirect()->route('lembur.index')->with(['failed' => $e->getMessage()]);
         }
    }

    public function review($id)
    {
        $data['page_title'] = 'REVIEW PERINTAH LEMBUR';
        $data['data'] = Lembur::findOrFail($id);

        return view('lembur.component.review', $data);
    }

    public function laporan(Request $request)
    {
        $data['page_title'] = 'LAPORAN LEMBUR';
        $lembur = Lembur::orderBy('created_at', 'desc');

        if ($request->get('select_period') == 'hari') {
            $lembur = $lembur->where('tanggal_lembur', 'like', $request->get('select_date').'%');
        }else if($request->get('select_period') == 'bulan'){
            if ($request->get('select_month') == "all") {
                $lembur = $lembur->where('tanggal_lembur', 'like', $request->get('select_year').'%');
            }else{
                $lembur = $lembur->where('tanggal_lembur', 'like', $request->get('select_year').'-'.$request->get('select_month').'%');
            }
        }else if($request->get('select_period') == 'tahun'){
            $lembur = $lembur->where('tanggal_lembur', 'like', $request->get('select_year').'%');
        } else {
            $lembur = $lembur;
        }

        $data['lemburs'] = $lembur->get();



        return view('lembur.laporan', $data);


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
}
