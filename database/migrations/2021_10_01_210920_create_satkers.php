<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSatkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satkers', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nama_satker');
            $table->string('alamat_satker')->nullable();
            $table->string('ket_satker')->nullable();

            $table->string('nama_satkera')->nullable();
            $table->string('nama_satkerb')->nullable();
            $table->string('kota_satker')->nullable();
            $table->string('prov_satker')->nullable();
            $table->string('logo_satker')->nullable();
            $table->string('nama_kepala')->nullable();
            $table->string('nip_kepala')->nullable();
            $table->string('jab_kepala')->nullable();
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
        Schema::dropIfExists('satkers');
    }
}
