<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HasilVerifikasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_hasilverifikasi';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'hasilverifikasi';

    protected $appends = ['ttd_url','ttd_url1'];

    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'id_hasilverifikasi','id_kelasperkuliahan','status','tanggal_verifikasi','timeline_perkuliahan',
        'tanda_tangan_verifikator','tanda_tangan_gkm','catatan','nip_dosen'
    ];

    public function dosen_verifikator(){
        return $this->belongsTo(User::class,'nip_dosen','nip_dosen');
    }

    public function kelas_perkuliahan(){
        return $this->belongsTo(KelasPerkuliahan::class,'id_kelasperkuliahan','id_kelasperkuliahan');
    }

    public function monitoring(){
        return $this->hasMany(Monitoring::class);
    }

    public function detailhasil(){
        return $this->hasMany(DetailHasilVerifikator::class);
    }

    // public function getTtdUrlGkmAttribute()
    // {
    //     return Storage::url(''.$this->tanda_tangan_gkm);
    // }

    public function getTtdUrlAttribute()
    {
        return Storage::url(''.$this->tanda_tangan_verifikator);
    }
    public function getTtdUrl1Attribute()
    {
        return Storage::url(''.$this->tanda_tangan_gkm);
    }
}
