<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifNjop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarif_njop', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('kode_tarif_njop');
            $table->string('kode_desa');
            $table->unsignedInteger('jumlah_tarif_njop');
            $table->string('ket_tarif_njop')->nullable();
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
        Schema::dropIfExists('tarif_njop');
    }
}
