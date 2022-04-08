<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

        pre.no-print,
        body,
        body div#kertas {
            font-family: Arial, Helvetica, sans-serif;
            padding: 0;
            margin: 0;

        }

        #kertas table {
            font-size: 10px
        }

        body,
        body div#kertas {
            padding: 0;
            margin: 0;
            line-height: inherit;
            text-align: left;
        }

        #kertas {
            overflow: hidden;
        }

        @page {
            size: <?= 119 - 3 . 'mm' ?> 350mm;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            margin-header: 0;
            margin-footer: 0;
        }
    </style>
</head>

<body>

    <div id="kertas" style="width:<?= 119 - 3 . 'mm' ?>;height:<?= 127 - 3 . 'mm' ?>;box-sizing:border-box;border:1px dotted;background-image: url('<?= asset('gambar/pajak-bg.png') ?>');">
        @include("pbb/admin/partials/header_print-pbb")
        <div class="kertas-body" style="background-color: #fff;padding-left:20.787401575px;padding-right:20.787401575px;height:114mm">
            <div style="text-align: center;height:18.89763779px" class="no-print">SURAT TANDA TERIMA SETORAN</div>
            <div style="height: 124.72440945px;position:relative;font-size:10px">
                <div> <span class="no-print"> Tempat Pembayaran :</span><span style="position: absolute;top:0.2px;left:102.04724409px">BANK ACEH</span></div>
                <div style="padding-top: 4px;"><span class="no-print"> Telah menerima pembayaran PBB th.</span>
                    <div class="no-border" style="border:1px solid #000;width:9mm;height:3mm;position:absolute;top:4mm;left:44mm;"> <span style="padding:2px 3px 1px"> <?= $pbb->tgl_pbb->format("Y") ?></span></div>
                    <span class="no-print" style="margin-left: 17mm;">Dari</span>
                </div>
                <div style="padding-top: 4px;"><span class="no-print">Nama Wajib Pajak : </span>
                    <div style="position:absolute;top:8mm;left:26mm;"><span class="print">{{ $pbb->nama_wp}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <span class="no-print">Letak Objek Pajak : Kecamatan </span>
                    <div style="position:absolute;top:12mm;left:45mm;"><span class="print">{{$pbb->kecamatanWp->nama_kec ??''}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <pre class="no-print">                              : Kel/Desa </pre>
                    <div style="position:absolute;top:16mm;left:45mm;"><span class="print">{{$pbb->desaWp->nama_desa??''}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <span class="no-print">Nomor SPPT (NOP) :</span>
                    <div style="position:absolute;top:20mm;left:26mm;"><span class="print">{{$pbb->format_nop}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <span class="no-print">Sejumlah : Rp </span>
                    <div class="no-border" style="border:1px solid #000;width:80mm;height:4mm;position:absolute;top:23.5mm;left:26mm;"><span style="margin-top:5px;margin-left:10px"> {{ number_format($pbb->jumlah_terhutang)}}</span></div>
                </div>
                <div style="position: absolute;top:33mm">
                    <div style="border:1px solid;width:106mm;height:60mm;box-sizing:border-box;position:relative" class="no-border">
                        <div style="padding-left: 2mm;" class="no-print">
                            Tanggal Jatuh Tempo : <span class="print">{{ $pbb->tgl_jatuh_tempo->format("d-m-Y")}}</span> <br>
                            Jumlah yang harus dibayar (termasuk denda) jika pembayaran <br>
                            dilakukan pada bulan ke (setelah tanggal jatuh tempo) :
                        </div>
                        <div style="position: absolute;top:9mm;left:2mm;width:100%">
                            <?php $dendaPerbulan  = ceil(0.02 * $pbb->jumlah_terhutang); ?>
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td class="no-print">I</td>
                                        <td><?= number_format($dendaPerbulan * 1); ?></td>
                                        <td class="no-print">XIII</td>
                                        <td class="print"><?= number_format($dendaPerbulan * 13); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-print">II</td>
                                        <td class="print"> <?= number_format($dendaPerbulan * 2); ?></td>
                                        <td class="no-print">XIV </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 14); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-print">III</td>
                                        <td class="print"> <?= number_format($dendaPerbulan * 3); ?></td>
                                        <td class="no-print">XV</td>
                                        <td class="print"> <?= number_format($dendaPerbulan * 15); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-print">IV</td>
                                        <td class="print"> <?= number_format($dendaPerbulan * 4); ?></td>
                                        <td class="no-print">XVI </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 16); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-print">V</td>
                                        <td class="print"> <?= number_format($dendaPerbulan * 5); ?></td>
                                        <td class="no-print">XVII </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 17); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-print">VI</td>
                                        <td class="print"> <?= number_format($dendaPerbulan * 6); ?></td>
                                        <td class="no-print">XVIII</td>
                                        <td class="print"> <?= number_format($dendaPerbulan * 18); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-print">VII</td>
                                        <td class="print"> <?= number_format($dendaPerbulan * 7); ?></td>
                                        <td class="no-print">XIX</td>
                                        <td class="print"> <?= number_format($dendaPerbulan * 19); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-print">VIII</td>
                                        <td class="print"> <?= number_format($dendaPerbulan * 8); ?></td>
                                        <td class="no-print">XX </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 20); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-print">XI </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 9); ?></td>
                                        <td class="no-print">XXI </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 21); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-print">X </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 10); ?></td>
                                        <td class="no-print">XXII </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 22); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-print">XI </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 11); ?></td>
                                        <td class="no-print">XXII </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 23); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-print">XII </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 12); ?></td>
                                        <td class="no-print">XXIV </td>
                                        <td class="print"><?= number_format($dendaPerbulan * 24); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div style="position: absolute;top:93mm;width: 106mm;">
                    <div style="position:relative;width: 100%;">
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td class="no-print" style="width: 27mm;">Tanggal Pembayaran : </td>
                                    <td class="print">{{$pbb->tgl_setor ? $pbb->tgl_setor ->format("d-m-Y") :''}}</td>
                                    <td class="no-print">L.T</td>
                                    <td class="print">{{ number_format($pbb->luas_tanah)}}</td>
                                    <td style="width:18mm;text-align:center;vertical-align: middle;border-left:1px solid" class="no-print no-border" rowspan="3">
                                        Tanda Terima <br>
                                        dan <br>
                                        Cap Bank/Pos</td>
                                </tr>
                                <tr>
                                    <td class="no-print" style="width: 27mm;">
                                        <pre class="no-print">Jumlah yang dibayar  : </pre>
                                    </td>
                                    <td class="print">{{ number_format($pbb->jumlah_terhutang)}}</td>
                                    <td class="no-print">L.B</td>
                                    <td class="print">{{ number_format($pbb->luas_bangunan)}}</td>
                                </tr>
                                <tr>
                                    <td class="no-print" style="text-align: right;">
                                        <pre class="no-print">Rp.  </pre>
                                    </td>
                                    <td colspan="3">
                                        <div class="no-border" style="border:1px solid">{{ number_format($pbb->jumlah_terhutang)}}</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kertas" style="width:<?= 119 - 3 . 'mm' ?>;height:<?= 110 - 3 . 'mm' ?>;box-sizing:border-box;border:1px dotted;background-image: url('<?= asset('gambar/pajak-bg.png') ?>')">
        @include("pbb/admin/partials/header_print-pbb")
        <div class="kertas-body" style="background-color: #fff;padding-left:20.787401575px;padding-right:20.787401575px;height:114mm">
            <div style="text-align: center;height:18.89763779px" class="no-print">SURAT TANDA TERIMA SETORAN</div>
            <div style="height: 124.72440945px;position:relative;font-size:10px">
                <div> <span class="no-print"> Tempat Pembayaran :</span><span style="position: absolute;top:0.2px;left:102.04724409px">BANK ACEH</span></div>
                <div style="padding-top: 4px;"><span class="no-print"> Telah menerima pembayaran PBB th.</span>
                    <div class="no-border" style="border:1px solid #000;width:9mm;height:3mm;position:absolute;top:4mm;left:44mm;"> <span style="padding:2px 3px 1px"> <?= $pbb->tgl_pbb->format("Y") ?></span></div>
                    <span class="no-print" style="margin-left: 17mm;">Dari</span>
                </div>
                <div style="padding-top: 4px;"><span class="no-print">Nama Wajib Pajak : </span>
                    <div style="position:absolute;top:8mm;left:26mm;"><span class="print">{{ $pbb->nama_wp}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <span class="no-print">Letak Objek Pajak : <span style="padding-left: 10px;">Kecamatan</span> </span>
                    <div style="position:absolute;top:12mm;left:45mm;"><span class="print">{{$pbb->kecamatanWp->nama_kec ??''}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <pre class="no-print">                              :     Kel/Desa </pre>
                    <div style="position:absolute;top:16mm;left:45mm;"><span class="print">{{$pbb->desaWp->nama_desa??''}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <span class="no-print">Nomor SPPT (NOP) :</span>
                    <div style="position:absolute;top:20mm;left:26mm;"><span class="print">{{$pbb->format_nop}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <span class="no-print">Sejumlah : Rp </span>
                    <div class="no-border" style="border:1px solid #000;width:80mm;height:4mm;position:absolute;top:23.5mm;left:26mm;"><span style="margin-top:5px;margin-left:10px"> {{ number_format($pbb->jumlah_terhutang)}}</span></div>
                </div>
                <div style="position: absolute;top:29mm;width: 106mm;left:0">
                    <div style="position:relative;width: 100%;">
                        <table style="width: 100%;margin:0;padding:0;border-spacing: 0;border-collapse: collapse;">
                            <tbody style="margin:0;">
                                <tr>
                                    <td class="no-print" style="width: 25mm;">Tanggal Pembayaran :</td>
                                    <td class="print" colspan="3">{{$pbb->tgl_setor ?$pbb->tgl_setor ->format("d-m-Y") :''}}</td>
                                    <td style="width:18mm;text-align:center;vertical-align: middle;border-left:1px solid" class="no-print no-border" rowspan="4">
                                        Tanda Terima <br>
                                        dan <br>
                                        Cap Bank/Pos</td>
                                </tr>
                                <tr>
                                    <td class="no-print" style="width: 27mm;">
                                        <pre class="no-print">Jumlah yang dibayar  : </pre>
                                    </td>
                                    <td class="no-print" style="width:3mm ;">
                                        <pre class="no-print">Rp.  </pre>
                                    </td>
                                    <td class="print" style="padding-right:2px">
                                        <div class="no-border" style="border:1px solid">{{ number_format($pbb->jumlah_terhutang)}}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="no-print">Lembar untuk BPKK</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="position: absolute;top:75mm;width: 106mm;left:0">
                    <div style="position:relative;width: 100%;">
                        <table style="width: 100%;margin:0;padding:0;border-spacing: 0;border-collapse: collapse;">
                            <tbody style="margin:0;">
                                <tr>
                                    <td class="no-print" style="width: 25mm;">Tanggal Pembayaran :</td>
                                    <td class="print" colspan="3">{{$pbb->tgl_setor ?$pbb->tgl_setor ->format("d-m-Y") :''}}</td>
                                    <td style="width:18mm;text-align:center;vertical-align: middle;border-left:1px solid" class="no-print no-border" rowspan="4">
                                        Tanda Terima <br>
                                        dan <br>
                                        Cap Bank/Pos</td>
                                </tr>
                                <tr>
                                    <td class="no-print" style="width: 27mm;">
                                        <pre class="no-print">Jumlah yang dibayar  : </pre>
                                    </td>
                                    <td class="no-print" style="width:3mm ;">
                                        <pre class="no-print">Rp.  </pre>
                                    </td>
                                    <td class="print" style="padding-right:2px">
                                        <div class="no-border" style="border:1px solid">{{ number_format($pbb->jumlah_terhutang)}}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="no-print">Lembar untuk Bidan PBB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kertas" style="width:<?= 119 - 3 . 'mm' ?>;height:<?= 65 - 3 . 'mm' ?>;box-sizing:border-box;border:1px dotted;background-image: url('<?= asset('gambar/pajak-bg.png') ?>')">
        @include("pbb/admin/partials/header_print-pbb")
        <div class="kertas-body" style="background-color: #fff;padding-left:20.787401575px;padding-right:20.787401575px;height:114mm">
            <div style="text-align: center;height:18.89763779px" class="no-print">SURAT TANDA TERIMA SETORAN</div>
            <div style="height: 124.72440945px;position:relative;font-size:10px">
                <div> <span class="no-print"> Tempat Pembayaran :</span><span style="position: absolute;top:0.2px;left:102.04724409px">BANK ACEH</span></div>
                <div style="padding-top: 4px;"><span class="no-print"> Telah menerima pembayaran PBB th.</span>
                    <div class="no-border" style="border:1px solid #000;width:9mm;height:3mm;position:absolute;top:4mm;left:44mm;"> <span style="padding:2px 3px 1px"> <?= $pbb->tgl_pbb->format("Y") ?></span></div>
                    <span class="no-print" style="margin-left: 17mm;">Dari</span>
                </div>
                <div style="padding-top: 4px;"><span class="no-print">Nama Wajib Pajak : </span>
                    <div style="position:absolute;top:8mm;left:26mm;"><span class="print">{{ $pbb->nama_wp}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <span class="no-print">Letak Objek Pajak : <span style="padding-left: 10px;">Kecamatan</span> </span>
                    <div style="position:absolute;top:12mm;left:45mm;"><span class="print">{{$pbb->kecamatanWp->nama_kec ??''}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <pre class="no-print">                              :     Kel/Desa </pre>
                    <div style="position:absolute;top:16mm;left:45mm;"><span class="print">{{$pbb->desaWp->nama_desa??''}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <span class="no-print">Nomor SPPT (NOP) :</span>
                    <div style="position:absolute;top:20mm;left:26mm;"><span class="print">{{$pbb->format_nop}}</span></div>
                </div>
                <div style="padding-top: 4px;">
                    <span class="no-print">Sejumlah : Rp </span>
                    <div class="no-border" style="border:1px solid #000;width:80mm;height:4mm;position:absolute;top:23.5mm;left:26mm;"><span style="margin-top:5px;margin-left:10px"> {{ number_format($pbb->jumlah_terhutang)}}</span></div>
                </div>
                <div style="position: absolute;top:29mm;width: 106mm;left:0">
                    <div style="position:relative;width: 100%;">
                        <table style="width: 100%;margin:0;padding:0;border-spacing: 0;border-collapse: collapse;">
                            <tbody style="margin:0;">
                                <tr>
                                    <td class="no-print" style="width: 25mm;">Tanggal Pembayaran :</td>
                                    <td class="print" colspan="3">{{$pbb->tgl_setor ?$pbb->tgl_setor ->format("d-m-Y") :''}}</td>
                                    <td style="width:18mm;text-align:center;vertical-align: middle;border-left:1px solid" class="no-print no-border" rowspan="4">
                                        Tanda Terima <br>
                                        dan <br>
                                        Cap Bank/Pos</td>
                                </tr>
                                <tr>
                                    <td class="no-print" style="width: 27mm;">
                                        <pre class="no-print">Jumlah yang dibayar  : </pre>
                                    </td>
                                    <td class="no-print" style="width:3mm ;">
                                        <pre class="no-print">Rp.  </pre>
                                    </td>
                                    <td class="print" style="padding-right:2px">
                                        <div class="no-border" style="border:1px solid">{{ number_format($pbb->jumlah_terhutang)}}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="no-print">Lembar untuk Bank</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
