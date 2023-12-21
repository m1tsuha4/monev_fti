<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_monitoring';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'monitoringbap';

    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
       'pertemuan','id_kelas_perkuliahan','nip_dosen', 'jumlah_mahasiswa_hadir','tanggal',
        'materi','jam_mulai','jam_selesai','bukti','rencana_pembelajaran','assesment','realisasi_pembelajaran'
    ];

    public function hasil_verifikasi(){
        return $this->belongsTo(HasilVerifikasi::class,'id_hasilverifikasi','id_hasilverifikasi');
    }
}
