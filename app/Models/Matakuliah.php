<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_matakuliah';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'matakuliahs';

    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'kode_matakuliah','tahun_kurikulum','nama_matakuliah','kategori_matakuliah',
        'estimasi_mahasiswa','jumlah_sks','semester','jumlah_kelas',
    ];

    public function kurikulum(){
        return $this->belongsTo(Kurikulum::class,'tahun_kurikulum','id');
    }
}
