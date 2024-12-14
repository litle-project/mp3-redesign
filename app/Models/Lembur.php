<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Users() 
    {
        return $this->belongsToMany(User::class, 'lembur_users', 'lembur_id');

    }

    public function documents()
    {
        return $this->hasMany(LemburDokumen::class);
    }

    public function LemburUsers() 
    {
        return $this->hasMany(LemburUser::class, 'lembur_id');
    }
}
