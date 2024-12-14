<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\KegiatanLuarKantor;
use Illuminate\Http\Request;

class AbsensiKegiatanLuarKantorController extends Controller
{
    public function index(){
        $data['page_title'] = 'KEGIATAN LUAR KANTOR';

        return view('absensi.kegiatan-luar-kantor.index', $data);
    }
    public function getAbsensi(Request $request){
        try {
            // Get Data Setup Jam Kerja
            $getSetupJamKerja = KegiatanLuarKantor::whereHas('personilDinas', function($q) use($request){
                $q->where('pegawai_id', $request->user_id);
            })->orWhere('user_id', $request->user_id)->where('status', 'Disetujui')->first();
            $getJamKerjaTambahan = KegiatanLuarKantor::absensiTambahWaktuSelesai($request->user_id,$getSetupJamKerja->id, $getSetupJamKerja->jam_mulai_kegiatan, $getSetupJamKerja->jam_selesai_kegiatan); 

            // Get data jenis absensi berdasarkan type = Kegiatan Luar Kantor, Timestamp = Hari ini.  
            $getDataKLK = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Kegiatan Luar Kantor')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->select('jenis_absensi')->get();
            
            // Membuat array untuk kebutuhan pengecheckan berdasarkan jenis absensi
            $tempJenisAbsensi = [];
            foreach ($getDataKLK as $key => $value) {
                array_push($tempJenisAbsensi, $value->jenis_absensi);
            }
            // dd($tempJenisAbsensi);
            // Check array from (jenis absensi)
            if (in_array('keluar',$tempJenisAbsensi) && !in_array('masuk',$tempJenisAbsensi)) {
                $getDataKLKByJenis = Absensi::where('user_id',$request->user_id)->where('jenis_absensi', 'keluar')->where('type_absensi', 'Kegiatan Luar Kantor')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->first();
                
                $timestampKeluar = '-';
            }else if(in_array('masuk',$tempJenisAbsensi)){
                $getDataKLKByJenis = Absensi::where('user_id',$request->user_id)->where('jenis_absensi', 'masuk')->where('type_absensi', 'Kegiatan Luar Kantor')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->first();
                $getTimestampKeluar = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Kegiatan Luar Kantor')->where('jenis_absensi', 'keluar')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->select('timestamp')->first();
                
                $timestampKeluar = $getTimestampKeluar->timestamp;
            }

            // ====================
            // Get Data (Lama Kerja) 
            $jam_masuk 		  = date_create($getDataKLKByJenis->timestamp);
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
            $jamMasukKerja 			  = date_create(date('Y-m-d').' '.$getJamKerjaTambahan['jam_mulai_kegiatan']);
            $jamPulangKerja 		  = date_create(date('Y-m-d').' '.$getJamKerjaTambahan['jam_selesai_kegiatan']);  
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
            $jamPulang = date_create(date('Y-m-d').' '.$getJamKerjaTambahan['jam_selesai_kegiatan']);
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
                'data' => $getDataKLKByJenis,
                'lama_kerja' => $lama_kerja,
                'persentase_jamkerja' => $persentaseJamKerja,
                'overtime' => $overtime,
                'jam_kerja' => $jamKerja,
                'waktu_keluar' => $timestampKeluar,
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
