<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifBphtb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarif_bphtb', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('kode_tarif_bphtb');
            $table->decimal('persen_tarif_bphtb', $precision = 6, $scale = 4);
            $table->string('ket_tarif_bphtb')->nullable();
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
        Schema::dropIfExists('tarif_bphtb');
    }
}
