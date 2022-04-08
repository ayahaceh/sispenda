<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnToProfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profil', function (Blueprint $table) {
            $table->string('jk')->nullable()->change();
            $table->string('alamat')->nullable()->change();
            $table->string('kode_prov')->nullable()->change();
            $table->string('kode_kab')->nullable()->change();
            $table->string('kode_kec')->nullable()->change();
            $table->string('kode_desa')->nullable()->change();
            $table->string('status_profil')->nullable()->change();
            $table->string('created_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('profil');
    }
}
