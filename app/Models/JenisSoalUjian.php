<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSoalUjian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_form_validasisoal';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'form_validasi_soalujian';

    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'id_form_validasisoal','kriteria_penilaian','point_penilaian'
    ];
}
