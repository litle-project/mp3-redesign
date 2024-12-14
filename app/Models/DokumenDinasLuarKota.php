<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenDinasLuarKota extends Model
{
    use HasFactory;
    protected $table = 'dokumen_dinas_luar_kota';

    public function transaksiDinasLuarKota()
    {
        return $this->belongsTo(TransaksiDinasLuarKota::class, 'id');
    }
}
