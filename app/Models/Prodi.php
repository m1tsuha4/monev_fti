<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_prodi';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'prodis';
    
    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'kode_prodi','nama_prodi','jenjang_pendidikan'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
