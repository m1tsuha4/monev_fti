<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormKelengkapanDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_kelengkapan_dokumen', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('id_jenis_kelengkapan_dokumen')->length(3)->primary();
            $table->string('tipe_penilaian')->length(50);
            $table->string('point_penilaian_kelengkapan_dokumen')->length(150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_kelengkapan_dokumen');
    }
}
