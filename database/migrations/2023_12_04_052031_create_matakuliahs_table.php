<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatakuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matakuliahs', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('kode_matakuliah')->length(10)->primary();
            $table->unsignedBigInteger('tahun_kurikulum');
            $table->foreign('tahun_kurikulum')->references('id')->on('kurikulums')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_matakuliah')->length(35);
            $table->integer('jumlah_kelas');
            $table->string('kategori_matakuliah')->length(20);
            $table->integer('estimasi_mahasiswa');
            $table->integer('semester');
            $table->integer('jumlah_sks');
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
        Schema::dropIfExists('matakuliahs');
    }
}
