<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerkas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kategori_berkas';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $table = 'katergori_berkas';
    
    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'id_kategori_berkas','nama_berkas','kategori_berkas'
    ];
}
