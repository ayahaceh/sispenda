<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePbb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbb', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_formulir');
            $table->date('tgl_pbb');

            // Profil
            $table->string('nik');
            $table->string('nama_wp');
            $table->string('alamat_wp');
            $table->string('kode_prov_wp');
            $table->string('kode_kab_wp');
            $table->string('kode_kec_wp');
            $table->string('kode_desa_wp');
            $table->string('rtrw_wp')->nullable();
            $table->string('kode_pos_wp')->nullable();
            //Nop
            $table->string('nop')->nullable();
            $table->string('letak_nop')->nullable();
            $table->string('kode_prov_nop');
            $table->string('kode_kab_nop');
            $table->string('kode_kec_nop');
            $table->string('kode_desa_nop');
            $table->string('rtrw_nop')->nullable();

            $table->decimal('luas_tanah', $precision = 12, $scale = 2);
            $table->unsignedInteger('njop_tanah')->nullable();
            $table->decimal('luas_bangunan', $precision = 12, $scale = 2);
            $table->unsignedInteger('njop_bangunan')->nullable();
            // $table->unsignedBigInteger('hak_nilai_pasar');

            // Ga penting
            $table->string('kode_jenis_perolehan')->nullable();
            $table->string('no_sertifikat')->nullable();
            $table->string('kelas')->nullable();

            // PBB
            $table->unsignedBigInteger('jumlah_njop');
            $table->unsignedBigInteger('jumlah_njoptkp');
            $table->unsignedBigInteger('jumlah_njop_pbb');
            $table->unsignedBigInteger('jumlah_terhutang');
            $table->date('tgl_jatuh_tempo')->nullable();

            // Pelunasan
            $table->unsignedBigInteger('jumlah_setor')->nullable();
            $table->date('tgl_setor')->nullable();
            $table->string('nama_penyetor')->nullable();
            $table->string('nama_verifikator')->nullable();
            $table->date('tgl_verifikasi')->nullable();
            //Rekening
            $table->string('no_rekening_bank')->nullable();
            $table->string('berkas_bukti_pembayaran')->nullable();
            $table->string('berkas_formulir')->nullable();

            // Kolom Status Pembayaran
            // 1. Belum Lunas, 2. Sedang Verifikasi Pembayaran, 3. Lunas
            $table->string('status_pembayaran');

            // Kolom Status pbb (Konstanta)
            // 1. Belum Verifikasi, 2. Sudah Verifikasi,
            // 3. Belum Disetujui, 4. Sudah Disetujui
            $table->string('status_pbb');
            $table->dateTime('tgl_persetujuan')->nullable();
            $table->string('user_persetujuan')->nullable();

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
        Schema::dropIfExists('pbb');
    }
}
