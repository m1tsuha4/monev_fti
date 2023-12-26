<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePenilaianSoal extends Model
{
    use HasFactory;
    
    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'tipe_penilaian_soal';

    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'id_form_validasisoal','id_soal','penilaian_soal','keterangan',
    ];

}
