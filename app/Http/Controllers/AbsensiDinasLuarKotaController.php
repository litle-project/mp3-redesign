<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\SetupJamKerja;
use App\Models\TransaksiDinasLuarKota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiDinasLuarKotaController extends Controller
{
    public function index(){
        $data['page_title'] = 'DINAS LUAR KOTA';

        return view('absensi.dinas-luar-kota.index', $data);
    }
    public function getAbsensi(Request $request){
        try {
            // Get Data Setup Jam Kerja
            $getSetupJamKerja = SetupJamKerja::first();

            // Get data jenis absensi berdasarkan type = Dinas Luar Kota, Timestamp = Hari ini.  
            $getDataDLK = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Dinas Luar Kota')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->select('jenis_absensi')->get();
            
            // Membuat array untuk kebutuhan pengecheckan berdasarkan jenis absensi
            $tempJenisAbsensi = [];
            foreach ($getDataDLK as $key => $value) {
                array_push($tempJenisAbsensi, $value->jenis_absensi);
            }

            // Check array from (jenis absensi)
            if (in_array('masuk',$tempJenisAbsensi) && !in_array('pulang',$tempJenisAbsensi)) {
                $getDataDLKByJenis = Absensi::where('user_id',$request->user_id)->where('jenis_absensi', 'masuk')->where('type_absensi', 'Dinas Luar Kota')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->first();
                
                $timestampMasuk = '-';
            }else if(in_array('pulang',$tempJenisAbsensi)){
                $getDataDLKByJenis = Absensi::where('user_id',$request->user_id)->where('jenis_absensi', 'pulang')->where('type_absensi', 'Dinas Luar Kota')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->first();
                $getTimestampMasuk = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Dinas Luar Kota')->where('jenis_absensi', 'masuk')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->select('timestamp')->first();
                
                $timestampMasuk = $getTimestampMasuk->timestamp;
            }

            // ====================
            // Get Data (Lama Kerja) 
            $jam_masuk 		  = date_create($getDataDLKByJenis->timestamp);
            $jam_sekarang 	  = date_create();  
            $durasi_kerja	      = date_diff($jam_masuk,$jam_sekarang);

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
            $jamMasukKerja 			  = date_create(date('Y-m-d').' '.$getSetupJamKerja->jam_masuk);
            $jamPulangKerja 		  = date_create(date('Y-m-d').' '.$getSetupJamKerja->jam_pulang);  
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
              $jamPulang = date_create(date('Y-m-d').' '.$getSetupJamKerja->jam_pulang);
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
                'data' => $getDataDLKByJenis,
                'lama_kerja' => $lama_kerja,
                'persentase_jamkerja' => $persentaseJamKerja,
                'overtime' => $overtime,
                'jam_kerja' => $jamKerja,
                'waktu_masuk' => $timestampMasuk,
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
