<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBerkasToBphtb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bphtb', function (Blueprint $table) {
            $table->string('berkas_ktp', 255)->nullable()->after('kode_pos_wp');
            $table->string('berkas_ajb', 255)->nullable()->after('kode_jenis_perolehan');
            $table->string('berkas_sertifikat', 255)->nullable()->after('no_sertifikat');
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
