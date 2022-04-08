<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kec', function (Blueprint $table) {
            $table->smallIncrements('id');
            // $table->unsignedMediumInteger('prov_id');
            // $table->unsignedMediumInteger('kab_id');
            $table->string('kode_kec')->nullable();
            $table->string('nama_kec');
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
        Schema::dropIfExists('kec');
    }
}
