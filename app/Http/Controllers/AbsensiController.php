<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\HistoryShiftAbsensi;
use App\Models\KegiatanLuarKantor;
use App\Models\Lembur;
use App\Models\SetupJamKerja;
use App\Models\Shift;
use App\Models\TransaksiDinasLuarKota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{

    public function storeAbsensi(Request $request){
        try {
            // Get Data Shift
            if ($request->type_absensi == 'Work From Office' || $request->type_absensi == 'Work From Home') {
                // Get data Setup Jam Kerja
                $shift = SetupJamKerja::first();
                
                $jamMasukShift = $shift->jam_masuk;
            }else if($request->type_absensi == 'Work From Instalation'){
                $shift = Shift::whereHas('ShiftUsers', function($q) use($request){
                    $q->where('user_id', $request->user_id);
                })->first();
                
                $jamMasukShift = $shift->jam_masuk;
            }else if($request->type_absensi == 'Dinas Luar Kota'){
                $shift = TransaksiDinasLuarKota::whereHas('PegawaiDinasLuarKota', function($q)  use($request){
                    $q->where('user_id', $request->user_id);
                })->select('tanggal_mulai_dinas', 'tanggal_selesai_dinas')->orderBy('tanggal_mulai_dinas', 'ASC')->first();
                $jamKerja = SetupJamKerja::first();

                $jamMasukShift = $jamKerja->jam_masuk;
            }else if($request->type_absensi == 'Kegiatan Luar Kantor'){
                $getSetupJamKerja = KegiatanLuarKantor::whereHas('personilDinas', function($q) use($request){
                    $q->where('pegawai_id', $request->user_id);
                })->orWhere('user_id', $request->user_id)->first();

                $jamMasukShift = $getSetupJamKerja->jam_mulai_kegiatan;
            }else if($request->type_absensi == 'Lembur'){
                $getSetupJamKerja = Lembur::whereHas('LemburUsers', function($q) use($request){
                    $q->where('user_id', $request->user_id);
                })->first();

                $jamMasukShift = $getSetupJamKerja->dari_jam;
            }

            // Validasi Status Absensi
            $timeNow = date('H:i');
            $status_absensi = '';

            if ($timeNow <= $jamMasukShift) {
                $status_absensi = 'Tepat Waktu';
            }else{
                $status_absensi = 'Terlambat';
            }
            // Store Absensi
            $absensi = new Absensi();
            $absensi->timestamp = date('Y-m-d H:i:s');
            $absensi->jenis_absensi = $request->jenis_absensi;
            $absensi->status_absensi = $status_absensi;
            $absensi->type_absensi = $request->type_absensi;
            $absensi->instalasi_id = $shift->instalasi_id ?? null;
            $absensi->user_id = $request->user_id;
            
            $absensi->save();
            
            // Store History Data Shift Absensi
            $history = new HistoryShiftAbsensi();
            $history->user_id = $request->user_id;
            $history->nama_shift = $shift->nama_shift ?? '-';
            $history->jam_masuk = $shift->jam_masuk ?? '-';
            $history->jam_pulang = $shift->jam_pulang ?? '-';
            $history->jam_pulang = $shift->jam_istirahat_masuk ?? '-';
            $history->jam_pulang = $shift->jam_istirahat_keluar ?? '-';
            $history->instalasi_id = $shift->instalasi_id ?? null;
            $history->keterangan = $shift->keterangan ?? '-';
            $history->absensi_id = $absensi->id;
            
            $history->save();

            // Response
            $response = [
                'status' => 201,
                'message' => 'Post data successfully!',
                'data'=> ['datetime' => $absensi->timestamp, 'jenis_absensi' => $absensi->jenis_absensi, 'status_absensi' => $absensi->status_absensi, 'user_id' => $absensi->user_id]
            ];
    
            return $response;
        } catch (\Throwable $th) {

            // Response
            $response = [
                'status' => 400,
                'message' => $th->getMessage()
            ];

            return $response;
        }
       
    }
}
