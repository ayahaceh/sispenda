<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebProfilPejabat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_profil_pejabat', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nama_pejabat');
            $table->string('jabatan_pejabat');
            $table->string('uraian_pejabat');
            $table->string('berkas_foto');

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
        Schema::dropIfExists('web_profil_pejabat');
    }
}
