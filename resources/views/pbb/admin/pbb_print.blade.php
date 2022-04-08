<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <style>
        body {
            width: 713px !important;
            margin-left: auto;
            margin-right: auto;
        }

        table td {
            vertical-align: top;
        }
    </style>
</head>

<body>
    @forelse ($pbbs as $pbb)
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td></td>
                <td>{{$pbb->tgl_pbb->format("Y")}}</td>
            </tr>
            <tr>
                <td>
                    <div style="padding-left: 49px;">{{$pbb->nop}}</div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <div class="nop">
                        {{ $pbb->letak_nop}} <br>
                        RT/RW : {{ $pbb->rtrw_wp}} <br>
                        Desa : {{ $pbb->desaNop->nama_desa ??''}} <br>
                        Kecamatan : {{ $pbb->kecamatanNop->nama_kec ??''}} <br>
                        Kota : {{ $pbb->kabupatenNop->nama_kab??''}}
                    </div>
                </td>
                <td>
                    <div class="wp">
                        {{ $pbb->nama_wp}} <br>
                        {{ $pbb->alamat_wp}} <br>
                        Desa : {{ $pbb->desaWp->nama_desa ??''}} <br>
                        Kec. : {{ $pbb->kecamatanWp->nama_kec ??''}} <br>
                        Kota : {{ $pbb->kabupatenWp->nama_kab??''}}
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td>Bumi</td>
                <td>{{$pbb->luas_tanah}}</td>
                <td>{{$pbb->kelas}}</td>
                <td>{{$pbb->njop_tanah}}</td>
                <td style="text-align: right;">{{$pbb->jumlah_njop_tanah??0}}</td>
            </tr>
            <tr>
                <td>Bangunan</td>
                <td>{{$pbb->luas_tanah}}</td>
                <td>{{$pbb->kelas}}</td>
                <td>{{$pbb->njop_bangunan}}</td>
                <td style="text-align: right;">{{$pbb->jumlah_njop_bangunan??0}}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td style="text-align: right;">
                    {{ number_format($pbb->jumlah_njop)}} <br>
                    {{ number_format($pbb->jumlah_njoptkp)}} <br>
                    {{ number_format($pbb->jumlah_njop_pbb)}} <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">
                    0.xx x {{ number_format($pbb->jumlah_njop_pbb)}}
                </td>
                <td style="text-align: right;">
                    {{ number_format($pbb->jumlah_terhutang)}}
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <div style="text-align: right;">
                        {{ number_format($pbb->jumlah_terhutang)}}
                    </div>
                    {{ kekata($pbb->jumlah_terhutang) }}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%;">
        <tbody>
            <tr>
                <td>
                    <div style="padding-left:172px">
                        {{$pbb->tgl_jatuh_tempo->format("d F Y")}} <br>
                        BANK ACEH SYARIAH
                    </div>
                </td>
                <td>
                    <div style="text-align:center">
                        SINGKIL, {{ $pbb->tgl_pbb->format("d F Y")}} <br> <br> <br><br>
                        HENDRA SUNARNO , SE,AK,MSI <br>
                        NIP. 197908022005041002
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 70%;">
                    <div style="padding-left: 178px;">
                        {{ $pbb->nama_wp}}
                        <div style="padding-left: 84px;">
                            {{ $pbb->kecamatanWp->nama_kec ??''}} <br>
                            {{ $pbb->desaWp->nama_desa ??''}}
                        </div>
                        {{ $pbb->letak_nop}} <br>
                        <div>{{ $pbb->tgl_pbb->format("Y m")}} <span style="float: right;"> {{ number_format($pbb->jumlah_terhutang)}}</span></div>
                    </div>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
    @empty
    Data Kosong
    @endforelse

</body>

</html>
