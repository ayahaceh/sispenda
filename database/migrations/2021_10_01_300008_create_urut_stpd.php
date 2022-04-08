<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrutStpd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urut_stpd', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('peralihan_nop_id');
            $table->string('kode_desa');
            $table->unsignedSmallInteger('nomor_urut');
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
        Schema::dropIfExists('urut_stpd');
    }
}
