<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetupJamKerja extends Model
{
    use HasFactory;

    public function Instalasis() 
    {
        return $this->belongsTo(Instalasi::class, 'instalasi_id');
    }
}
