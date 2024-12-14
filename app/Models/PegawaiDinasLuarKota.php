<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiDinasLuarKota extends Model
{
    use HasFactory;
    protected $table = 'pegawai_dinas_luar_kota';

    public function transaksiDinasLuarKota() 
    {
        return $this->belongsTo(TransaksiDinasLuarKota::class, 'dinas_luar_id');
    }

    public function Users() 
    {
        return $this->belongsToMany(User::class, 'user_id');
    }
}
