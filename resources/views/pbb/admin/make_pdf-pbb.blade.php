<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @media print {
            .no-print {
                color: transparent;
                background-color: transparent;
            }

            #kertas {
                background-image: none !important;
            }

            .no-border {
                border: none !important;
            }

            .print {
                color: black !important;
            }
        }

        .table-wp-op {
            width: 100%;
            padding: 0 !important;
            margin: 0 !important;
            border-spacing: 0 !important;
        }

        .table-wp-op td,
        .table-nop th,
        .table-nop td {
            padding-left: 7.55px;
            padding-right: 7.55px;
            text-transform: uppercase;
        }

        .table-wp-op td {
            width: 50%;
        }

        .table-hitun-nop td,
        .table-hitun-nop tr {
            padding-left: 7.55px;
            padding-right: 7.55px;
        }

        .pre-pbb {
            font-family: 'Times New Roman', Times, serif;
            line-height: 16px;
            margin: 0;
            padding: 0;
        }

        @page {
            padding: 0;
            margin: 0;
            margin-header: 0;
            margin-footer: 0;
        }

        html,
        body {
            padding: 0;
            margin: 0;
            font-size: 1rem;
        }

        table {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div style="margin-left: auto; margin-right:auto;height:<?= KERTAS_PBB_TINGGI - (KERTAS_PBB_P_T + KERTAS_PBB_P_B + 2)  ?>px;overflow:hidden;border:1px dotted #000;padding-bottom:<?= KERTAS_PBB_P_B ?>px;padding-top:<?= KERTAS_PBB_P_T ?>px;font-family: Arial, Helvetica, sans-serif;font-size: 12px;width:<?= KERTAS_PBB_LEBAR ?>px">
        <div id="kertas" style="width: <?= KERTAS_PBB_LEBAR - (22.67 * 2) ?>px;padding-left: 22.67px;padding-right: 22.67px;background-image: url('<?= asset('gambar/pajak-bg.png') ?>');padding-bottom:20px">
            <div class="kertas-header" style="height: 49.133858268px;overflow:hidden;"></div>
            <div class="kertas-body" style="background-color: #fefefe">
                <div style="height: 56.31496063px;">
                    <div style="margin-left: 7.55px;margin-right: 7.55px;">
                        <h3 style="text-align:center;font-size:12px;margin:0;padding-top:4px;padding-bottom:0px" class="no-print">SURAT PEMBERITAHUAN PAJAK TERHUTANG <br>
                            PAJAK BUMI DAN BANGUNAN</h3>
                        <span style="padding-left: 3px;"> <span class="no-print"> NOP :</span> {{ $pbb->format_nop}}</span>
                    </div>
                </div>
                <div class="wp-op-detail no-border" style="height:111.38582677px;border: 1px solid #000;line-height:14px">
                    <table class="table-wp-op" style="height: 100%;width:100%">
                        <tbody style="padding:0;margin:0">
                            <tr>
                                <td style="vertical-align:top;font-size:11px">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center;" class="no-print">LETAK OBJEK PAJAK</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    {{$pbb->letak_nop}} <br>
                                    RT/RW {{$pbb->rtrw_nop}} <br>
                                    Desa : {{$pbb->desaNop->nama_desa ?? ''}} <br>
                                    Kecamatan : {{$pbb->kecamatanNop->nama_kec ?? ''}} <br>
                                    Kabupaten : {{$pbb->kabupatenNop->nama_kab??''}}
                                </td>
                                <td style=" border-left:1px solid #000;vertical-align:top;font-size:11px;padding-bottom:22px" class="no-border">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center;" class="no-print">Nama dan alamat wajib pajak</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="height: 100%;">
                                        {{$pbb->alamat_wp}} <br>
                                        RT/RW {{$pbb->rtrw_wp}} <br>
                                        Desa : {{$pbb->desaWp->nama_desa ??''}} <br>
                                        Kecamatan : {{$pbb->kecamatanWp->nama_kec ?? ''}} <br>
                                        Kabupaten : {{$pbb->kabupatenWp->nama_kab??''}} <br>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="wp-op-detail no-border" style="height:85.929133858px;border-left: 1px  solid #000;border-right: 1px  solid #000;border-bottom: 1px  solid #000;">
                    <table class="table-nop" style="height: 100%!important;width:100%;   padding: 0 !important;margin: 0 !important;border-spacing: 0 !important;margin-bottom: 0;">
                        <thead>
                            <tr class="no-print">
                                <th class="no-border" style="width: 111.49606299px;border-bottom:1px solid #000;border-right:1px solid #000;box-sizing:border-box">objek pajak</th>
                                <th class="no-border" style="width:111.49606299px;border-bottom:1px solid #000;border-right:1px solid #000;box-sizing:border-box">luas (m2)</th>
                                <th class="no-border" style="width:49.13px;border-bottom:1px solid #000;border-right:1px solid #000;box-sizing:border-box">kelas</th>
                                <th class="no-border" style="border-bottom:1px solid #000;border-right:1px solid #000">njop per m2 (rp)</th>
                                <th class="no-border" style="border-bottom:1px solid #000;">total njop (rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="height:100%">
                                <td class="no-border" style="border-right: 1px solid #000;height:100%">bumi</td>
                                <td class="no-border" style="border-right: 1px solid #000;">{{ number_format($pbb->luas_tanah)}}</td>
                                <td class="no-border" style="border-right: 1px solid #000;">{{$pbb->kelas}}</td>
                                <td class="no-border" style="border-right: 1px solid #000;">{{number_format($pbb->njop_tanah)}}</td>
                                <td class="no-border" style="text-align: right;">{{number_format($pbb->njop_tanah * $pbb->luas_tanah )}}</td>
                            </tr>
                            <tr style="height:100%">
                                <td class="no-border" style="border-right: 1px solid #000;">bangunan</td>
                                <td class="no-border" style="border-right: 1px solid #000;">{{ number_format($pbb->luas_bangunan)}}</td>
                                <td class="no-border" style="border-right: 1px solid #000;">{{$pbb->kelas}}</td>
                                <td class="no-border" style="border-right: 1px solid #000;">{{number_format($pbb->njop_bangunan)}}</td>
                                <td class="no-border" style="text-align: right;">{{number_format($pbb->njop_bangunan * $pbb->luas_bangunan )}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="height:103.93px;overflow:hidden;border-bottom:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;box-sizing:border-box" class="no-border">
                    <table class="table-hitun-nop" style="border-spacing: 0; width: 100%;">
                        <tbody>
                            <tr>
                                <td>
                                    <pre class="pre-pbb no-print">NJOP Sebagai dara pengenaan PBB = </pre>
                                </td>
                                <td style="width: 162.51px;text-align:right">{{number_format($pbb->jumlah_njop)}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre class="pre-pbb  no-print">NJOPTKP (NJOP Tidak Kena Pajak) = </pre>
                                </td>
                                <td style="width: 162.51px;text-align:right">{{number_format($pbb->jumlah_njoptkp)}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre class="pre-pbb no-print">NJOP untuk penghitungan PBB    = </pre>
                                </td>
                                <td style="width: 162.51px;text-align:right">{{number_format($pbb->jumlah_njop_pbb)}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre class="pre-pbb no-print">Golongan dan Tarif PBB         = </pre>
                                </td>
                                <td style="width: 162.51px;text-align:right">{{number_format(0.010)}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre class="pre-pbb no-print">PBB yang Terhutang             = </pre>
                                </td>
                                <td style="width: 162.51px;text-align:right">{{number_format($pbb->jumlah_terhutang)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="height:44.354330709px;overflow:hidden;border-bottom:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;text-transform: uppercase; padding-left: 7.55px;padding-right: 7.55px;" class="no-border">
                    <div style="padding-top:5px;">
                        <span class="no-print"> Pajak bumi dan bangunan yang harus dibayar (rp)</span>
                        <span style="float: right;">{{number_format($pbb->jumlah_terhutang)}}</span>
                        <div>
                            {{kekata($pbb->jumlah_terhutang)}} rupiah
                        </div>
                    </div>

                </div>
                <div style="height:112.38582677px;overflow:hidden;text-transform: uppercase; padding-left: 7.55px;padding-right: 7.55px;border-right:1px solid #000;border-left:1px solid #000;border-bottom:1px solid #000;" class="no-border">
                    <table style="border-spacing: 0; width: 100%;height:100%">
                        <tbody>
                            <tr>
                                <td rowspan="2" style="width: 25%; vertical-align:top">
                                    <div style="padding-top:5px;">
                                        <span class="no-print"> TGL JATUH TEMPO</span> <br>
                                        <span class="no-print"> TEMPAT PEMABAYARAN</span>
                                    </div>
                                </td>
                                <td rowspan="2" style="width: 25%; vertical-align:top;border-right: 1px solid #000;" class="no-border">
                                    <div style="padding-top:5px;text-transform:uppercase">
                                        : {{$pbb->tgl_jatuh_tempo->format('d F Y')}} <br>
                                        : BANK ACEH SYARIAH
                                    </div>
                                </td>
                                <td style="vertical-align:top">
                                    <div style="padding-top:5px;text-align:center;text-transform:uppercase;line-height: 15px;">
                                        <span style="font-size: 10px;">Singkil, {{ $pbb->tgl_pbb->format('d F Y')}}</span> <br>
                                        <span class="no-print"> Kepala badan</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:bottom">
                                    <div style="line-height:12px;text-align:center">
                                        Hendra Sunarno, SE, AK, MSI <br>
                                        NIP. 197908022005041002
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="kertas-robek no-border" style="margin-top:22px;background:#fff;height:88.70px;border:1px solid #000;overflow:hidden;">
                <table style="border-spacing: 0; width: 100%;">
                    <tbody>
                        <tr>
                            <td style="width:415.74px;vertical-align: top; padding-left: 7.55px;padding-right: 7.55px;position:relative">
                                <table style="border-spacing: 0; width: 100%;">
                                    <tbody style="line-height: 14px;">
                                        <tr>
                                            <td style="width:113.38px;"> <span class="no-print">NAMA WP</span></td>
                                            <td colspan="2">: {{$pbb->nama_wp}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:113.38px;"> <span class="no-print">Letak Objek Pajak</span></td>
                                            <td style="width: 95px;"> <span class="no-print">: Kecamatan</span></td>
                                            <td>{{$pbb->kecamatanWp->nama_kec}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td style="width: 95px;"> <span class="no-print">: Kampung/Kel. </span></td>
                                            <td>{{$pbb->desaWp->nama_desa}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:113.38px;"><span class="no-print">NOP</span></td>
                                            <td colspan="2">: {{$pbb->format_nop}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:113.38px;"><span class="no-print">SPPT Tahun/Rp.</span></td>
                                            <td colspan="2">: {{$pbb->tgl_pbb->format("Y")}} <span style="float: right;">{{number_format( $pbb->jumlah_terhutang)}}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td style="border-left:1px solid #000;font-size:12px; padding-left: 7.55px;padding-right: 7.55px;height:100%;vertical-align: top;" class="no-border">
                                <table style="height: 100%;">
                                    <tbody>
                                        <tr>
                                            <pre class="pre-pbb"><span class="no-print">Diterima tgl :</span></pre>
                                            <td align="top" style="vertical-align: top;">
                                                <div style="font-size: 11px;">
                                                    <pre class="pre-pbb"><span class="no-print">Tanda Tangan :</span></pre>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="vertical-align: bottom;padding-top:24px">
                                                <div style="line-height: 13px;text-align:center">
                                                    <span class="no-print">(...........................................)</span> <br><span class="no-print"> Nama Terang</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
