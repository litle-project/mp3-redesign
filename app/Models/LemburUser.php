<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LemburUser extends Model
{
    use HasFactory;

    public function Lembur() 
    {
        return $this->belongsTo(Lembur::class, 'lembur_id');
    }

    public function Users() 
    {
        return $this->belongsToMany(User::class, 'user_id');
    }
}
