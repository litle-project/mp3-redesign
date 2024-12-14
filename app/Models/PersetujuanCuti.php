<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanCuti extends Model
{
    use HasFactory;

    protected $table = 'persetujuan_cuti';
    protected $guarded = [];

    public function PersetujuanCutiDetail()
    {
        return $this->hasOne(PersetujuanCutiDetail::class, 'persetujuan_cuti_id','id');
    }
}
