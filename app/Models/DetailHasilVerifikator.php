<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailHasilVerifikator extends Model
{
    use HasFactory;

//    protected $primaryKey = 'id_hasilverifikasi';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'tipe_penilaian_dokumen';

    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'id_kelas_perkuliahan','id_jenis_kelengkapan_dokumen','penilaian','keterangan',
    ];

    public function hasil_verifikasi(){
        return $this->belongsTo(HasilVerifikasi::class,'id_hasilverifikasi','id_hasilverifikasi');
    }

    public function jenis_kelengkapan_berkas(){
        return $this->belongsTo(JenisKelengkapanDokumen::class,'id_jeniskelengkapandokumen','id_jeniskelengkapandokumen');
    }
}
