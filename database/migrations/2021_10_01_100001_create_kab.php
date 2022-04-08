<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kab', function (Blueprint $table) {
            $table->smallIncrements('id');
            // $table->unsignedMediumInteger('prov_id');
            $table->string('kode_kab')->nullable();
            $table->string('nama_kab');
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
        Schema::dropIfExists('kab');
    }
}
