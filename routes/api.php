<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AbsensiDinasLuarKotaController;
use App\Http\Controllers\AbsensiKegiatanLuarKantorController;
use App\Http\Controllers\AbsensiLemburController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\InstalasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkFromHomeController;
use App\Http\Controllers\WorkFromInstalationController;
use App\Http\Controllers\WorkFromOfficeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('absensi', [AbsensiController::class, 'storeAbsensi'])->name('absensi-store');
Route::post('get-absensi/wfo', [WorkFromOfficeController::class, 'getAbsensi'])->name('absensi-wfo-get');
Route::post('get-absensi/wfh', [WorkFromHomeController::class, 'getAbsensi'])->name('absensi-wfh-get');
Route::post('get-absensi/wfi', [WorkFromInstalationController::class, 'getAbsensi'])->name('absensi-wfi-get');
Route::post('get-absensi/dinas-luar', [AbsensiDinasLuarKotaController::class, 'getAbsensi'])->name('absensi-dinas-luar-get');
Route::post('get-absensi/kegiatan-luar-kantor', [AbsensiKegiatanLuarKantorController::class, 'getAbsensi'])->name('absensi-kegiatan-luar-kantor-get');
Route::post('get-absensi/lembur', [AbsensiLemburController::class, 'getAbsensi'])->name('absensi-lembur-get');
Route::post('add/event-calender/{id}', [CalenderController::class, 'addEvent'])->name('add-event-calender');

Route::post('instalasi/kantor-utama', [InstalasiController::class, 'checkKantorUtama'])->name('check-kantor-utama');

Route::get('/get-pegawai',[UserController::class,'apiGetPegawai'])->name('get-pegawai');
Route::post('/get-pegawai/{id}',[UserController::class,'apiGetPegawaiById'])->name('get-pegawai-by-id');