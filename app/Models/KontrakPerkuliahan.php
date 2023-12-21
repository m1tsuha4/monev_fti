<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakPerkuliahan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'kontrakperkuliahans';
    
    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'id','uraian','keterangan','berkas_id'
    ];

    public function berkas_dokumen(){
        return $this->belongsTo(BerkasDokumen::class,'berkas_id','id');
    }
}
