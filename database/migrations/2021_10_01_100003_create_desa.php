<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desa', function (Blueprint $table) {
            $table->mediumIncrements('id');
            // $table->unsignedMediumInteger('prov_id');
            // $table->unsignedMediumInteger('kab_id');
            // $table->unsignedMediumInteger('kec_id');
            $table->string('kode_desa')->nullable();
            $table->string('nama_desa');
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
        Schema::dropIfExists('desa');
    }
}
