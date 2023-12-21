<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tahun_akademik';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'tahun_akademik';
    
    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'id_tahun_akademik','tahun','semester','status'
    ];
}
