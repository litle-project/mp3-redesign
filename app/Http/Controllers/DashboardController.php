<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Absensi;
use App\Models\PengajuanCuti;
use App\Models\PersetujuanCuti;
use App\Models\PersetujuanCutiDetail;
use App\Models\TransaksiDinasLuarKota;
use App\Models\PegawaiDinasLuarKota;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('permission:dashboard', ['only' => 'read']);
    // }

    public function dashboard()
    {
        $data['page_title'] = 'Dashboard';
        $data['breadcumb'] = 'Dashboard';

        $data['beritas'] = News::get();

        // Total Pegawai
        $data['pns'] = User::where('status_pegawai', 'ASN')->get()->count();
        $data['PPnPN'] = User::where('status_pegawai', 'PPnPN')->get()->count();
        $data['male'] = User::where('jenis_kelamin', 'laki-laki')->get()->count();
        $data['female'] = User::where('jenis_kelamin', 'perempuan')->get()->count();

        // Pegawai yang bekerja di kantor
        $data['male_dikantor'] = Absensi::where('type_absensi', 'Work From Office')->where('timestamp', 'like', date('Y-m-d').'%')->where('jenis_absensi', 'masuk')->whereHas('user', function($q){
            $q->where('jenis_kelamin', 'laki-laki');
        })->get()->count();

        $data['female_dikantor'] = Absensi::where('type_absensi', 'Work From Office')->where('timestamp', 'like', date('Y-m-d').'%')->where('jenis_absensi', 'masuk')->whereHas('user', function($q){
            $q->where('jenis_kelamin', 'perempuan');
        })->get()->count();

        // Pegawai yang bekerja di instalasi
        $data['female_instalasi'] = Absensi::where('type_absensi', 'Work From Instalation')->where('timestamp', 'like', date('Y-m-d').'%')->where('jenis_absensi', 'masuk')->whereHas('user', function($q){
            $q->where('jenis_kelamin', 'perempuan');
        })->get()->count();

        $data['male_instalasi'] = Absensi::where('type_absensi', 'Work From Instalation')->where('timestamp', 'like', date('Y-m-d').'%')->where('jenis_absensi', 'masuk')->whereHas('user', function($q){
            $q->where('jenis_kelamin', 'laki-laki');
        })->get()->count();

        // Pegawai Cuti
        $data['male_cuti'] =  PengajuanCuti::where('status', 'Disetujui')
            ->where('tanggal_mulai_cuti', '<=',  date('Y-m-d'))
            ->where('tanggal_selesai_cuti', '>=',  date('Y-m-d'))
            ->whereHas('Users', function($q){
            $q->where('jenis_kelamin', 'laki-laki');
        })->get()->count();
        $data['female_cuti'] =  PengajuanCuti::where('status', 'Disetujui')
            ->where('tanggal_mulai_cuti', '<=',  date('Y-m-d'))
            ->where('tanggal_selesai_cuti', '>=',  date('Y-m-d'))
            ->whereHas('Users', function($q){
            $q->where('jenis_kelamin', 'perempuan');
        })->get()->count();


        // Pegawai yang bekerja di dinas luar kota
        $data['female_dinas'] = Absensi::where('type_absensi', 'Dinas Luar Kota')->where('timestamp', 'like', date('Y-m-d').'%')->where('jenis_absensi', 'masuk')->whereHas('user', function($q){
            $q->where('jenis_kelamin', 'perempuan');
        })->get()->count();

        $data['male_dinas'] = Absensi::where('type_absensi', 'Dinas Luar Kota')->where('timestamp', 'like', date('Y-m-d').'%')->where('jenis_absensi', 'masuk')->whereHas('user', function($q){
            $q->where('jenis_kelamin', 'laki-laki');
        })->get()->count();

        // Pegawai yang tidak absen
        $userFemaleId = User::where('jenis_kelamin', 'perempuan')->get()->pluck('id');
        $absensi = User::whereHas('absensi', function($q) use($userFemaleId){
            $q->where('timestamp', 'like', date('Y-m-d').'%');
            $q->whereIn('user_id', $userFemaleId);
        })->get()->count();
        $data['female_tidak_absen'] = count($userFemaleId) - $absensi;

        $userMaleId = User::where('jenis_kelamin', 'laki-laki')->get()->pluck('id');
        $absensi = User::whereHas('absensi', function($q) use($userMaleId){
            $q->where('timestamp', 'like', date('Y-m-d').'%');
            $q->whereIn('user_id', $userMaleId);
        })->get()->count();
        $data['male_tidak_absen'] = count($userMaleId) - $absensi;


        return view('dashboard.index', $data);
    }


}
