<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_soal', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->integer('id_soal')->primary();
            $table->integer('id_kelas_perkuliahan');
            $table->string('nama_soal')->length(30);
            $table->string('file_soal')->length(255);
            $table->integer('status')->default(0);
            $table->string('keterangan')->length(50)->nullable();
            $table->timestamps();
        });
        Schema::table('berkas_soal', function (Blueprint $table) {
            $table->foreign('id_kelas_perkuliahan')->references('id_kelas_perkuliahan')->on('kelas_perkuliahans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berkas_soal');
    }
}
