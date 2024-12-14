<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftUser extends Model
{
    use HasFactory;

    public function Shifts() 
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function Users() 
    {
        return $this->belongsToMany(User::class, 'user_id');
    }
}
