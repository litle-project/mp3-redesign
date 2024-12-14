<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanCutiDetail extends Model
{
    use HasFactory;
    protected $table = 'persetujuan_cuti_detail';
    protected $guarded = [];

    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function userDitunjuk()
    {
        return $this->belongsTo(User::class, 'penunjukkan_pelaksana_harian_id','id');
    }
}
