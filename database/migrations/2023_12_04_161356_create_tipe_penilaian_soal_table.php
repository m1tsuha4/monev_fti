<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipePenilaianSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_penilaian_soal', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('id_form_validasisoal')->length(3);
            $table->integer('id_soal');
            $table->enum('penilaian_soal',['Ada','Tidak Ada']);
            $table->string('keterangan')->length(20);
            $table->timestamps();
            $table->primary(['id_form_validasisoal', 'id_soal']);
        });
        Schema::table('tipe_penilaian_soal', function (Blueprint $table) {
            $table->foreign('id_soal')->references('id_soal')->on('berkas_soal')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_form_validasisoal')->references('id_form_validasisoal')->on('form_validasi_soalujian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_penilaian_soal');
    }
}
