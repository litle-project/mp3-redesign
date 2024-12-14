<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LemburDokumen extends Model
{
    use HasFactory;

    public function Lembur() 
    {
        return $this->belongsTo(Lembur::class);
    }
}
