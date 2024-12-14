<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\SetupJamKerja;
use App\Models\Shift;
use App\Models\WorkFromOffice;
use Illuminate\Http\Request;

class WorkFromOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'WORK FROM OFFICE';

        return view('absensi.work-from-office.index', $data);
    }

    public function getAbsensi(Request $request){
        try {
            // Get Data Setup Jam Kerja
            $getSetupJamKerja = SetupJamKerja::first();

            // Get data jenis absensi berdasarkan type = Work From Office, Timestamp = Hari ini.  
            $getDataWFO = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Work From Office')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->select('jenis_absensi')->get();
            
            // Membuat array untuk kebutuhan pengecheckan berdasarkan jenis absensi
            $tempJenisAbsensi = [];
            foreach ($getDataWFO as $key => $value) {
                array_push($tempJenisAbsensi, $value->jenis_absensi);
            }

            $getTimestampIstirahatMasuk = '-';
            $getTimestampIstirahatKeluar = '-';

            // Check array from (jenis absensi)
            if (in_array('masuk',$tempJenisAbsensi) && !in_array('pulang',$tempJenisAbsensi)) {
                $getDataWFOByJenis = Absensi::where('user_id',$request->user_id)->where('jenis_absensi', 'masuk')->where('type_absensi', 'Work From Office')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->first();
                $getTimestampIstirahatMasuk = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Work From Office')->where('jenis_absensi', 'istirahat masuk')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->select('timestamp')->first();
                $getTimestampIstirahatKeluar = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Work From Office')->where('jenis_absensi', 'istirahat keluar')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->select('timestamp')->first();
                
                $timestampMasuk = '-';
            }else if(in_array('pulang',$tempJenisAbsensi)){
                $getDataWFOByJenis = Absensi::where('user_id',$request->user_id)->where('jenis_absensi', 'pulang')->where('type_absensi', 'Work From Office')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->first();
                $getTimestampMasuk = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Work From Office')->where('jenis_absensi', 'masuk')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->select('timestamp')->first();
                $getTimestampIstirahatMasuk = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Work From Office')->where('jenis_absensi', 'istirahat masuk')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->select('timestamp')->first();
                $getTimestampIstirahatKeluar = Absensi::where('user_id',$request->user_id)->where('type_absensi', 'Work From Office')->where('jenis_absensi', 'istirahat keluar')->where('timestamp', 'like', '%' . date('Y-m-d') . '%')->orderBy('timestamp','desc')->select('timestamp')->first();
                
                $timestampMasuk = $getTimestampMasuk->timestamp;
            }

            // ====================
            // Get Timestamp 
            if ($getTimestampIstirahatMasuk != null) {
                $timestampIstirahatMasuk = $getTimestampIstirahatMasuk->timestamp;
            }else{
                $timestampIstirahatMasuk = '-';
            }

            if ($getTimestampIstirahatKeluar != null) {
                $timestampIstirahatKeluar = $getTimestampIstirahatKeluar->timestamp;
            }else{
                $timestampIstirahatKeluar = '-';
            }
            // ====================

            // ====================
            // Get Data (Lama Kerja) 
            $jam_masuk 			  = date_create($getDataWFOByJenis->timestamp);
			$jam_sekarang 		  = date_create();  
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
                'data' => $getDataWFOByJenis,
                'lama_kerja' => $lama_kerja,
                'persentase_jamkerja' => $persentaseJamKerja,
                'overtime' => $overtime,
                'jam_kerja' => $jamKerja,
                'waktu_masuk' => $timestampMasuk,
                'waktu_istirahat_masuk' => $timestampIstirahatMasuk,
                'waktu_istirahat_keluar' => $timestampIstirahatKeluar
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
