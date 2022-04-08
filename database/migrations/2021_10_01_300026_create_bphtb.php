<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBphtb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bphtb', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_bphtb');

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
            $table->unsignedBigInteger('hak_nilai_pasar');

            $table->string('kode_jenis_perolehan');
            $table->string('no_sertifikat');
            // BPHTB
            $table->unsignedBigInteger('npop');
            $table->unsignedBigInteger('npoptkp');
            $table->unsignedBigInteger('npopkp');
            $table->unsignedBigInteger('jumlah_bphtb');
            // $table->string('kode_jenis_perolehan');
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
            // Penanda Tangan
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
            //Pembayaran
            $table->string('no_rekening_bank')->nullable();
            $table->string('berkas_bukti_pembayaran')->nullable();
            $table->string('berkas_formulir')->nullable();

            // Kolom Status Pembayaran
            // 1. Belum Lunas, 2. Sedang Verifikasi Pembayaran, 3. Lunas
            $table->string('status_pembayaran');

            // Kolom Status BPHTB (Konstanta)
            // 1. Belum Verifikasi, 2. Sudah Verifikasi,
            // 3. Belum Disetujui, 4. Sudah Disetujui
            $table->string('status_bphtb');
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
        Schema::dropIfExists('bphtb');
    }
}
