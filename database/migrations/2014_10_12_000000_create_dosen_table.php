<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // <- add this
            $table->string('nip_dosen')->length(18)->primary();
            $table->string('kode_prodi')->length(5);
            $table->string('nama_dosen')->length(30);
            $table->string('foto')->length(255)->nullable();
            $table->string('jabatan')->length(30);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('status');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('dosen', function (Blueprint $table) {
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
        Schema::dropIfExists('users');
    }
}
