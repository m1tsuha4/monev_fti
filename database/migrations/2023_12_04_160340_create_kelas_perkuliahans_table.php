<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasPerkuliahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas_perkuliahans', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->integer('id_kelas_perkuliahan');
            $table->string('kode_matakuliah')->length(10);
            $table->integer('id_tahun_akademik');
            $table->string('kelas');
            $table->string('keterangan')->length(50)->nullable();
            $table->string('file_rps')->nullable();
            $table->string('file_kontrak_perkuliahan')->nullable();
            $table->string('file_rtm')->nullable();
            $table->string('timeline_perkuliahan')->length(20)->nullable();
            $table->integer('status')->default(0);
            $table->dateTime('tanggal_verifikasi')->nullable();
            $table->string('tanda_tangan_gkm')->nullable();
            $table->string('dosen_verifikator')->length(18);
            $table->string('tanda_tangan_verifikator')->nullable();
            $table->string('catatan')->length(50)->nullable();
            $table->string('komentar_perbaikan')->length(50)->nullable();
            $table->timestamps();
            $table->primary(['id_kelas_perkuliahan', 'kode_matakuliah', 'id_tahun_akademik', 'kelas','dosen_verifikator'], 'pk_kelasperkuliahan');
        });

        Schema::table('kelas_perkuliahans', function (Blueprint $table) {
            $table->foreign('kode_matakuliah')->references('kode_matakuliah')->on('matakuliahs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_tahun_akademik')->references('id_tahun_akademik')->on('tahun_akademik')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('dosen_verifikator')->references('nip_dosen')->on('dosen')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas_perkuliahans');
    }
}
