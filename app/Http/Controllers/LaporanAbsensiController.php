<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;

class LaporanAbsensiController extends Controller
{
    public function index(Request $request){
        $data['page_title'] = 'LAPORAN ABSENSI';
        $absensi = Absensi::orderBy('id', 'desc');


        if ($request->get('type_absensi')) {
            if ($request->get('select_period') == 'hari') {
                $absensi = $absensi->where('type_absensi',$request->get('type_absensi'))->where('timestamp', 'like', $request->get('select_date').'%');
            }else if($request->get('select_period') == 'bulan'){
                if ($request->get('select_month') == "all") {
                    $absensi = $absensi->where('type_absensi',$request->get('type_absensi'))->where('timestamp', 'like', $request->get('select_year').'%');
                }else{
                    $absensi = $absensi->where('type_absensi',$request->get('type_absensi'))->where('timestamp', 'like', $request->get('select_year').'-'.$request->get('select_month').'%');
                }
            }else if($request->get('select_period') == 'tahun'){
                $absensi = $absensi->where('type_absensi',$request->get('type_absensi'))->where('timestamp', 'like', $request->get('select_year').'%');
            }
        }else{
            $absensi = $absensi->where('type_absensi','Work From Office')->where('timestamp', 'like', date('Y-m-d').'%');
        }

        $data['absensi'] = $absensi->get();

        return view('laporan.laporan-absensi', $data);
    }
}
