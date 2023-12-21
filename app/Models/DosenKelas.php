<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenKelas extends Model
{
    use HasFactory;
    protected $table = 'dosen_kelas';
    protected $fillable = ['nip_dosen','id_kelas_perkuliahan'];
}
