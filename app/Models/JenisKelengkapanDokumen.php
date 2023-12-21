<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKelengkapanDokumen extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jenis_kelengkapan_dokumen';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'form_kelengkapan_dokumen';

    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'id_jenis_kelengkapan_dokumen','point_penilaian_kelengkapan_dokumen','tipe_penilaian'
    ];
}
