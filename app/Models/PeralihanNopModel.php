<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProfilModel;
use App\Models\DasarSetoranModel;
use App\Models\NopPbbModel;
use App\Models\Referensi\JenisPerolehanModel;
use App\Models\Referensi\RekeningModel;

class PeralihanNopModel extends Model
{
    protected $table = 'peralihan_nop';
    public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'tgl',
        'no_formulir',
        'nop',
        'dari_nik',
        'kepada_nik',
        'tgl_peralihan',
        'npop',
        'npoptkp',
        'npopkp',
        'jumlah',
        'kode_jenis_perolehan',
        'opsi_a',
        'opsi_b',
        'no_b',
        'tgl_b',
        'opsi_c',
        'persen_c',
        'uraian_c',
        'opsi_d',
        'uraian_d',
        'jumlah_setor',
        'tgl_setor',
        'nama_penyetor',
        'tgl_diterima',
        'diterima_oleh',
        'kode_ppat',
        'tgl_ppat',
        'nama_verifikator',
        'tgl_verifikasi',
        'status_verifikasi',
        'no_dokumen',
        'nop_pbb_baru',
        'jenis_bayar',
        'no_rekening_bank',
        'no_tagihan_bank',
        'tgl_tagihan_bank',
        'status_transaksi',
        'berkas_bukti_pembayaran',
        'berkas_formulir',
        // Penambahan Kolom Persetujuan Pejabat
        'approved_date',
        'approved_by',
        'approved_status',

        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public $appends = [
        'jl_jumlah_setor',
        'file_berkas_bukti_pembayaran',
        'format_nik_dari',
        'format_nik_kepada',
        'format_nop',
        'format_npop', 'format_npoptkp', 'format_npopkp', 'format_jumlah', 'format_jumlah_setor',
        // 'format_luas_tanah',
        // 'format_luas_bangunan',
        // 'format_njop_tanah',
        // 'format_njop_bangunan',
        // 'format_jumlah_tanah',
        // 'format_jumlah_bangunan',
    ];
    public function getFormatNpopAttribute()
    {
        return number_format($this->npop, 0, ",", ".");
    }
    public function getFormatNpoptkpAttribute()
    {
        return number_format($this->npoptkp, 0, ",", ".");
    }
    public function getFormatNpopkpAttribute()
    {
        return number_format($this->npopkp, 0, ",", ".");
    }
    public function getFormatJumlahAttribute()
    {
        return number_format($this->jumlah, 0, ",", ".");
    }
    public function getFormatJumlahSetorAttribute()
    {
        return number_format($this->jumlah_setor, 0, ",", ".");
    }
    // public function getFormatLuasBangunanAttribute()
    // {
    //     return number_format($this->jumlah_setor, 0, ",", ".");
    // }
    // public function getFormatNjopTanahAttribute()
    // {
    //     return number_format($this->jumlah_setor, 0, ",", ".");
    // }
    // public function getFormatNjopBangunanAttribute()
    // {
    //     return number_format($this->jumlah_setor, 0, ",", ".");
    // }
    // public function getFormatJumlahTanahAttribute()
    // {
    //     return number_format($this->jumlah_setor, 0, ",", ".");
    // }
    // public function getFormatJumlahBangunanAttribute()
    // {
    //     return number_format($this->jumlah_setor, 0, ",", ".");
    // }


    public function getJlJumlahSetorAttribute()
    {
        return number_format($this->jumlah_setor, 0, ",", ".");
    }
    public function getFileBerkasBuktiPembayaranAttribute()
    {
        return url('upload/berkas_bukti_pembayaran/' . $this->berkas_bukti_pembayaran);
    }
    public function getFormatNopAttribute()
    {
        $i = $this->nop;
        $j = ' ';
        $k = ' ';

        $a = substr($i, 0, 2);
        $b = substr($i, 2, 2);
        $c = substr($i, 4, 3);
        $d = substr($i, 7, 3);
        $e = substr($i, 10, 4);
        $f = substr($i, 13, 4);
        $g = substr($i, 17, 3);
        $formatNOP = $a . $j . $b . $j . $c . $j . $d . $j . $e . $j . $f . $k . $g;
        return $formatNOP;
    }

    public function getFormatNikDariAttribute()
    {
        $i = $this->dari_nik;
        $j = ' ';

        $a = substr($i, 0, 2);
        $b = substr($i, 2, 4);
        $c = substr($i, 6, 3);
        $d = substr($i, 9, 5);
        $e = substr($i, 14, 3);
        $formatNIK = $a . $j . $b . $j . $c . $j . $d . $j . $e;
        return $formatNIK;
    }
    public function getFormatNikKepadaAttribute()
    {
        $i = $this->kepada_nik;
        $j = ' ';

        $a = substr($i, 0, 2);
        $b = substr($i, 2, 4);
        $c = substr($i, 6, 3);
        $d = substr($i, 9, 5);
        $e = substr($i, 14, 3);
        $formatNIK = $a . $j . $b . $j . $c . $j . $d . $j . $e;
        return $formatNIK;
    }

    public function joinPPAT()
    {
        return $this->belongsTo(UserModel::class, 'kode_ppat', 'kode_ppat');
    }
    public function joinProfilDari()
    {
        return $this->belongsTo(ProfilModel::class, 'dari_nik', 'nik');
    }

    public function joinProfilKepada()
    {
        return $this->belongsTo(ProfilModel::class, 'kepada_nik', 'nik');
    }

    public function joinProfilSebelum()
    {
        return $this->belongsTo(ProfilModel::class, 'dari_nik', 'nik');
    }
    public function joinNop()
    {
        return $this->belongsTo(NopPbbModel::class, 'nop', 'nop');
    }
    public function joinJenisPerolehan()
    {
        return $this->belongsTo(JenisPerolehanModel::class, 'kode_jenis_perolehan', 'kode_jenis_perolehan');
    }
    public function joinRekening()
    {
        return $this->belongsTo(RekeningModel::class, 'no_rekening_bank', 'no_rekening');
    }
}
