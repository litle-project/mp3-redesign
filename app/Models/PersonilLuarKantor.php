<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonilLuarKantor extends Model
{
    use HasFactory;
    protected $table = 'personil_luar_kantor';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'pegawai_id','id');
    }

}
