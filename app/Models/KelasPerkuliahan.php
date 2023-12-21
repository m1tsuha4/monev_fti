<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasPerkuliahan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kelas_perkuliahan';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'kelas_perkuliahans';

    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'id_kelas_perkuliahan','kode_matakuliah','keterangan','kelas',
        'id_tahun_akademik','file_rps','file_kontrak_perkuliahan', 'file_rtm','timeline_perkuliahan',
        'status','tanggal_verifikasi','tanda_tangan_gkm','tanda_tangan_verifikator','catatan','komentar_perbaikan','dosen_verifikator'
    ];

    public function dosen_pengampu(){
        return $this->belongsTo(User::class,'nip_dosen','nip_dosen');
    }

    public function matakuliah(){
        return $this->belongsTo(Matakuliah::class,'kode_matakuliah','kode_matakuliah');
    }

    public function tahun_akademik(){
        return $this->belongsTo(TahunAkademik::class,'id_tahun_akademik','id_tahun_akademik');
    }

    public function verifikator(){
        return $this->hasMany(HasilVerifikasi::class);
    }
}
