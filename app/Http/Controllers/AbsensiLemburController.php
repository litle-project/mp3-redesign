<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Lembur;
use Illuminate\Http\Request;

class AbsensiLemburController extends Controller
{
    public function index(){
        $data['page_title'] = 'LEMBUR';

        return view('absensi.lembur.index', $data);
    }
    public function getAbsensi(Request $request){
        try {
            // Get Data Setup Jam Kerja
            $getSetupJamKerja = Lembur::whereHas('LemburUsers', function($q) use($request){
                $q->where('user_id', $request->user_id);
            })->first();

            // Get data jenis absensi berdasarkan type Lembur, Timestamp = Hari ini.  
            $getDataLembur = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Lembur')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->select('jenis_absensi')->get();
            
            // Membuat array untuk kebutuhan pengecheckan berdasarkan jenis absensi
            $tempJenisAbsensi = [];
            foreach ($getDataLembur as $key => $value) {
                array_push($tempJenisAbsensi, $value->jenis_absensi);
            }
            // dd($tempJenisAbsensi);
            // Check array from (jenis absensi)
            if (in_array('mulai',$tempJenisAbsensi) && !in_array('selesai',$tempJenisAbsensi)) {
                $getDataLemburByJenis = Absensi::where('user_id',$request->user_id)->where('jenis_absensi', 'mulai')->where('type_absensi', 'Lembur')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->first();
                
                $timestampSelesai = '-';
            }else if(in_array('selesai',$tempJenisAbsensi)){
                $getDataLemburByJenis = Absensi::where('user_id',$request->user_id)->where('jenis_absensi', 'selesai')->where('type_absensi', 'Lembur')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->first();
                $getTimestampKeluar = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Lembur')->where('jenis_absensi', 'mulai')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->select('timestamp')->first();
                
                $timestampSelesai = $getTimestampKeluar->timestamp;
            }

            // ====================
            // Get Data (Lama Kerja) 
            $jam_masuk 		  = date_create($getDataLemburByJenis->timestamp);
            $jam_sekarang 	  = date_create();  
            $durasi_kerja	  = date_diff($jam_masuk,$jam_sekarang);

            if (strlen((string)$durasi_kerja->i) == 1) {
                $mnt = '0';
            }else{
                $mnt = '';
            }

            if ($durasi_kerja->h == 0) {
                $lk = $durasi_kerja->i.' menit';
            }else{
                $lk = $durasi_kerja->h.'.'.$mnt.$durasi_kerja->i.' jam';
            }
            $lama_kerja   = $lk;
            // ===================

            // ===================
            // Get (Total Jam Kerja dan Create Persentase Jam Kerja)
            $jamMasukKerja 			  = date_create(date('Y-m-d').' '.$getSetupJamKerja->dari_jam);
            $jamPulangKerja 		  = date_create(date('Y-m-d').' '.$getSetupJamKerja->sampai_jam);  
            $durasiJamKerja	          = date_diff($jamMasukKerja,$jamPulangKerja);

            if (strlen((string)$durasiJamKerja->i) == 1) {
                $minute = '0';
            }else{
                $minute = '';
            }

            if ($durasiJamKerja->h == 0) {
                $jk = $durasiJamKerja->i;
            }else{
                $jk = $durasiJamKerja->h.'.'.$minute.$durasiJamKerja->i;
            }
            $jamKerja = $jk;
            $persentaseJamKerja = ((float)($durasi_kerja->h.'.'.$mnt.$durasi_kerja->i)/$jamKerja)*100;
            // ===================

            // ===================
            // Get (Overtime (Hidden))
            $jamPulang = date_create(date('Y-m-d').' '.$getSetupJamKerja->sampai_jam);
            $jamLembur = date_create();  
            
            if ($jamPulang < $jamLembur) {
                $ot	= date_diff($jamPulang,$jamLembur)->h.' jam';
            }else{
                $ot	= 0 .' jam';
            }

            $overtime = $ot;
            // ===================

            // ===================
            // Response
            $response = [
                'data' => $getDataLemburByJenis,
                'lama_kerja' => $lama_kerja,
                'persentase_jamkerja' => $persentaseJamKerja,
                'overtime' => $overtime,
                'jam_kerja' => $jamKerja,
                'waktu_mulai' => $timestampSelesai,
            ];

            return $response;
      } catch (\Throwable $th) {
          $response = [
              'status' => 400,
              'message' => $th->getMessage()
          ];
          return $response;
      }
        
    } 
}
