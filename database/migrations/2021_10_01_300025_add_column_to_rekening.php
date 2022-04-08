<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToRekening extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekening', function (Blueprint $table) {
            $table->string('gambar_qris')->nullable()->after('nama_rekening');
            $table->string('gambar_rekening')->nullable()->after('gambar_qris');
            $table->string('gambar_logo_bank')->nullable()->after('gambar_rekening');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('rekening');
    }
}
