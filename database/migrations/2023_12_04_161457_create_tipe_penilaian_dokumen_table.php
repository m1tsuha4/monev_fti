<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipePenilaianDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_penilaian_dokumen', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id_jenis_kelengkapan_dokumen', 3);
            $table->integer('id_kelas_perkuliahan');
            $table->enum('penilaian',['Cukup','Baik','Sangat Baik']);
            $table->string('keterangan', 20);
            $table->timestamps();
            $table->primary(['id_jenis_kelengkapan_dokumen', 'id_kelas_perkuliahan'], 'pk_tipe_penilaian_dokumen');
        });

        Schema::table('tipe_penilaian_dokumen', function (Blueprint $table) {
            $table->foreign('id_kelas_perkuliahan')->references('id_kelas_perkuliahan')->on('kelas_perkuliahans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_jenis_kelengkapan_dokumen')->references('id_jenis_kelengkapan_dokumen')->on('form_kelengkapan_dokumen')->onUpdate('cascade')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_penilaian_dokumen');
    }
}
