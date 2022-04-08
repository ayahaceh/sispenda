<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNpopTkp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('npop_tkp', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('kode_npop_tkp');
            $table->unsignedInteger('tarif_npop_tkp');
            $table->string('ket_npop_tkp')->nullable();
            $table->string('default');

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
        Schema::dropIfExists('npop_tkp');
    }
}
