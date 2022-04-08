<?php

namespace App\Http\Controllers\Bphtb;

use App\Http\Controllers\Controller;
use App\Models\BphtbModel;
use Codedge\Fpdf\Fpdf\Fpdf;

define('FPDF_FONTPATH', app_path() . '/Libraries/FPDF/font/');

class LaporanBphtbCont extends Controller
{
    private $pdf;

    public function create($id)
    {

        $laporan = BphtbModel::find($id);

        // Tidak bisa dicetak jika statusnya belum lunas atau belum disetujui 
        if (
            $laporan->status_bphtb !== STATUS_BPHTB_SUDAH_DISETUJUI ||
            $laporan->status_pembayaran !== STATUS_PEMBAYARAN_LUNAS
        ) {
            $pesan = 'Formulir BPHTB hanya dapat di cetak saat Status BPHTB telah LUNAS ' .
                'dan harus telah DISETUJUI oleh ADMIN / KABID !';
            return back()->with('error', $pesan);
        }

        $no_formulir        = '';
        $nama_wajib_pajak   = strtoupper($laporan->nama_wp);
        $nik_wajib_pajak    = str_split($laporan->nik);
        $alamat_wajib_pajak = strtoupper($laporan->alamat_wp);
        $desa_wajib_pajak   = strtoupper($laporan->joinDesaWp->nama_desa);
        $kec_wajib_pajak    = strtoupper($laporan->joinKecWp->nama_kec);
        $kab_wajib_pajak    = strtoupper($laporan->joinKabWp->nama_kab);
        $rt_rw_wajib_pajak      = strtoupper($laporan->rtrw_wp);
        $kode_pos_wajib_pajak   = $laporan->kode_pos_wp ? str_split($laporan->kode_pos_wp) : null;

        $nop                        = str_split($laporan->nop);
        $letak_tanah_nop            = strtoupper($laporan->letak_nop);
        $desa_nop                   = strtoupper($laporan->joinDesaNop->nama_desa);
        $kec_nop                    = strtoupper($laporan->joinKecNop->nama_kec);
        $kab_nop                    = strtoupper($laporan->joinKabNop->nama_kab);
        $rtrw_nop                   = strtoupper($laporan->rtrw_nop);
        $luas_tanah_nop             = number_format($laporan->luas_tanah, 0, ",", ".");
        $luas_bangunan_nop          = number_format($laporan->luas_bangunan, 0, ",", ".");
        $njop_tanah_nop             = $laporan->getJlNjopTanahAttribute();
        $njop_bangunan_nop          = $laporan->getJlNjopBangunanAttribute();
        $njop_x_luas_tanah_nop      = $laporan->getJlTanahAttribute();
        $njop_x_luas_bangunan_nop   = $laporan->getJlBangunanAttribute();
        // $njop_total                 = number_format($laporan->joinNop->getJlTotalAttribute(), 0, ",", ".");
        $njop_total                 = $laporan->getJlTotalAttribute();
        $kode_jenis_perolehan_nop   = str_split($laporan->kode_jenis_perolehan);
        $nilai_pasar_nop            = $laporan->getJlHakNilaiPasarAttribute();
        $no_sertifikat_nop          = strtoupper($laporan->no_sertifikat);
        $npop                       = number_format($laporan->npop, 0, ",", ".");
        $npoptkp                    = number_format($laporan->npoptkp, 0, ",", ".");
        $npopkp                     = number_format($laporan->npopkp, 0, ",", ".");
        $bea_terutang               = number_format($laporan->jumlah_bphtb, 0, ",", ".");
        $jumlah_setor               = number_format($laporan->jumlah_setor, 0, ",", ".");
        $terbilang_setor            = 'NOL';
        if ($laporan->jumlah_setor >= 1) {
            $terbilang_setor            = strtoupper(kekata($laporan->jumlah_setor));
        }
        $diterima_oleh      = $laporan->diterima_oleh;
        $nip_diterima       = $laporan->nip_diterima;
        $tgl_diterima       = date('d/m/Y', strtotime($laporan->tgl_diterima));
        $nip_verifikator    = $laporan->nip_verifikator;
        $nama_verifikator   = $laporan->nama_verifikator;
        $tgl_verifikasi     = date('d/m/Y', strtotime($laporan->tgl_verifikasi));

        if ($laporan->opsi_a == 'Y') {
            $is_a = true;
            $is_b = false;
            $is_c = false;
            $is_d = false;
        } else if ($laporan->opsi_b == 'Y') {
            $is_a = false;
            $is_b = true;
            $is_c = false;
            $is_d = false;
        } else if ($laporan->opsi_c == 'Y') {
            $is_a = false;
            $is_b = false;
            $is_c = true;
            $is_d = false;
        } else if ($laporan->opsi_d == 'Y') {
            $is_a = false;
            $is_b = false;
            $is_c = false;
            $is_d = true;
        }

        $no_b       = $laporan->no_b;
        $no_b_1 = substr($no_b, 0, 3);
        $no_b_2 = substr($no_b, 3, 3);
        $no_b_3 = substr($no_b, 6, 3);
        $no_b_4 = substr($no_b, 9, 5);
        $no_b = $no_b_1 . ' ' . $no_b_2 . ' ' . $no_b_3 . ' ' . $no_b_4;

        $tgl_b      = $laporan->tgl_b;
        $persen_c   = $laporan->persen_c;
        if ($persen_c != null && $persen_c != '') {
            $persen_c = $persen_c * 100;
        } else {
            $persen_c = '';
        }
        $uraian_c   = $laporan->uraian_c;
        $uraian_d   = $laporan->uraian_d;

        $pdf        = new Fpdf('P', 'mm', [216, 330]);
        $pdf->AddFont('Calibri', '', 'calibri.php');
        $pdf->AddFont('Calibri', 'B', 'calibrib.php');
        $pdf->AddFont('Calibri', 'I', 'calibrii.php');
        $pdf->AddFont('Calibri', 'BI', 'calibriz.php');


        if (request()->has('only_one')) {
            $headers = [
                ['lembar' => 'Lembar ...', 'keterangan' => 'Untuk ...']
            ];
        } else {
            $headers = [
                ['lembar' => 'Lembar 1', 'keterangan' => 'Untuk Wajib Pajak'],
                ['lembar' => 'Lembar 2', 'keterangan' => 'Untuk PPAT/Notaris Sebagai Arsip'],
                ['lembar' => 'Lembar 3', 'keterangan' => 'Untuk Kepala Kantor Badan Pertanahan'],
                ['lembar' => 'Lembar 4', 'keterangan' => 'Untuk BPKK Dalam Proses Penelitian'],
                ['lembar' => 'Lembar 5', 'keterangan' => 'Untuk Bank yang Ditunjuk / Bendahara Penerimaan'],
            ];
        }


        foreach ($headers as $header) {

            $x = 10;
            $y = 0;

            $pdf->AddPage();
            $pdf->SetAutoPageBreak(false);
            //$pdf->SetMargins(50,20,20);
            $pdf->setFont('Calibri', '', 14);

            $pdf->Cell(315, 0, 'No.      ' . $no_formulir, 0, 1, 'R');
            $pdf->SetLineWidth(1);
            $y = $pdf->GetY();
            $pdf->SetXY($x, $y + 3);
            $pdf->Cell(0, 310, '', 1);

            $pdf->SetLineWidth(.4);

            $pdf->SetXY($x + 40, $y + 3);
            $pdf->Cell(120, 18, '', 1);

            $pdf->SetXY($x + 40, $y + 21);
            $pdf->Cell(120, 12, '', 1);

            $pdf->SetXY($x + 160, $y + 3);
            $pdf->Cell(0, 30, '', 1);

            $pdf->setFont('Calibri', 'B', 12);
            $pdf->SetXY($x, $y + 3);
            $pdf->Cell(40, 30, '', 1);

            $pdf->SetXY($x + 40, $y + 4);
            $pdf->Cell(120, 6, 'SURAT PEROLEHAN PAJAK DAERAH', 0, 0, 'C');
            $pdf->SetXY($x + 40, $y + 9);
            $pdf->Cell(120, 6, 'BEA PEROLEHAN ATAS TANAH DAN BANGUNAN', 0, 0, 'C');

            $pdf->SetXY($x + 40, $y + 14);
            $pdf->setFont('Calibri', 'B', 12);
            $pdf->Cell(120, 6, '( SSPD-BPHTB )', 0, 0, 'C');

            $pdf->setFont('Calibri', 'B', 12);
            $pdf->SetXY($x + 40, $y + 22);
            $pdf->Cell(120, 6, 'BERFUNGSI SEBAGAI SURAT PEMBERITAHUAN OBJEK PAJAK', 0, 0, 'C');
            $pdf->SetXY($x + 40, $y + 26);
            $pdf->Cell(120, 6, 'PAJAK BUMI DAN BANGUNAN  (SPOP PBB)', 0, 0, 'C');


            $pdf->setFont('Calibri', 'B', 12);
            $pdf->SetXY($x + 160, $y + 5);
            $pdf->Cell(0, 6, $header['lembar'], 0, 0, 'C');

            $pdf->setFont('Calibri', '', 10);
            $pdf->SetXY($x + 160, $y + 13);
            $pdf->MultiCell(0, 6, $header['keterangan'], 0, 'C');

            $pdf->Image('logo.png', $x + 7, $y + 5, 25, 25);

            $y = 43;
            $pdf->SetXY($x, $y);
            $pdf->setFont('Calibri', 'B', 12);
            $pdf->Cell(0, 7, '   BADAN PENGELOLAAN KEUANGAN KABUPATEN ACEH SINGKIL', 1, 0, 'L');

            $y = $y + 7;
            $pdf->SetXY($x, $y);
            $pdf->setFont('Calibri', '', 10);
            $pdf->Cell(0, 5, '   PERHATIAN : Bacalah petunjuk pengisian pada halaman belakang lembar ini terlebih dahulu', 1, 0, 'L');

            $y = $y + 6;
            $x = $x + 5;
            $pdf->SetXY($x, $y);
            $pdf->setFont('Calibri', '', 10);
            $pdf->Cell(5, 6, 'A.', 0, 0, 'C');
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 6, '1. Nama Wajib Pajak', 0, 0, 'L');
            $pdf->SetXY($x + 48, $pdf->GetY());
            $pdf->Cell(0, 6, $nama_wajib_pajak, 0, 0, 'L');
            $pdf->Line($x + 50, $pdf->GetY() + 6, $x + 185, $pdf->GetY() + 6);

            $pdf->Ln(7);
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 6, '2. NIK KTP', 0, 0, 'L');
            $pdf->SetXY($x + 50, $pdf->GetY());

