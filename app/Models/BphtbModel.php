<?php

namespace App\Models;

use App\Models\Alamat\DesaModel;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use App\Models\Alamat\ProvModel;
use App\Models\Referensi\JenisPerolehanModel;
use App\Models\Referensi\RekeningModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use App\Models\ProfilModel;
// use App\Models\DasarSetoranModel;
// use App\Models\NopPbbModel;
// use App\Models\Referensi\JenisPerolehanModel;
// use App\Models\Referensi\RekeningModel;

class BphtbModel extends Model
{
    protected $table = 'bphtb';
    public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'tgl_bphtb',
        'nik', 'nama_wp', 'alamat_wp', 'kode_prov_wp', 'kode_kab_wp', 'kode_kec_wp', 'kode_desa_wp', 'rtrw_wp', 'kode_pos_wp',
        'nop', 'letak_nop', 'kode_prov_nop', 'kode_kab_nop', 'kode_kec_nop', 'kode_desa_nop', 'rtrw_nop', 'kode_pos_nop',
        'luas_tanah', 'njop_tanah', 'luas_bangunan', 'njop_bangunan', 'hak_nilai_pasar',
        'kode_jenis_perolehan', 'no_sertifikat',
        'npop', 'npoptkp', 'npopkp',
        'opsi_a', 'opsi_b', 'no_b', 'tgl_b', 'opsi_c', 'persen_c', 'uraian_c', 'opsi_d', 'uraian_d',
        'jumlah_bphtb', 'jumlah_setor', 'tgl_setor', 'nama_penyetor', 'tgl_diterima', 'diterima_oleh',
        'kode_ppat', 'tgl_ppat', 'nama_verifikator', 'tgl_verifikasi', 'no_dokumen', 'no_pbb_baru',
        'no_rekening_bank', 'berkas_bukti_pembayaran', 'berkas_formulir',
        'status_pembayaran', 'status_bphtb', 'tgl_persetujuan', 'user_persetujuan',
        'nip_diterima', 'nip_verifikator',
        'berkas_ktp', 'berkas_ajb', 'berkas_sertifikat',
        'created_by', 'updated_by', 'deleted_by',
    ];
    public $appends = [
        'jl_jumlah_setor',
        'file_berkas_bukti_pembayaran',
        'format_nik_dari',
        'format_nik_kepada',
        'format_nop',
        'format_npop', 'format_npoptkp', 'format_npopkp', 'format_jumlah', 'format_jumlah_setor',
        'jl_luas_tanah',
        'jl_luas_bangunan',
        'format_no_b',
        // 'format_njop_tanah',
        // 'format_njop_bangunan',
        // 'format_jumlah_tanah',
        // 'format_jumlah_bangunan',
    ];
    // Relations
    // Join ke NOP
    public function joinProvNop()
    {
        return $this->hasOne(ProvModel::class, 'kode_prov', 'kode_prov_nop');
    }
    public function joinKabNop()
    {
        return $this->hasOne(KabModel::class, 'kode_kab', 'kode_kab_nop');
    }

    public function joinKecNop()
    {
        return $this->hasOne(KecModel::class, 'kode_kec', 'kode_kec_nop');
    }

    public function joinDesaNop()
    {
        return $this->hasOne(DesaModel::class, 'kode_desa', 'kode_desa_nop');
    }

    // Join ke Wajib Pajak
    public function joinProvWp()
    {
        return $this->hasOne(ProvModel::class, 'kode_prov', 'kode_prov_wp');
    }

    public function joinKecWp()
    {
        return $this->hasOne(KecModel::class, 'kode_kec', 'kode_kec_wp');
    }

    public function joinKabWp()
    {
        return $this->hasOne(KabModel::class, 'kode_kab', 'kode_kab_wp');
    }

    public function joinDesaWp()
    {
        return $this->hasOne(DesaModel::class, 'kode_desa', 'kode_desa_wp');
    }

    public function joinKodeJenisPerolehan()
    {
        return $this->hasOne(JenisPerolehanModel::class, 'kode_jenis_perolehan', 'kode_jenis_perolehan');
    }

    public function joinJenisPerolehan()
    {
        return $this->hasOne(JenisPerolehanModel::class, 'kode_jenis_perolehan', 'kode_jenis_perolehan');
    }

    public function joinKepadaWp()
    {
        return $this->hasOne(ProfilModel::class, 'nik', 'nik');
    }

    public function joinPPAT()
    {
        return $this->belongsTo(UserModel::class, 'kode_ppat', 'kode_ppat');
    }

    public function joinRekening()
    {
        return $this->belongsTo(RekeningModel::class, 'no_rekening_bank', 'no_rekening');
    }

    // Acessor
    // public function getFileFotoAttribute()
    // {
    //     return url('upload/users/' . $this->joinKepadaWp->berkas_foto);
    // }

    public function getJlLuasTanahAttribute()
    {
        return number_format($this->luas_tanah, 0, ",", ".");
    }
    public function getJlLuasBangunanAttribute()
    {
        return number_format($this->luas_bangunan, 0, ",", ".");
    }
    public function getJlNjopTanahAttribute()
    {
        return number_format($this->njop_tanah, 0, ",", ".");
    }
    public function getJlNjopBangunanAttribute()
    {
        return number_format($this->njop_bangunan, 0, ",", ".");
    }
    public function getJlTanahAttribute()
    {
        $luas = $this->luas_tanah * $this->njop_tanah;
        return number_format($luas, 0, ",", ".");
    }
    public function getJlBangunanAttribute()
    {
        $luas = $this->luas_bangunan * $this->njop_bangunan;
        return number_format($luas, 0, ",", ".");
    }
    public function getJlTotalAttribute()
    {
        $tanah      = $this->luas_tanah * $this->njop_tanah;
        $bangunan   = $this->luas_bangunan * $this->njop_bangunan;
        $total      = $tanah + $bangunan;
        return number_format($total, 0, ",", ".");
    }
    public function getAngkaTotalAttribute()
    {
        $tanah      = $this->luas_tanah * $this->njop_tanah;
        $bangunan   = $this->luas_bangunan * $this->njop_bangunan;
        return $tanah + $bangunan;
        // return number_format($total, 0, ",", ".");
    }

    public function getJlHakNilaiPasarAttribute()
    {
        return number_format($this->hak_nilai_pasar, 0, ",", ".");
    }

    public function getJlNpopAttribute()
    {
        return number_format($this->npop, 0, ",", ".");
    }

    public function getJlNpoptkpAttribute()
    {
        return number_format($this->npoptkp, 0, ",", ".");
    }

    public function getJlNpoptpAttribute()
    {
        return number_format($this->npopkp, 0, ",", ".");
    }

    public function getJlBphtbAttribute()
    {
        return number_format($this->jumlah_bphtb, 0, ",", ".");
    }

    public function getJlSetorAttribute()
    {
        return number_format($this->jumlah_setor, 0, ",", ".");
    }

    // Formatting
    public function getFormatNopAttribute()
    {
        $i = $this->nop;
        $j = ' ';
        $k = ' ';

        $a = substr($i, 0, 2);
        $b = substr($i, 2, 2);
        $c = substr($i, 4, 3);
        $d = substr($i, 7, 3);
        $e = substr($i, 10, 3);
        $f = substr($i, 13, 4);
        $g = substr($i, 17, 1);
        $formatNOP = $a . $j . $b . $j . $c . $j . $d . $j . $e . $j . $f . $k . $g;
        return $formatNOP;
    }

    public function getFormatNikAttribute()
    {
        $i = $this->nik;
        $j = ' ';

        $a = substr($i, 0, 6);
        $b = substr($i, 6, 6);
        $c = substr($i, 12, 4);
        // $d = substr($i, 9, 5);
        // $e = substr($i, 14, 3);
        $formatNIK = $a . $j . $b . $j . $c;
        return $formatNIK;
    }
    public function getFormatNoBAttribute()
    {
        $i = $this->no_b;
        $spasi = ' ';

        if (substr($i, 0, 3) == '109') {
            $a = substr($i, 0, 3);
            $b = substr($i, 3, 3);
            $c = substr($i, 6, 3);
            $d = substr($i, 9, 5);
            $formatNoB = $a . $spasi . $b . $spasi . $c . $spasi . $d;
        } else {
            $a = substr($i, 0, 2);
            $b = substr($i, 2, 3);
            $c = substr($i, 5, 3);
            $d = substr($i, 8, 5);
            $formatNoB = $a . $spasi . $b . $spasi . $c . $spasi . $d;
        }

        return $formatNoB;
    }

    public function getFormatHakNilaiPasarAttribute()
    {
        return number_format($this->hak_nilai_pasar, 0, ",", ".");
    }

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
        return number_format($this->jumlah_bphtb, 0, ",", ".");
    }
    public function getFormatJumlahSetorAttribute()
    {
        return number_format($this->jumlah_setor, 0, ",", ".");
    }

    public function getJlJumlahSetorAttribute()
    {
        return number_format($this->jumlah_setor, 0, ",", ".");
    }
    public function getFileBerkasBuktiPembayaranAttribute()
    {
        return url('upload/berkas_bukti_pembayaran/' . $this->berkas_bukti_pembayaran);
    }

    public function getFileKtpAttribute()
    {
        return url('upload/berkas_ktp/' . $this->berkas_ktp);
    }

    public function getFileSertifikatAttribute()
    {
        return url('upload/berkas_sertifikat/' . $this->berkas_sertifikat);
    }

    public function getFileAjbAttribute()
    {
        return url('upload/berkas_ajb/' . $this->berkas_ajb);
    }

    public function getFormatNikDariAttribute()
    {
        $i = $this->dari_nik;
        $j = ' ';

        $a = substr($i, 0, 6);
        $b = substr($i, 6, 6);
        $c = substr($i, 12, 4);
        // $d = substr($i, 9, 5);
        // $e = substr($i, 14, 3);
        $formatNIK = $a . $j . $b . $j . $c;
        return $formatNIK;
    }
    public function getFormatNikKepadaAttribute()
    {
        $i = $this->kepada_nik;
        $j = ' ';

        $a = substr($i, 0, 6);
        $b = substr($i, 6, 6);
        $c = substr($i, 12, 4);
        // $d = substr($i, 9, 5);
        // $e = substr($i, 14, 3);
        $formatNIK = $a . $j . $b . $j . $c;
        return $formatNIK;
    }
}
