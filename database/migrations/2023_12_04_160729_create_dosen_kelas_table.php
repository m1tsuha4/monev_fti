<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_kelas', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('nip_dosen')->length(18);
            $table->integer('id_kelas_perkuliahan');
            $table->timestamps();
            $table->primary(['nip_dosen', 'id_kelas_perkuliahan']);
        });
        Schema::table('dosen_kelas', function (Blueprint $table) {
            $table->foreign('nip_dosen')->references('nip_dosen')->on('dosen')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('dosen_kelas');
    }
}