            if (count($nik_wajib_pajak) >= 16) {
                $pdf->Cell(5, 6, $nik_wajib_pajak[0], 1, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[1], 1, 0, 'C');

                $pdf->Cell(4, 6, '', 0, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[2], 1, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[3], 1, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[4], 1, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[5], 1, 0, 'C');

                $pdf->Cell(4, 6, '', 0, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[6], 1, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[7], 1, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[8], 1, 0, 'C');

                $pdf->Cell(4, 6, '', 0, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[9], 1, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[10], 1, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[11], 1, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[12], 1, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[13], 1, 0, 'C');

                $pdf->Cell(5, 6, '', 0, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[14], 1, 0, 'C');
                $pdf->Cell(5, 6, $nik_wajib_pajak[15], 1, 0, 'C');

                if (count($nik_wajib_pajak) >= 16) {
                    for ($i = 16; $i < count($nik_wajib_pajak); $i++) {
                        $pdf->Cell(5, 6, $nik_wajib_pajak[$i], 1, 0, 'C');
                    }
                }
            } else {
                for ($i = 0; $i < count($nik_wajib_pajak); $i++) {
                    $pdf->Cell(5, 6, $nik_wajib_pajak[$i], 1, 0, 'C');
                }
            }


            $pdf->Ln(7);
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 6, '3. Alamat Wajib Pajak', 0, 0, 'L');
            $pdf->SetXY($x + 48, $pdf->GetY());
            $pdf->Cell(0, 6, $alamat_wajib_pajak, 0, 0, 'L');
            $pdf->Line($x + 11, $pdf->GetY() + 6, $x + 185, $pdf->GetY() + 6);

            $pdf->Ln(7);
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 6, '4. Kelurahan/Desa', 0, 0, 'L');
            $pdf->SetXY($x + 48, $pdf->GetY());
            $pdf->Cell(0, 6, $desa_wajib_pajak, 0, 0, 'L');
            $pdf->SetXY($x + 80, $pdf->GetY());
            $pdf->Cell(0, 6, '5. RT/RW : ' . $rt_rw_wajib_pajak, 0, 0, 'L');
            $pdf->SetXY($x + 130, $pdf->GetY());
            $pdf->Cell(0, 6, '6. Kecamatan : ' . $kec_wajib_pajak, 0, 0, 'L');
            $pdf->Line($x + 11, $pdf->GetY() + 6, $x + 185, $pdf->GetY() + 6);

            $pdf->Ln(7);
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 6, '7. Kabupaten/Kota', 0, 0, 'L');
            $pdf->SetXY($x + 48, $pdf->GetY());
            $pdf->Cell(0, 6, $kab_wajib_pajak, 0, 0, 'L');
            $pdf->SetXY($x + 130, $pdf->GetY());
            $pdf->Cell(0, 6, '8. Kode Pos', 0, 0, 'L');

            $pdf->SetXY($x + 160, $pdf->GetY());

            if ($kode_pos_wajib_pajak !== null) {
                foreach ($kode_pos_wajib_pajak as $item) {
                    $pdf->Cell(5, 6, $item, 1, 0, 'C');
                }
            } else {
                $pdf->Cell(5, 6, '', 1, 0, 'C');
                $pdf->Cell(5, 6, '', 1, 0, 'C');
                $pdf->Cell(5, 6, '', 1, 0, 'C');
                $pdf->Cell(5, 6, '', 1, 0, 'C');
                $pdf->Cell(5, 6, '', 1, 0, 'C');
            }
            $pdf->Line($x + 11, $pdf->GetY() + 6, $x + 130, $pdf->GetY() + 6);

            // membuat garis full
            $y = $pdf->GetY() + 4;
            $x = $x - 5;
            $pdf->SetXY($x, $y);
            $pdf->Line($x, $pdf->GetY() + 4, $x + 195, $pdf->GetY() + 4);
            //selesai membuat garis full

            $y = $pdf->GetY() + 6;
            $x = $x + 5;

            $pdf->SetXY($x, $y);
            $pdf->Cell(5, 6, 'B.', 0, 0, 'C');
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 6, '1. Nomor Objek Pajak (NOP) PBB', 0, 0, 'L');
            $pdf->SetXY($x + 70, $pdf->GetY());

            $pdf->Cell(5, 6, $nop[0], 1, 0, 'C');
            $pdf->Cell(5, 6, $nop[1], 1, 0, 'C');

            $pdf->Cell(4, 6, '', 0, 0, 'C');
            $pdf->Cell(5, 6, $nop[2], 1, 0, 'C');
            $pdf->Cell(5, 6, $nop[3], 1, 0, 'C');

            $pdf->Cell(4, 6, '', 0, 0, 'C');
            $pdf->Cell(5, 6, $nop[4], 1, 0, 'C');
            $pdf->Cell(5, 6, $nop[5], 1, 0, 'C');
            $pdf->Cell(5, 6, $nop[6], 1, 0, 'C');

            $pdf->Cell(4, 6, '', 0, 0, 'C');
            $pdf->Cell(5, 6, $nop[7], 1, 0, 'C');
            $pdf->Cell(5, 6, $nop[8], 1, 0, 'C');
            $pdf->Cell(5, 6, $nop[9], 1, 0, 'C');

            $pdf->Cell(4, 6, '', 0, 0, 'C');
            $pdf->Cell(5, 6, $nop[10], 1, 0, 'C');
            $pdf->Cell(5, 6, $nop[11], 1, 0, 'C');
            $pdf->Cell(5, 6, $nop[12], 1, 0, 'C');

            $pdf->Cell(4, 6, '', 0, 0, 'C');
            $pdf->Cell(6, 6, $nop[13], 1, 0, 'C');
            $pdf->Cell(5, 6, $nop[14], 1, 0, 'C');
            $pdf->Cell(5, 6, $nop[15], 1, 0, 'C');
            $pdf->Cell(5, 6, $nop[16], 1, 0, 'C');

            $pdf->Cell(4, 6, '', 0, 0, 'C');
            $pdf->Cell(5, 6, $nop[17], 1, 0, 'C');

            $pdf->Ln(7);
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 6, '2. Letak tanah dan atau bangunan', 0, 0, 'L');
            $pdf->SetXY($x + 70, $pdf->GetY());
            $pdf->Cell(0, 6, $letak_tanah_nop, 0, 0, 'L');
            $pdf->Line($x + 11, $pdf->GetY() + 6, $x + 185, $pdf->GetY() + 6);

            $pdf->Ln(7);
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 6, '3. Kelurahan/Desa', 0, 0, 'L');
            $pdf->SetXY($x + 70, $pdf->GetY());
            $pdf->Cell(0, 6, $desa_nop, 0, 0, 'L');

            $pdf->SetXY($x + 110, $pdf->GetY());
            $pdf->Cell(0, 6, '4. RT/RW', 0, 0, 'L');
            $pdf->SetXY($x + 130, $pdf->GetY());
            $pdf->Cell(0, 6, $rtrw_nop, 0, 0, 'L');
            $pdf->Line($x + 11, $pdf->GetY() + 6, $x + 185, $pdf->GetY() + 6);

            $pdf->Ln(7);
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 6, '5. Kecamatan', 0, 0, 'L');
            $pdf->SetXY($x + 70, $pdf->GetY());
            $pdf->Cell(0, 6, $kec_nop, 0, 0, 'L');

            $pdf->SetXY($x + 110, $pdf->GetY());
            $pdf->Cell(0, 6, '6. Kabupaten/Kota', 0, 0, 'L');
            $pdf->SetXY($x + 145, $pdf->GetY());
            $pdf->Cell(0, 6, $kab_nop, 0, 0, 'L');
            $pdf->Line($x + 11, $pdf->GetY() + 6, $x + 185, $pdf->GetY() + 6);

            $pdf->Ln(7);
            $pdf->SetX($x + 6, $pdf->GetY());
            $pdf->Cell(0, 6, 'Penghitungan NJOP PBB :', 0, 0, 'L');

            //tabel
            $pdf->Ln(7);
            $pdf->SetXY($x + 8, $pdf->GetY());
            $pdf->Cell(35, 13, 'Uraian', 1, 0, 'C');

            $pdf->Cell(45, 13, '', 1, 0, 'C');
            $pdf->Cell(45, 13, '', 1, 0, 'C');
            $x_temp = $pdf->GetX();
            $y_temp = $pdf->GetY();
            $pdf->Cell(55, 13, 'Luas x NJOP PBB/m', 1, 0, 'C');
            $pdf->setFont('Calibri', '', 7);
            $pdf->SetXY($x_temp + 26, $y_temp - 1);
            $pdf->Cell(0, 13, '2', 0, 0, 'C');
            $pdf->setFont('Calibri', '', 10);
            $y_temp = $y_temp + 3;

            $pdf->SetXY($x + 43, $y_temp);
            $pdf->Cell(45, 0, 'Luas', 0, 0, 'C');
            $pdf->SetXY($x + 43, $y_temp + 3);
            $pdf->setFont('Calibri', '', 8);
            $pdf->MultiCell(47, 3, '(Diisi luas tanah dan atau bangunan yang haknya diperoleh)', 0, 'C');

            $pdf->setFont('Calibri', '', 10);
            $pdf->SetXY($x + 88, $y_temp);
            $pdf->Cell(45, 0, 'NJOP PBB/m', 0, 0, 'C');

            //menulis persegi
            $pdf->setFont('Calibri', '', 7);
            $pdf->SetXY($x + 49, $y_temp - 8);
            $pdf->Cell(0, 13, '2', 0, 0, 'C');
            $pdf->setFont('Calibri', '', 10);

            $pdf->SetXY($x + 88, $y_temp + 3);
            $pdf->setFont('Calibri', '', 8);
            $pdf->MultiCell(47, 3, '(Diisi berdasarkan SPPT PBB tahun terjadinya perolehan hak)', 0, 'C');

            $y_temp = $pdf->GetY() + 1;
            $pdf->SetXY($x, $y_temp);
            $pdf->setFont('Calibri', '', 10);
            $pdf->SetXY($x + 8, $pdf->GetY());

            $pdf->Cell(35, 7, 'Tanah', 1, 0, 'L');
            $pdf->Cell(8, 7, '7', 1, 0, 'C');

            $x_temp = $pdf->GetX();
            $y_temp = $pdf->GetY();
            $pdf->Cell(37, 7, $luas_tanah_nop . ' ' . 'm  ', 1, 0, 'R');

            $x_temp2 = $pdf->GetX();
            $y_temp2 = $pdf->GetY();

            $pdf->setFont('Calibri', '', 7);
            $pdf->SetXY($x_temp + 36, $y_temp - 1);
            $pdf->Cell(1, 7, '2', 0, 0, 'R');
            $pdf->setFont('Calibri', '', 10);

            $pdf->SetXY($x_temp2, $y_temp2);

            $pdf->Cell(8, 7, '9', 1, 0, 'C');
            $pdf->Cell(37, 7, $njop_tanah_nop, 1, 0, 'R');
            $pdf->Cell(8, 7, '11', 1, 0, 'C');
            $pdf->Cell(47, 7, $njop_x_luas_tanah_nop, 1, 0, 'R');

            $pdf->Ln();
            $pdf->SetXY($x + 8, $pdf->GetY());

            $pdf->Cell(35, 7, 'Bangunan', 1, 0, 'L');
            $pdf->Cell(8, 7, '8', 1, 0, 'C');
            $x_temp = $pdf->GetX();
            $y_temp = $pdf->GetY();
            $pdf->Cell(37, 7, $luas_bangunan_nop . ' ' . 'm  ', 1, 0, 'R');

            $x_temp2 = $pdf->GetX();
            $y_temp2 = $pdf->GetY();

            $pdf->setFont('Calibri', '', 7);
            $pdf->SetXY($x_temp + 36, $y_temp - 1);
            $pdf->Cell(1, 7, '2', 0, 0, 'R');
            $pdf->setFont('Calibri', '', 10);

            $pdf->SetXY($x_temp2, $y_temp2);

            $pdf->Cell(8, 7, '10', 1, 0, 'C');
            $pdf->Cell(37, 7, $njop_bangunan_nop, 1, 0, 'R');
            $pdf->Cell(8, 7, '12', 1, 0, 'C');
            $pdf->Cell(47, 7, $njop_x_luas_bangunan_nop, 1, 0, 'R');

            $pdf->Ln();
            $pdf->SetXY($x + 8, $pdf->GetY());

            $pdf->Cell(125, 7, 'NJOP PBB', 0, 0, 'R');
            $pdf->Cell(8, 7, '13', 1, 0, 'C');
            $pdf->Cell(47, 7, $njop_total, 1, 0, 'R');

            $pdf->Ln(8);
            $pdf->setFont('Calibri', '', 10);
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 7, '15. Jenis perolehan hak atas tanah atau bangunan : ', 0, 0, 'L');
            $pdf->SetXY($x + 80, $pdf->GetY());
            $pdf->Cell(5, 7, $kode_jenis_perolehan_nop[0], 1, 0, 'C');
            $pdf->Cell(5, 7, $kode_jenis_perolehan_nop[1], 1, 0, 'C');
            $x_temp = $pdf->GetX();
            $pdf->Cell(0, 7, '14. Hak transaksi/Nilai Pasar', 0, 0, 'L');
            $pdf->SetXY($x_temp + 43, $pdf->GetY());
            $pdf->Cell(55, 7, 'Rp. ' . $nilai_pasar_nop, 1, 0, 'R');

            $pdf->Ln(7);
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(43, 8, '16. Nomor Sertifikat : ', 0, 0, 'L');
            $pdf->Cell(0, 8, $no_sertifikat_nop, 0, 0, 'L');
            $pdf->Line($x + 50, $pdf->GetY() + 6, $x + 130, $pdf->GetY() + 6);

            $pdf->Ln(8);
            $pdf->Cell(0, 7, '', 1, 0, 'L');
            $pdf->SetXY($x, $pdf->GetY());
            $pdf->Cell(0, 7, 'C.   PENGHITUNGAN BPHTB (Hanya diisi berdasarkan penghitungan Wajib Pajak)', 0, 0, 'L');

            $pdf->Ln(7);
            $pdf->Cell(138, 7, '', 1, 0, 'C');
            $pdf->Cell(8, 7, '1.', 1, 0, 'C');
            $pdf->Cell(0, 7, 'Rp. ' . $npop, 1, 0, 'R');
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 7, '1. Nilai Perolehan Objek Pajak (NPOP) memperhatikan nilai B.13 dan B.14', 0, 0, 'L');
            $pdf->Ln(7);
            $pdf->Cell(138, 7, '', 1, 0, 'C');
            $pdf->Cell(8, 7, '2.', 1, 0, 'C');
            $pdf->Cell(0, 7, 'Rp. ' . $npoptkp, 1, 0, 'R');
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 7, '2. Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)', 0, 0, 'L');
            $pdf->Ln(7);
            $pdf->Cell(112, 7, '', 1, 0, 'C');
            $pdf->Cell(26, 7, '', 1, 0, 'C');
            $pdf->Cell(8, 7, '3.', 1, 0, 'C');
            $pdf->Cell(0, 7, 'Rp. ' . $npopkp, 1, 0, 'R');
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 7, '3. Nilai Perolehan Objek Kena Pajak(NPOKP)', 0, 0, 'L');
            $pdf->SetXY($x + 107, $pdf->GetY());
            $pdf->Cell(26, 7, 'angka1-angka2', 0, 0, 'L');
            $pdf->Ln(7);
            $pdf->Cell(112, 7, '', 1, 0, 'C');
            $pdf->Cell(26, 7, '', 1, 0, 'C');
            $pdf->Cell(8, 7, '4.', 1, 0, 'C');
            $pdf->Cell(0, 7, 'Rp. ' . $bea_terutang, 1, 0, 'R');
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(0, 7, '4. Bea Perolehan Hak atas Tanah dan Bangunan yang terutang', 0, 0, 'L');
            $pdf->SetXY($x + 107, $pdf->GetY());
            $pdf->setFont('Calibri', '', 10);
            $pdf->Cell(26, 7, '5% x angka3', 0, 0, 'L');

            $pdf->Ln(7);
            $pdf->SetXY($x, $pdf->GetY());
            $pdf->Cell(0, 6, 'D.   Jumlah Setoran Berdasarkan : ', 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetXY($x + 7, $pdf->GetY());

            $y_temp = $pdf->GetY() + 2;

            $pdf->Cell(5, 6, '', 1, 0, 'C');
            if ($is_a) {
                $pdf->SetLineWidth(.8);

                $pdf->Line($x + 5, $y_temp, $x + 9, $y_temp + 4);
                $pdf->Line($x + 9, $y_temp + 4, $x + 15, $y_temp - 4);

                $pdf->SetLineWidth(.4);
            } else {
            }
            $pdf->Cell(3, 6, '', 0, 0, 'C');
            $pdf->Cell(0, 6, 'a. Penghitung Wajib Pajak', 0, 0, 'L');
            $pdf->Ln(7);
            $pdf->SetXY($x + 7, $pdf->GetY());

            $y_temp = $pdf->GetY() + 2;
            $pdf->Cell(5, 12, '', 1, 0, 'C');

            if ($is_b) {
                $pdf->SetLineWidth(.8);

                $pdf->Line($x + 5, $y_temp, $x + 9, $y_temp + 4);
                $pdf->Line($x + 9, $y_temp + 4, $x + 15, $y_temp - 4);

                $pdf->SetLineWidth(.4);
            }

            $pdf->Cell(3, 12, '', 0, 0, 'C');
            $pdf->MultiCell(100, 6, 'b. STPD BPHTB / SKPD KURANG BAYAR / SKPDB KURANG BAYAR TAMBAHAN *)', 0, 'L');
            $pdf->SetXY($x + 80, $pdf->GetY() - 6);

            $pdf->Cell(50, 6, 'Nomor : ' . ($no_b != null ? $no_b : ''), 0, 0, 'L');

            if ($tgl_b != null && $tgl_b != '') {
                $pdf->Cell(50, 6, 'Tanggal ' . formatDateIndo($tgl_b), 0, 0, 'L');
            } else {
                $pdf->Cell(50, 6, 'Tanggal ', 0, 0, 'L');
            }

            $pdf->Line($x + 80, $pdf->GetY() + 6, $x + 185, $pdf->GetY() + 6);
            $pdf->Ln(7);
            $pdf->SetXY($x + 7, $pdf->GetY());

            $y_temp = $pdf->GetY() + 2;

            $pdf->Cell(5, 6, '', 1, 0, 'C');

            if ($is_c) {
                $pdf->SetLineWidth(.8);

                $pdf->Line($x + 5, $y_temp, $x + 9, $y_temp + 4);
                $pdf->Line($x + 9, $y_temp + 4, $x + 15, $y_temp - 4);

                $pdf->SetLineWidth(.4);
            }

            $pdf->Cell(3, 6, '', 0, 0, 'C');
            $pdf->Cell(68, 6, 'c. Pengurangan dihitung sendiri menjadi : ', 0, 0, 'L');
            $pdf->Cell(10, 6, $persen_c, 1, 0, 'L');
            $pdf->Cell(3, 6, '%', 0, 0, 'L');
            $pdf->Cell(10, 6, '', 0, 0, 'C');
            $pdf->Cell(0, 6, 'Berdasarkan Peraturan KHD No. ' . ($uraian_c != null ? $uraian_c : ''), 0, 0, 'L');
            $pdf->Ln(7);
            $pdf->SetXY($x + 7, $pdf->GetY());

            $y_temp = $pdf->GetY() + 2;

            $pdf->Cell(5, 6, '', 1, 0, 'C');
            if ($is_d) {
                $pdf->SetLineWidth(.8);

                $pdf->Line($x + 5, $y_temp, $x + 9, $y_temp + 4);
                $pdf->Line($x + 9, $y_temp + 4, $x + 15, $y_temp - 4);

                $pdf->SetLineWidth(.4);
            }

            $pdf->Cell(3, 6, '', 0, 0, 'C');
            $pdf->Cell(0, 6, 'd. ' . ($uraian_d != null ? $uraian_d : ''), 0, 0, 'L');
            $pdf->Ln(7);
            $pdf->SetXY($x + 5, $pdf->GetY());
            $pdf->Cell(90, 6, 'JUMLAH YANG DISETOR (dengan angka) :', 0, 0, 'L');
            $pdf->Cell(0, 6, 'Dengan Huruf', 0, 1, 'L');

            $pdf->SetXY($x + 6, $pdf->GetY());

            $y_temp = $pdf->GetY();

            $pdf->Cell(70, 6, 'Rp. ', 1, 0, 'L');
            $pdf->SetXY($x + 6, $pdf->GetY());
            $pdf->Cell(70, 6, $jumlah_setor, 0, 0, 'R');

            $pdf->Cell(20, 6, '', 0, 0, 'L');
            $pdf->MultiCell(90, 6, $terbilang_setor . ' RUPIAH', 1, 'L');
            if ($pdf->GetY() <= 266) {
                $pdf->SetXY($x + 6, $pdf->GetY());
            } else {
                $pdf->SetXY($x + 6, $pdf->GetY() - 6);
            }

            $pdf->Cell(70, 6, '(berdasarkan perhitungan c.4 dan pilihan di D) ', 0, 0, 'L');

            $pdf->Ln(7);
            $y_temp = $pdf->GetY();
            $pdf->Cell(49, 35, '', 1, 0, 'C');
            $pdf->Cell(49, 35, '', 1, 0, 'C');
            $pdf->Cell(49, 35, '', 1, 0, 'C');
            $pdf->Cell(49, 35, '', 1, 0, 'C');

            $pdf->setFont('Calibri', '', 9);

            $pdf->SetXY($x - 5, $y_temp);
            $pdf->Cell(49, 4, 'Aceh Singkil , tgl. ' . $tgl_diterima, 0, 1, 'C');
            $pdf->Cell(49, 4, 'WAJIB PAJAK / PENYETOR', 0, 1, 'C');
            $pdf->Ln(19);
            $pdf->Line($x, $pdf->GetY() + 2, $x + 39, $pdf->GetY() + 2);
            $pdf->Cell(49, 0, strtoupper($nama_wajib_pajak), 0, 0, 'C');
            $pdf->SetXY($x - 5, $pdf->GetY() + 3);


            $pdf->SetXY($x + 45, $y_temp);
            $pdf->Cell(49, 4, 'MENGETAHUI : ', 0, 1, 'C');
            $pdf->SetX($x + 45);
            $pdf->Cell(49, 4, 'PPAT/NOTARIS', 0, 1, 'C');
            $pdf->Ln(19);
            $pdf->Line($x + 47, $pdf->GetY() + 2, $x + 89, $pdf->GetY() + 2);
            $pdf->SetXY($x + 45, $pdf->GetY() + 3);
            $pdf->Cell(49, 4, '', 0, 0, 'C');

            $pdf->SetXY($x + 93, $y_temp);
            $pdf->Cell(49, 4, 'DITERIMA OLEH : ', 0, 1, 'C');
            $pdf->SetX($x + 93);
            $pdf->Cell(49, 4, 'TEMPAT PEMBAYARAN BPHTB', 0, 1, 'C');
            $pdf->SetX($x + 97);
            $pdf->Cell(49, 4, 'Tanggal : ' . $tgl_diterima, 0, 1, 'L');
            $pdf->Ln(14);
            $pdf->Line($x + 97, $pdf->GetY() + 3, $x + 139, $pdf->GetY() + 3);
            $pdf->SetXY($x + 93, $pdf->GetY() + 4);
            $pdf->Cell(49, -6, strtoupper($diterima_oleh), 0, 0, 'C');
            $pdf->SetX($x + 96);
            $pdf->Cell(49, 4, 'NIP : ' . $nip_diterima, 0, 0, 'L');

            $pdf->SetXY($x + 142, $y_temp);
            $pdf->Cell(49, 4, 'Telah Diverifikasi : ', 0, 1, 'C');
            $pdf->SetX($x + 142);
            $pdf->Cell(49, 4, 'BPKK KABUPATEN ACEH SINGKIL', 0, 1, 'C');
            $pdf->SetX($x + 135);
            $pdf->Cell(49, 4, 'Tanggal : ' . $tgl_verifikasi, 0, 1, 'C');
            $pdf->Ln(15);
            $pdf->Line($x + 147, $pdf->GetY() + 2, $x + 189, $pdf->GetY() + 2);
            $pdf->SetXY($x + 142, $pdf->GetY() + 3);
            $pdf->Cell(49, -6, strtoupper($nama_verifikator), 0, 0, 'C');
            $pdf->SetX($x + 146);
            $pdf->Cell(49, 4, 'NIP : ' . $nip_verifikator, 0, 0, 'L');

            $pdf->Ln(5);
            $pdf->Cell(40, 15, '', 1, 0, 'C');

            $y_temp = $pdf->GetY() + 1;
            $pdf->SetXY($x, $y_temp);
            $pdf->setFont('Calibri', '', 10);
            $pdf->Cell(40, 6, 'Hanya diisi oleh', 0, 0, 'L');
            $pdf->setFont('Calibri', 'B', 10);
            $pdf->Cell(30, 6, 'Nomor Dokumen : ', 0, 0, 'L');

            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');

            $pdf->Cell(5, 5, '', 0, 0, 'C');

            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');

            $pdf->Cell(5, 5, '', 0, 0, 'C');

            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');

            $pdf->Cell(5, 5, '', 0, 0, 'C');

            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');

            $pdf->Cell(5, 5, '', 0, 0, 'C');

            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 1, 'C');

            $y_temp = $pdf->GetY() + 1;
            $pdf->SetXY($x, $y_temp);
            $pdf->setFont('Calibri', '', 10);
            $pdf->Cell(40, 6, 'petugas BPKK', 0, 0, 'L');
            $pdf->setFont('Calibri', 'B', 10);
            $pdf->Cell(30, 6, 'Nop PBB Baru : ', 0, 0, 'L');

            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');

            $pdf->Cell(5, 5, '', 0, 0, 'C');

            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');

            $pdf->Cell(5, 5, '', 0, 0, 'C');

            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');

            $pdf->Cell(5, 5, '', 0, 0, 'C');

            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');

            $pdf->Cell(5, 5, '', 0, 0, 'C');

            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');

            $pdf->Cell(5, 5, '', 0, 0, 'C');

            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');
            $pdf->Cell(5, 5, '', 1, 0, 'C');
        }

        $pdf->Output();
        exit;
    }
}
