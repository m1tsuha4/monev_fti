<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKurikulumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurikulums', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->id();
            $table->integer('tahun_kurikulum');
            $table->string('kode_prodi')->length(5);
            $table->integer('status');
            $table->timestamps();
        });
        Schema::table('kurikulums', function (Blueprint $table) {
            $table->foreign('kode_prodi')->references('kode_prodi')->on('prodis')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kurikulums');
    }
}
