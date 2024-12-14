<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PengajuanCuti extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function persetujuanCuti(){
        return $this->hasMany(PersetujuanCuti::class, 'pengajuan_cuti_id');
    }
    public function persetujuanCutiDetail(){
        return $this->hasMany(PersetujuanCutiDetail::class, 'pengajuan_cuti_id')->where('penunjukkan_pelaksana_harian_id',Auth::user()->id);
    }
    public function persetujuanCutiDone(){
        return $this->hasMany(PersetujuanCuti::class, 'pengajuan_cuti_id')->where('status','Done');
    }

    public function persetujuanTerakhir(){
        return PersetujuanCuti::where('pengajuan_cuti_id',$this->id)
            ->orderBy('id','desc')
            ->first();
    }
    public function isNotify(){
        $persetujuanCuti = PersetujuanCuti::where('pengajuan_cuti_id',$this->id)
            ->orderBy('id','desc')
            ->first();
        if ($persetujuanCuti) {
        }else{
            return false;
        }
    }

}
