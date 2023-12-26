<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringbapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoringbap', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->integer('pertemuan');
            $table->integer('id_kelas_perkuliahan');
            $table->string('nip_dosen')->length(18);
            $table->integer('jumlah_mahasiswa_hadir');
            $table->dateTime('tanggal');
            $table->string('materi')->length(50);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('bukti')->length(255);
            $table->string('rencana_pembelajaran')->length(255);
            $table->string('realisasi_pembelajaran')->length(255);
            $table->string('assesment')->length(255);
            $table->timestamps();
            $table->primary(['id_kelas_perkuliahan','pertemuan'],'pk_monitoringbap');
        });

        Schema::table('monitoringbap', function (Blueprint $table) {
            $table->foreign('id_kelas_perkuliahan')->references('id_kelas_perkuliahan')->on('dosen_kelas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitoringbap');
    }
}
