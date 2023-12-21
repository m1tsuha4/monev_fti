<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    protected $table = 'kurikulums';

    protected $rememberTokenName = false;

    public $timestamps = false;

    protected $fillable = [
        'id','tahun_kurikulum','kode_prodi','status'
    ];
}
