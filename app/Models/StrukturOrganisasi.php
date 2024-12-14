<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;
    public function parent()
    {
        return $this->belongsTo(StrukturOrganisasi::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(StrukturOrganisasi::class, 'parent_id');
    }
    public function Users() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
