<?php

use App\Http\Controllers\AbsensiDinasLuarKotaController;
use App\Http\Controllers\AbsensiKegiatanLuarKantorController;
use App\Http\Controllers\AbsensiLemburController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ShiftWFOController;
use App\Http\Controllers\InstalasiController;
use App\Http\Controllers\KoordinatKantorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SetupJamKerjaController;
use App\Http\Controllers\WorkFromOfficeController;
use App\Http\Controllers\KegiatanLuarKantorController;
use App\Http\Controllers\MainMenuAbsensiController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DinasLuarKotaController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\LaporanAbsensiController;
use App\Http\Controllers\LiburNasionalController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\PersetujuanCutiController;
use App\Http\Controllers\PublicDataController;
use App\Http\Controllers\RoleSettingController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\WorkFromHomeController;
use App\Http\Controllers\WorkFromInstalationController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data['page_title'] = "Login";
    return view('auth.login', $data);
})->name('user.login');
Route::get('public-data/user/{id}', [PublicDataController::class, 'user'])->name('public-data.user');

Route::middleware('auth:web')->group(function () {
    // DASHBOARD
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    
    // ABSENSI
    Route::prefix('absensi')->name('absensi.')->group(function () {
        Route::get('/', function() {
            $data['page_title'] = 'Menu Absensi';
            return view('absensi.menu', $data);
        })->name('menu-absensi');

        // Main Menu
        Route::get('/', [MainMenuAbsensiController::class, 'index'])->name('menu-absensi');

        // Absensi WFO
        Route::get('work-from-office', [WorkFromOfficeController::class, 'index'])->name('work-from-office.index');

        // Absensi WFH
        Route::get('work-from-home', [WorkFromHomeController::class, 'index'])->name('work-from-home.index');

        // Absensi Instalation
        Route::get('work-from-instalation', [WorkFromInstalationController::class, 'index'])->name('work-from-instalation.index');

        // Absensi Dinas Luar Kota
        Route::get('dinas-luar-kota', [AbsensiDinasLuarKotaController::class, 'index'])->name('dinas-luar-kota.index');
        
        // Absensi Kegiatan Luar Kantor
        Route::get('kegiatan-luar-kantor', [AbsensiKegiatanLuarKantorController::class, 'index'])->name('kegiatan-luar-kantor.index');
        
        // Absensi Lembur
        Route::get('lembur', [AbsensiLemburController::class, 'index'])->name('lembur.index');
    });

     // --- MASTER DATA
    Route::prefix('master-data')->name('master-data.')->group(function () {

        Route::get('/', [DataMasterController::class, 'index'])->name('index');

         // Setup Jam Kerja
         Route::resource('setup-jam-kerja', SetupJamKerjaController::class)->except([
            'destroy','show'
        ]);
        Route::get('/jam-kerja/{id}/delete', [SetupJamKerjaController::class, 'destroy'])->name('setup-jam-kerja.destroy');

        // Shift
        Route::resource('setup-shift', ShiftController::class)->except([
            'destroy','show'
        ]);
        Route::get('/setup-shift/{id}/delete', [ShiftController::class, 'destroy'])->name('setup-shift.destroy');
        Route::get('/setup-shift/{id}/detail', [ShiftController::class, 'show'])->name('setup-shift.show');

        // Instalasi
        Route::resource('instalasi', InstalasiController::class)->except([
            'destroy'
        ]);
        Route::get('/instalasi/{id}/delete', [InstalasiController::class, 'destroy'])->name('instalasi.destroy');

        // Pangkat
        Route::resource('pangkat', PangkatController::class)->except([
            'destroy'
        ]);
        Route::get('/pangkat/{id}/delete', [PangkatController::class, 'destroy'])->name('pangkat.destroy');

        // Cuti
        Route::resource('cuti', CutiController::class)->except([
            'destroy'
        ]);
        Route::get('/cuti/{id}/delete', [CutiController::class, 'destroy'])->name('cuti.destroy');

        // Koordinat Kantor
        Route::resource('koordinat-kantor', KoordinatKantorController::class)->except([
            'destroy'
        ]);
        Route::get('/koordinat-kantor/{id}/delete', [KoordinatKantorController::class, 'destroy'])->name('koordinat-kantor.destroy');

        // Libur Nasional
        Route::resource('libur-nasional', LiburNasionalController::class)->except([
            'destroy'
        ]);
        Route::get('/libur-nasional/{id}/delete', [LiburNasionalController::class, 'destroy'])->name('libur-nasional.destroy');

        // Role
        Route::resource('struktur-organisasi', StrukturOrganisasiController::class)->except([
            'destroy'
        ]);

        Route::get('/struktur-organisasi/{id}/delete', [StrukturOrganisasiController::class, 'destroy'])->name('struktur-organisasi.destroy');

        // Data pegawai
        Route::patch('change-password', [UserController::class, 'changePassword'])->name('users.change-password');
        Route::resource('user', UserController::class)->except([
            'show','destroy'
        ]);
        Route::get('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');

        // Kegiatan luar kantor
        Route::resource('kegiatan-luar-kantor', KegiatanLuarKantorController::class)->except([
            'show', 'destroy'
        ]);
        Route::get('/kegiatan-luar-kantor/{id}/delete', [KegiatanLuarKantorController::class, 'destroy'])->name('kegiatan-luar-kantor.destroy');
        Route::get('/kegiatan-luar-kantor/{id}/review', [KegiatanLuarKantorController::class, 'review'])->name('kegiatan-luar-kantor.review');
        Route::post('/kegiatan-luar-kantor/{id}/approval-atasan-langsung', [KegiatanLuarKantorController::class, 'approvalAtasanLangsung'])->name('kegiatan-luar-kantor.approval-atasan-langsung');
        Route::post('/kegiatan-luar-kantor/{id}/approval-kadisnav', [KegiatanLuarKantorController::class, 'approvalKadisnav'])->name('kegiatan-luar-kantor.approval-kadisnav');
        Route::post('/kegiatan-luar-kantor/{id}/tambah-jam', [KegiatanLuarKantorController::class, 'tambahJam'])->name('kegiatan-luar-kantor.tambah-jam');
        Route::post('/kegiatan-luar-kantor/{id}/tambah-jam-approve', [KegiatanLuarKantorController::class, 'tambahJamApprove'])->name('kegiatan-luar-kantor.tambah-jam-approve');
        Route::get('/kegiatan-luar-kantor/{id}/tambah-jam-reject', [KegiatanLuarKantorController::class, 'tambahJamReject'])->name('kegiatan-luar-kantor.tambah-jam-reject');

    });


    // Transaksi Cuti
    Route::resource('pengajuan-cuti', PengajuanCutiController::class)->except([
        'show', 'destroy'
    ]);
    Route::get('/pengajuan-cuti/approval', [PengajuanCutiController::class, 'approval'])->name('pengajuan-cuti.approval');
    Route::get('/pengajuan-cuti/{id}/delete', [PengajuanCutiController::class, 'destroy'])->name('pengajuan-cuti.destroy');
    Route::get('/pengajuan-cuti/{id}/review', [PengajuanCutiController::class, 'review'])->name('pengajuan-cuti.review');
    Route::get('/pengajuan-cuti/{id}/surat-izin-pdf', [PengajuanCutiController::class, 'suratIzinPdf'])->name('pengajuan-cuti.surat-izin-pdf');

    Route::prefix('persetujuan-cuti')->name('persetujuan-cuti.')->group(function () {
        Route::post('/atasan-langsung/{id}', [PersetujuanCutiController::class, 'tindakLanjutAtasanLangsung'])->name('atasan-langsung');
        Route::post('/kabag-tata-usaha/{id}', [PersetujuanCutiController::class, 'tindakLanjutKabagtu'])->name('kabag-tu');
        Route::post('/kadisnav/{id}', [PersetujuanCutiController::class, 'tindakLanjutKadisnav'])->name('kadisnav');
    });

    // Transaksi lembur
    Route::resource('lembur', LemburController::class)->except([
        'show', 'destroy'
    ]);
    Route::get('/lembur/{id}/review', [LemburController::class, 'review'])->name('lembur.review');

    // Dinas Luar Kota
    Route::resource('dinas-luar-kota', DinasLuarKotaController::class)->except([
       'destroy'
    ]);
    Route::get('/dinas-luar-kota/{id}/delete', [DinasLuarKotaController::class, 'destroy'])->name('dinas-luar-kota.destroy');

    // Berita & Pengumuman
    Route::resource('berita', NewsController::class)->except([
       'destroy'
    ]);
    Route::get('/berita/{id}/delete', [NewsController::class, 'destroy'])->name('berita.destroy');
    
    // User Setting
    Route::get('/user-setting/{id}/', [UserController::class, 'userSetting'])->name('user-setting');
    Route::patch('/user-setting/{id}/update', [UserController::class, 'userSettingUpdate'])->name('user-setting.update');

    // Role Setting (Setting Atasan Langsung)
    Route::prefix('role-setting')->name('role-setting.')->group(function () {
        Route::get('/index', [RoleSettingController::class, 'index'])->name('index');
        Route::get('/setup/{id}', [RoleSettingController::class, 'setup'])->name('setup');
        Route::post('/setup-store/{id}', [RoleSettingController::class, 'setupUpdate'])->name('setup-update');
    });

    // Calender
    Route::get('calender', [CalenderController::class, 'index'])->name('calender.index');
    
    Route::prefix('laporan')->name('laporan.')->group(function () {
    
    // Laporan 
    Route::get('absensi', [LaporanAbsensiController::class, 'index'])->name('absensi.index');
    
    Route::get('lembur', [LemburController::class, 'laporan'])->name('lembur.laporan');
    });

    Route::post('/user-import-excel',[ImportExcelController::class,'user'])->name('import-excel.user');
});
