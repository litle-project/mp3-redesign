<?php

namespace App\Models;

use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDinasLuarKota extends Model
{
    use HasFactory;
    protected $table = 'transaksi_dinas_luar_kota';

    public function Users() 
    {
        return $this->belongsToMany(User::class, 'pegawai_dinas_luar_kota', 'dinas_luar_id');
    }

    public function dokumenDinasLuarKotas()
    {
        return $this->hasMany(DokumenDinasLuarKota::class, 'dinas_luar_id');
    }

    public function pegawaiDinasLuarKota() 
    {
        return $this->hasMany(PegawaiDinasLuarKota::class, 'dinas_luar_id');
    }

    public function getTotalHariDinas($mulai, $selesai){
    
        $start = $mulai;
        $end = $selesai;
        $period = CarbonPeriod::create($start, $end);
        return count($period);
       
    }
}
