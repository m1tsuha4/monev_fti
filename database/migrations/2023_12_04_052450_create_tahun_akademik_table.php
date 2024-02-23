<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunAkademikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahun_akademik', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->id('id_tahun_akademik');
            $table->integer('tahun');
            $table->string('semester')->length(1);
            $table->integer('status');
            $table->timestamps();
            $table->unique(['tahun','semester'],'UC_tahun_akademik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahun_akademik');
    }
}
