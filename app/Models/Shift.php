<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Users() 
    {
        return $this->belongsToMany(User::class, 'shift_users', 'shift_id');
    }

    public function Instalasis() 
    {
        return $this->belongsTo(Instalasi::class, 'instalasi_id');
    }

    public function ShiftUsers() 
    {
        return $this->hasMany(ShiftUser::class, 'shift_id');
    }


}
