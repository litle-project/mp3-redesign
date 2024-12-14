<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KegiatanLuarKantor extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_luar_kantor';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function approvalTerakhir()
    {
        return ApprovalKegiatanLuarKantor::where('kegiatan_luar_kantor_id', $this->id)
            ->orderBy('id', 'desc')
            ->first();
    }
    public function approval()
    {
        return $this->hasMany(ApprovalKegiatanLuarKantor::class, 'kegiatan_luar_kantor_id', 'id');
    }
    public function personilDinas()
    {
        return $this->hasMany(PersonilLuarKantor::class,'kegiatan_luar_kantor_id','id');
    }
    public function dokumenPendukung()
    {
        return $this->hasMany(DokumenPendukungKegiatanLuarKantor::class,'kegiatan_luar_kantor_id','id');
    }

    public function tambahWaktuPerluAksi()
    {

        return $this->hasMany(TambahJamKegiatan::class, 'kegiatan_luar_kantor_id', 'id')
            ->where('status','pending')
            ->where('kegiatan_luar_kantor_id', $this->id)
            ->where('role_to_name',Auth::user()->roles->first()->name ?? null)
            ;
    }
    public function tambahWaktuPemilikData()
    {
        // Untuk list masing pengaju waktu tambahan
        return $this->hasMany(TambahJamKegiatan::class, 'kegiatan_luar_kantor_id', 'id')
            ->where('approve_by',Auth::user()->id ?? null)
            ->where('kegiatan_luar_kantor_id', $this->id)
            ;
    }
    public function tambahWaktuKu()
    {
        // Untuk list masing pengaju waktu tambahan
        return $this->hasMany(TambahJamKegiatan::class, 'kegiatan_luar_kantor_id', 'id')
            ->where('user_id',Auth::user()->id ?? null)
            ->where('kegiatan_luar_kantor_id', $this->id)
            ;
    }
    public function tambahWaktuKuWait()
    {
        // Untuk Chek apakah ada pengajuan yang menunggu
        return $this->hasMany(TambahJamKegiatan::class, 'kegiatan_luar_kantor_id', 'id')
            ->where('status','pending')
            ->where('kegiatan_luar_kantor_id', $this->id)
            ->where('user_id',Auth::user()->id ?? null)
            ;
    }

    public function tambahWaktuApproveByPersonil(){
        return TambahJamKegiatan::where('user_id',Auth::user()->id)
            ->where('status','done')
            ->where('kegiatan_luar_kantor_id', $this->id)
            ->orderBy('id','desc')
            ->first();
    }

    public function tambahWaktuSelesai(){
        $tambahJam = TambahJamKegiatan::where('user_id',Auth::user()->id)
            ->where('status','done')
            ->where('kegiatan_luar_kantor_id',$this->id)
            ->orderBy('id','desc')
            ->first();

        if ($tambahJam) {
            # code...
            $selectedTime = $this->jam_selesai_kegiatan.':00';
            $endTime = strtotime("+{$tambahJam->tambahan_jam} hours", strtotime($selectedTime));
            return date('H:i', $endTime);
        }else{
            return null;
        }
    }
    public function absensiTambahWaktuSelesai($id, $kegiatan, $jamMulai, $jamSelesai){
        $tambahJam = TambahJamKegiatan::where('user_id',$id)
            ->where('status','done')
            ->where('kegiatan_luar_kantor_id',$kegiatan)
            ->orderBy('id','desc')
            ->first();
        if ($tambahJam) {
            # code...
            $selectedTime = $jamSelesai.':00';
            $endTime = strtotime("+{$tambahJam->tambahan_jam} hours", strtotime($selectedTime));
            return  ['jam_mulai_kegiatan' => $jamMulai,'jam_selesai_kegiatan' => date('H:i', $endTime)];
        }else{
            return ['jam_mulai_kegiatan' => $jamMulai,'jam_selesai_kegiatan' => $jamSelesai];
        }
    }


}
