<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormValidasiSoalujianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_validasi_soalujian', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('id_form_validasisoal')->length(3)->primary();
            $table->string('kriteria_penilaian')->length(50);
            $table->string('point_penilaian')->length(50);
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
        Schema::dropIfExists('form_validasi_soalujian');
    }
}
