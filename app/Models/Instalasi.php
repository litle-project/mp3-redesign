<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Shift() 
    {
        return $this->hasOne(Shift::class);
    }

    public function SetupJamKerja() 
    {
        return $this->hasOne(SetupJamKerja::class);
    }
}
