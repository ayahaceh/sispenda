<?php

namespace App\Models;

use App\Models\Alamat\DesaModel;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use App\Models\Alamat\ProvModel;
use App\Models\Referensi\JenisPerolehanModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pbb extends Model
{
    protected $table = "pbb";
    protected $casts = [
        'tgl_pbb' => 'datetime',
        'tgl_jatuh_tempo' => 'datetime',
        'tgl_setor' => 'datetime',
    ];
    protected $fillable = ["nik", "tgl_pbb", "nama_wp", "alamat_wp", "kode_prov_wp", "kode_kab_wp", "kode_kec_wp", "rtrw_wp", "kode_pos_wp", "nop", "letak_nop", "kode_prov_nop", "kode_kab_nop", "kode_kec_nop", "kode_kec_nop", "rtrw_nop", "luas_tanah", "njop_tanah", "luas_bangunan", "njop_bangunan", "kode_jenis_perolehan", "no_sertifikat", "jumlah_njop", "tgl_jatuh_tempo", "kode_desa_nop", "kode_desa_wp", "nomor_formulir", "jumlah_njoptkp", "jumlah_njop_pbb", "jumlah_terhutang", "created_by"];
    // Asesor
    public $appends = [
        'format_nop', "format_nik"
    ];
    public function jenisPerolehan()
    {
        return $this->belongsTo(JenisPerolehanModel::class, 'kode_jenis_perolehan', 'kode_jenis_perolehan');
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
    public function getFormatNikAttribute()
    {
        $i = $this->nik;
        $j = ' ';

        $a = substr($i, 0, 2);
        $b = substr($i, 2, 4);
        $c = substr($i, 6, 3);
        $d = substr($i, 9, 5);
        $e = substr($i, 14, 3);
        $formatNIK = $a . $j . $b . $j . $c . $j . $d . $j . $e;
        return $formatNIK;
    }
    use HasFactory;
    public function desaWp()
    {
        return $this->belongsTo(DesaModel::class, "kode_desa_wp", "kode_desa");
    }
    public function desaNop()
    {
        return $this->belongsTo(DesaModel::class, "kode_desa_nop", "kode_desa");
    }
    public function kecamatanWp()
    {
        return $this->belongsTo(KecModel::class, "kode_kec_wp", "kode_kec");
    }
    public function kecamatanNop()
    {
        return $this->belongsTo(KecModel::class, "kode_kec_nop", "kode_kec");
    }
    public function KabupatenWp()
    {
        return $this->belongsTo(KabModel::class, "kode_kab_wp", "kode_kab");
    }
    public function KabupatenNop()
    {
        return $this->belongsTo(KabModel::class, "kode_kab_nop", "kode_kab");
    }
    public function provinsiWp()
    {
        return $this->belongsTo(ProvModel::class, "kode_prov_wp", "kode_prov");
    }
    public function provinsiOp()
    {
        return $this->belongsTo(ProvModel::class, "kode_prov_nop", "kode_prov");
    }
    static function invoiceNumber($kode_desa)
    {
        $latest = Pbb::latest("id")->first();
        if (!$latest) {
            return $kode_desa . date("-Y-m-") . "000001";
        }

        $string = substr(preg_replace("/[^0-9\.]/", '', $latest->nomor_formulir), -6);
        return $kode_desa . date("-Y-m-") . sprintf('%06d', $string + 1);
    }
}
