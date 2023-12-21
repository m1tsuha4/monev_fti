<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPenilaian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_hasilverifikasi';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'hasil_penilaian';
    
    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'id_jeniskelengkapandokumen','id_hasilverifikasi','penilaian','keterangan'
    ];

    public function hasil_verifikasi(){
        return $this->belongsTo(HasilVerifikasi::class,'id_hasilverifikasi','id_hasilverifikasi');
    }

    public function jenis_kelengkapan_dokumen(){
        return $this->belongsTo(JenisKelengkapanDokumen::class,'id_jeniskelengkapandokumen','id_jeniskelengkapandokumen');
    }
}
