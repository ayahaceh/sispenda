<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTelpToSatkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('satkers', function (Blueprint $table) {
            $table->string('telp_satker')->nullable()->after('prov_Satker');
            $table->string('email_satker')->nullable()->after('telp_satker');
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
