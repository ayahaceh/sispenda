<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeralihanNop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peralihan_nop', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_formulir')->nullable();
            $table->string('nop');
            $table->string('dari_nik')->nullable();
            $table->string('kepada_nik');
            $table->date('tgl_peralihan');
            $table->unsignedBigInteger('npop');
            $table->unsignedBigInteger('npoptkp');
            $table->unsignedBigInteger('npopkp')->nullable();
            $table->unsignedBigInteger('jumlah')->nullable();
            $table->string('kode_jenis_perolehan');
            $table->string('opsi_a', 5)->nullable();
            $table->string('opsi_b', 5)->nullable();
            $table->string('no_b')->nullable();
            $table->date('tgl_b')->nullable();
            $table->string('opsi_c', 5)->nullable();
            $table->decimal('persen_c', $precision = 6, $scale = 4)->nullable();
            $table->string('uraian_c')->nullable();
            $table->string('opsi_d', 5)->nullable();
            $table->string('uraian_d')->nullable();
            $table->unsignedBigInteger('jumlah_setor')->nullable();
            $table->date('tgl_setor')->nullable();
            $table->string('nama_penyetor')->nullable();
            $table->date('tgl_diterima')->nullable();
            $table->string('diterima_oleh')->nullable();
            $table->string('kode_ppat')->nullable();
            $table->date('tgl_ppat')->nullable();
            $table->string('nama_verifikator')->nullable();
            $table->date('tgl_verifikasi')->nullable();
            $table->string('no_dokumen')->nullable();
            $table->string('nop_pbb_baru')->nullable();

            $table->string('jenis_bayar')->nullable();
            $table->string('no_rekening_bank')->nullable();
            $table->string('no_tagihan_bank')->nullable();
            $table->date('tgl_tagihan_bank')->nullable();
            $table->string('berkas_bukti_pembayaran')->nullable();
            $table->string('berkas_formulir')->nullable();
            $table->dateTime('approved_date')->nullable();
            $table->string('approved_by')->nullable();

            $table->string('approved_status');
            $table->string('status_verifikasi');
            $table->string('status_transaksi');

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
        Schema::dropIfExists('peralihan_nop');
    }
}
