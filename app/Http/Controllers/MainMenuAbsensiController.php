<?php

namespace App\Http\Controllers;

use App\Models\KegiatanLuarKantor;
use App\Models\SetupJamKerja;
use App\Models\Shift;
use App\Models\TransaksiDinasLuarKota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainMenuAbsensiController extends Controller
{
    public function index(){
        $data['page_title'] = 'ABSENSI';
        
        // Get Data Setup Jam Kerja
        $checkShift = Shift::whereHas('ShiftUsers', function($q){
            $q->where('user_id', Auth::user()->id);
        })->first();

        $dinasLuarKota = [];
        $dateNow = date('Y-m-d');
        if ($checkShift == null) {
            $dinasLuarKota = TransaksiDinasLuarKota::whereHas('PegawaiDinasLuarKota', function($q){
                $q->where('user_id', Auth::user()->id);
            })->select('tanggal_mulai_dinas', 'tanggal_selesai_dinas')->orderBy('tanggal_mulai_dinas', 'ASC')->get();
        }

        $KegiatanLuarKantor=[];
        if (count($dinasLuarKota) == 0) {
            $KegiatanLuarKantor = KegiatanLuarKantor::whereHas('personilDinas', function($q){
                $q->where('pegawai_id', Auth::user()->id);
            })->orWhere('user_id', Auth::user()->id)->where('status', 'Disetujui')->get();
        }

        if (count($dinasLuarKota) == 0 &&  count($KegiatanLuarKantor) == 0 && $checkShift == null) {
            $data['shift'] = 'Jam Kerja Kantor';
        }else if($checkShift != null){
            $data['shift'] = 'Shift Instalation';
        }else if (count($dinasLuarKota) > 0){
            if ( $dateNow >= $dinasLuarKota[0]->tanggal_mulai_dinas && $dateNow <= $dinasLuarKota[0]->tanggal_selesai_dinas) {
                $data['shift'] = 'Dinas Luar Kota';
            }else{
                $data['shift'] = 'Jam Kerja Kantor';
            }
        }else if(count($KegiatanLuarKantor) > 0){
            if ( $dateNow = $KegiatanLuarKantor[0]->tanggal_kegiatan) {
                $data['shift'] = 'Kegiatan Luar Kantor';
            }else{
                $data['shift'] = 'Jam Kerja Kantor';
            }
        }

        return view('absensi.menu', $data);
    }
}
