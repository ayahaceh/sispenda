<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik')->unique(); // Relasi ke tabel users
            $table->string('kk')->nullable();
            $table->string('nama');
            $table->string('jk');
            $table->string('alamat');
            $table->string('kode_prov');
            $table->string('kode_kab');
            $table->string('kode_kec');
            $table->string('kode_desa');
            $table->string('rtrw')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('hp')->nullable();
            $table->string('wa')->nullable();
            $table->string('tg')->nullable();
            $table->string('email')->nullable();
            $table->string('berkas_foto')->nullable();
            $table->string('berkas_ktp')->nullable();
            $table->string('berkas_kk')->nullable();
            $table->unsignedTinyInteger('jenis_profil_id');
            $table->string('status_profil');
            $table->string('kode_ppat')->nullable();

            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profil');
    }
}
