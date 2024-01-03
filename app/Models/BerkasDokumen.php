<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasDokumen extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_soal';

    protected $table = 'berkas_soal';

    protected $rememberTokenName = false;

    public $timestamps = true;

    protected $fillable = [
        'id_soal', 'id_kelas_perkuliahan', 'nama_soal', 'file_soal','status','keterangan'
    ];

//    public function kelas_perkuliahan(){
//        return $this->belongsTo(KelasPerkuliahan::class,'id_kelasperkuliahan','id_kelasperkuliahan');
//    }
//
//    public function kategori_berkas(){
//        return $this->belongsTo(KategoriBerkas::class,'id_kategori_berkas','id_kategori_berkas');
//    }
}
