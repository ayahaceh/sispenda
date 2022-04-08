<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNopPbb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nop_pbb', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik');
            $table->string('nop')->nullable();
            $table->string('letak')->nullable();
            $table->string('kode_prov');
            $table->string('kode_kab');
            $table->string('kode_kec');
            $table->string('kode_desa');
            $table->string('rtrw')->nullable();

            $table->decimal('luas_tanah', $precision = 12, $scale = 2);
            $table->unsignedInteger('njop_tanah');
            $table->decimal('luas_bangunan', $precision = 12, $scale = 2);
            $table->unsignedInteger('njop_bangunan');
            $table->string('kode_jenis_perolehan');
            $table->unsignedBigInteger('hak_nilai_pasar');
            $table->string('no_sertifikat');

            $table->string('status_nop_pbb');
            $table->string('kode_ppat')->nullable();

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
        Schema::dropIfExists('nop_pbb');
    }
}
