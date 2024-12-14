<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'foto',
        'nip',
        'nik',
        'npwp',
        'jenis_kelamin',
        'status_pegawai',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_ktp',
        'alamat_tinggal',
        'longitude',
        'latitude',
        'nomor_telepon',
        'password',
        'pangkat_id'
    ];

    public function Shift()
    {
        return $this->hasOne(Shift::class);
    }
    public function PengajuanCuti()
    {
        return $this->hasOne(PengajuanCuti::class);
    }

    public function Pangkats()
    {
        return $this->belongsTo(Pangkat::class, 'pangkat_id');
    }
    public function ShiftUsers()
    {
        return $this->hasMany(ShiftUser::class);
    }
    public function WorkFromOffice()
    {
        return $this->hasOne(WorkFromOffice::class);
    }
    public function Absensi()
    {
        return $this->hasOne(Absensi::class);
    }
    public function StrukturOrganisasi()
    {
        return $this->hasOne(StrukturOrganisasi::class);
    }
    public function pegawaiDinasLuarKota() 
    {
        return $this->hasMany(PegawaiDinasLuarKota::class);
    }
    public function LemburUsers() 
    {
        return $this->hasMany(LemburUser::class);
    }
    public function bawahanName()
    {
        return User::where('role_atasan_name',Auth::user()->roles->first()->name)->get()->pluck('name')->toArray();
    }
    public function bawahan()
    {
        return User::where('role_atasan_name',Auth::user()->roles->first()->name)->get();
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
