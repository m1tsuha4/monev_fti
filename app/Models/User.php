<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'nip_dosen';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'dosen';

    protected $guard = 'user';

    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $appends = ['foto_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip_dosen','kode_prodi','nama_dosen','jabatan','foto','email','status','password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function prodi(){
        return $this->belongsTo(Prodi::class,'kode_prodi','kode_prodi');
    }

    public function getFotoUrlAttribute()
    {
        return Storage::url(''.$this->foto);
    }
}
