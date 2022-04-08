<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToBphtb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bphtb', function (Blueprint $table) {
            $table->bigInteger('nip_diterima')->nullable()->after('tgl_diterima');
            $table->bigInteger('nip_verifikator')->nullable()->after('tgl_ppat');
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
