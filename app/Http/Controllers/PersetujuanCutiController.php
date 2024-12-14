<?php

namespace App\Http\Controllers;

use App\Models\PengajuanCuti;
use App\Models\PersetujuanCuti;
use App\Models\PersetujuanCutiDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersetujuanCutiController extends Controller
{
    public function tindakLanjutAtasanLangsung(Request $request,$id){
        $userId = Auth::user()->id;
        try {


            if ($request->status == 'Disetujui') {
                DB::beginTransaction();
                // --- BUAT APPROVAL KE KABAG TU
                $persetujuanCuti['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCuti['pengajuan_cuti_id'] = $id;
                $persetujuanCuti['position'] = 'Kabag Tata Usaha';
                $persetujuanCuti['role_to_name'] = 'Kabag Tata Usaha';
                $persetujuanCuti['role_to_id'] = null;
                $persetujuanCuti['status'] = 'Done';
                $persetujuanCuti['keterangan'] = $request->keterangan;
                $persetujuanCuti['user_id'] = Auth::user()->id;
                $persetujuanCuti['title'] = 'Atasan Langsung SETUJU terhadap Permohonan Cuti Pegawai yang Bersangkutan';
                $persetujuanCuti['type'] = '';
                $persetujuanCuti = PersetujuanCuti::create($persetujuanCuti);

                // $persetujuanCuti =
                $persetujuanCutiDetail['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCutiDetail['persetujuan_cuti_id'] = $persetujuanCuti->id;
                $persetujuanCutiDetail['pengajuan_cuti_id'] = $id;
                $persetujuanCutiDetail['status'] = $request->status;
                $persetujuanCutiDetail['pertimbangan_disiplin'] = $request->pertimbangan_disiplin;
                $persetujuanCutiDetail['pertimbangan_disiplin_keterangan'] = $request->pertimbangan_disiplin_keterangan;
                $persetujuanCutiDetail['pekerjaan_terhambat'] = $request->pekerjaan_terhambat;
                $persetujuanCutiDetail['pekerjaan_terhambat_keterangan'] = $request->pekerjaan_terhambat_keterangan;
                $persetujuanCutiDetail['pekerjaan_terhambat_solusi'] = $request->pekerjaan_terhambat_solusi;
                $persetujuanCutiDetail['penunjukkan_pelaksana_harian'] = $request->penunjukkan_pelaksana_harian;
                $persetujuanCutiDetail['penunjukkan_pelaksana_harian_id'] = $request->penunjukkan_pelaksana_harian_id;
                $persetujuanCutiDetail['keterangan'] = $request->keterangan;
                $persetujuanCutiDetail['user_id'] = $userId;
                $persetujuanCutiDetail['type'] = 'ATASAN LANGSUNG';
                PersetujuanCutiDetail::create($persetujuanCutiDetail);
                DB::commit();

            }else{
                DB::beginTransaction();

                // --- BUAT APPROVAL KE KABAG TU
                $persetujuanCuti['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCuti['pengajuan_cuti_id'] = $id;
                $persetujuanCuti['position'] = 'Kabag Tata Usaha';
                $persetujuanCuti['role_to_name'] = '';
                $persetujuanCuti['role_to_id'] = null;
                $persetujuanCuti['status'] = 'Done';
                $persetujuanCuti['keterangan'] = $request->keterangan;
                $persetujuanCuti['user_id'] = Auth::user()->id;
                $persetujuanCuti['title'] = 'Permohonan Cuti Ditolak';
                $persetujuanCuti['type'] = '';
                $persetujuanCuti = PersetujuanCuti::create($persetujuanCuti);

                // $persetujuanCuti =
                $persetujuanCutiDetail['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCutiDetail['persetujuan_cuti_id'] = $persetujuanCuti->id;
                $persetujuanCutiDetail['pengajuan_cuti_id'] = $id;
                $persetujuanCutiDetail['status'] = $request->status;
                $persetujuanCutiDetail['pertimbangan_disiplin'] = $request->pertimbangan_disiplin;
                $persetujuanCutiDetail['pertimbangan_disiplin_keterangan'] = $request->pertimbangan_disiplin_keterangan;
                $persetujuanCutiDetail['pekerjaan_terhambat'] = $request->pekerjaan_terhambat;
                $persetujuanCutiDetail['pekerjaan_terhambat_keterangan'] = $request->pekerjaan_terhambat_keterangan;
                $persetujuanCutiDetail['pekerjaan_terhambat_solusi'] = $request->pekerjaan_terhambat_solusi;
                $persetujuanCutiDetail['penunjukkan_pelaksana_harian'] = $request->penunjukkan_pelaksana_harian;
                $persetujuanCutiDetail['penunjukkan_pelaksana_harian_id'] = $request->penunjukkan_pelaksana_harian_id;
                $persetujuanCutiDetail['keterangan'] = $request->keterangan;
                $persetujuanCutiDetail['user_id'] = $userId;
                $persetujuanCutiDetail['type'] = 'ATASAN LANGSUNG';
                PersetujuanCutiDetail::create($persetujuanCutiDetail);

                PengajuanCuti::where('id', $id)
                    ->update(['status' => 'Ditolak']);
                DB::commit();

            }

            return redirect()->route('pengajuan-cuti.index')->with(['success' => 'Pengajuan Cuti berhasil ditindak lanjut !']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('pengajuan-cuti.index')->with(['failed' => $e->getMessage()]);
        }
    }
    public function tindakLanjutKabagtu(Request $request,$id){
        $userId = Auth::user()->id;
        try {


            if ($request->status == 'Disetujui') {
                DB::beginTransaction();
                // --- BUAT APPROVAL KE KABAG TU
                $persetujuanCuti['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCuti['pengajuan_cuti_id'] = $id;
                $persetujuanCuti['position'] = 'Kepala Distrik Navigasi';
                $persetujuanCuti['role_to_name'] = 'Kepala Distrik Navigasi';
                $persetujuanCuti['role_to_id'] = null;
                $persetujuanCuti['status'] = 'Done';
                $persetujuanCuti['keterangan'] = $request->keterangan;
                $persetujuanCuti['user_id'] = Auth::user()->id;
                $persetujuanCuti['title'] = 'Kabag Tata Usaha SETUJU terhadap Permohonan Cuti Pegawai yang Bersangkutan';
                $persetujuanCuti['type'] = '';
                $persetujuanCuti = PersetujuanCuti::create($persetujuanCuti);

                $persetujuanCutiDetail['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCutiDetail['persetujuan_cuti_id'] = $persetujuanCuti->id;
                $persetujuanCutiDetail['pengajuan_cuti_id'] = $id;
                $persetujuanCutiDetail['status'] = $request->status;
                $persetujuanCutiDetail['pertimbangan_disiplin'] = $request->pertimbangan_disiplin;
                $persetujuanCutiDetail['pertimbangan_disiplin_keterangan'] = $request->pertimbangan_disiplin_keterangan;
                $persetujuanCutiDetail['permasalahan_administrasi_akibatcuti'] = $request->permasalahan_administrasi_akibatcuti;
                $persetujuanCutiDetail['permasalahan_administrasi_akibatcuti_keterangan'] = $request->permasalahan_administrasi_akibatcuti_keterangan;
                $persetujuanCutiDetail['keterangan'] = $request->keterangan;
                $persetujuanCutiDetail['user_id'] = $userId;
                $persetujuanCutiDetail['type'] = 'KABAGTU';
                PersetujuanCutiDetail::create($persetujuanCutiDetail);
                DB::commit();

            }else{
                DB::beginTransaction();
                $persetujuanCuti['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCuti['pengajuan_cuti_id'] = $id;
                $persetujuanCuti['position'] = 'Kepala Distrik Navigasi';
                $persetujuanCuti['role_to_name'] = '';
                $persetujuanCuti['role_to_id'] = null;
                $persetujuanCuti['status'] = 'Done';
                $persetujuanCuti['keterangan'] = $request->keterangan;
                $persetujuanCuti['user_id'] = Auth::user()->id;
                $persetujuanCuti['title'] = 'Permohonan Cuti Ditolak Kabag TU';
                $persetujuanCuti['type'] = '';
                $persetujuanCuti = PersetujuanCuti::create($persetujuanCuti);

                $persetujuanCutiDetail['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCutiDetail['persetujuan_cuti_id'] = $persetujuanCuti->id;
                $persetujuanCutiDetail['pengajuan_cuti_id'] = $id;
                $persetujuanCutiDetail['status'] = $request->status;
                $persetujuanCutiDetail['pertimbangan_disiplin'] = $request->pertimbangan_disiplin;
                $persetujuanCutiDetail['pertimbangan_disiplin_keterangan'] = $request->pertimbangan_disiplin_keterangan;
                $persetujuanCutiDetail['permasalahan_administrasi_akibatcuti'] = $request->permasalahan_administrasi_akibatcuti;
                $persetujuanCutiDetail['permasalahan_administrasi_akibatcuti_keterangan'] = $request->permasalahan_administrasi_akibatcuti_keterangan;
                $persetujuanCutiDetail['keterangan'] = $request->keterangan;
                $persetujuanCutiDetail['user_id'] = $userId;
                $persetujuanCutiDetail['type'] = 'KABAGTU';
                PersetujuanCutiDetail::create($persetujuanCutiDetail);
                PengajuanCuti::where('id', $id)
                    ->update(['status' => 'Ditolak']);
                DB::commit();

                DB::commit();
            }

            return redirect()->route('pengajuan-cuti.index')->with(['success' => 'Pengajuan Cuti berhasil ditindak lanjut !']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('pengajuan-cuti.index')->with(['failed' => $e->getMessage()]);
        }
    }

    public function tindakLanjutKadisnav(Request $request, $id)
    {
        $userId = Auth::user()->id;
        try {
            if ($request->status == 'Disetujui') {
                DB::beginTransaction();
                // --- BUAT APPROVAL KE KABAG TU
                $persetujuanCuti['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCuti['pengajuan_cuti_id'] = $id;
                $persetujuanCuti['position'] = 'Kepala Distrik Navigasi';
                $persetujuanCuti['role_to_name'] = '';
                $persetujuanCuti['role_to_id'] = null;
                $persetujuanCuti['status'] = 'Done';
                $persetujuanCuti['keterangan'] = $request->keterangan;
                $persetujuanCuti['user_id'] = Auth::user()->id;
                $persetujuanCuti['title'] = 'Kepala Distrik Navigasi SETUJU terhadap Permohonan Cuti Pegawai yang Bersangkutan';
                $persetujuanCuti['type'] = '';
                $persetujuanCuti = PersetujuanCuti::create($persetujuanCuti);

                $persetujuanCutiDetail['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCutiDetail['persetujuan_cuti_id'] = $persetujuanCuti->id;
                $persetujuanCutiDetail['pengajuan_cuti_id'] = $id;
                $persetujuanCutiDetail['status'] = $request->status;

                $persetujuanCutiDetail['keterangan'] = $request->keterangan;
                $persetujuanCutiDetail['arahan'] = $request->arahan;
                $persetujuanCutiDetail['user_id'] = $userId;
                $persetujuanCutiDetail['type'] = 'KADISNAV';
                PersetujuanCutiDetail::create($persetujuanCutiDetail);

                PengajuanCuti::where('id',$id)
                    ->update(['status'=>'Disetujui']);
                DB::commit();
            } else {
                DB::beginTransaction();
                // --- BUAT APPROVAL KE KABAG TU
                $persetujuanCuti['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCuti['pengajuan_cuti_id'] = $id;
                $persetujuanCuti['position'] = 'Kepala Distrik Navigasi';
                $persetujuanCuti['role_to_name'] = '';
                $persetujuanCuti['role_to_id'] = null;
                $persetujuanCuti['status'] = 'Done';
                $persetujuanCuti['keterangan'] = $request->keterangan;
                $persetujuanCuti['user_id'] = Auth::user()->id;
                $persetujuanCuti['title'] = 'Kepala Distrik Navigasi Menolak Permohonan Cuti Pegawai yang Bersangkutan';
                $persetujuanCuti['type'] = '';
                $persetujuanCuti = PersetujuanCuti::create($persetujuanCuti);

                $persetujuanCutiDetail['timestamp'] = date('Y-m-d H:i:s');
                $persetujuanCutiDetail['persetujuan_cuti_id'] = $persetujuanCuti->id;
                $persetujuanCutiDetail['pengajuan_cuti_id'] = $id;
                $persetujuanCutiDetail['status'] = $request->status;

                $persetujuanCutiDetail['keterangan'] = $request->keterangan;
                $persetujuanCutiDetail['arahan'] = $request->arahan;
                $persetujuanCutiDetail['user_id'] = $userId;
                $persetujuanCutiDetail['type'] = 'KADISNAV';
                PersetujuanCutiDetail::create($persetujuanCutiDetail);

                PengajuanCuti::where('id', $id)
                    ->update(['status' => 'Ditolak']);
                DB::commit();
            }

            return redirect()->route('pengajuan-cuti.index')->with(['success' => 'Pengajuan Cuti berhasil ditindak lanjut !']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('pengajuan-cuti.index')->with(['failed' => $e->getMessage()]);
        }
    }
}
