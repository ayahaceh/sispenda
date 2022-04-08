<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLuasColumnToBphtb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bphtb', function (Blueprint $table) {
            $table->unsignedInteger('luas_tanah')->change();
            $table->unsignedInteger('luas_bangunan')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('bphtb', function (Blueprint $table) {
        //     //
        // });
    }
}
