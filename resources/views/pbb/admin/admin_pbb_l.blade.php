@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<div class="row">
    <div class="col-12 mb-2 text-right">
        <form action="{{route('pbb')}}">
            @csrf
            <div class="row justify-content-end">
                <div class="col-md-2 ">
                    <select name="tahun" id="tahun" class="form-control-sm">
                        <?php
                        $th = date("Y");
                        for ($i = $th; $i > ($th - 10); $i--) : ?>
                            <option value="{{$i}}" {{$i==$tahun ?'selected' :''}}>{{$i}}
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-6 ">
                    <div class="input-group input-group-sm">
                        <input type="text" name="cari" class="form-control" placeholder="Search Name, Nik or NOP" value="{{ request('cari')}}" />
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat">Search</button>
                        </span>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <div class="col-12">
        <div class="card card-default card-outline">
            <div class="card-header text-indigo">
                <div class="row">
                    <div class="col-md-3">
                        <h3 class="card-title">
                            <i class="fas fa-file-invoice-dollar mr-2"></i>
                            Daftar Transaksi PBB
                            </a>
                        </h3>
                    </div>
                    <div class="col-md-9 mt-2 mt-md-0">
                        <div class="d-md-flex justify-content-end">
                            <div class="mr-2">
                            </div>
                            <div class="btn-group mt-2 mt-md-0" role="group" aria-label="Basic example">
                                <form action="{{route('pbb.generate')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="tahun" value="{{$tahun}}">
                                    <button type="submit" class="btn btn-default btn-sm text-indigo">
                                        <i class="fas fa-plus-circle mr-2 ml-2"></i> Generate PBB
                                    </button>
                                </form>
                                <form action="{{ route('pbb.export-excel')}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-sm text-indigo"> <i class="fas fa-file-excel mr-2 ml-2"></i> Export
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive table-hover p-0">
                <table class="table">
                    <thead class="bg-primary">
                        <tr>
                            <th>No Formulir</th>
                            <th>Nama WP</th>
                            <th>Alamat WP</th>
                            <th>NOP</th>
                            <th>Alamat OP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pbbs as $pbb)
                        <tr>
                            <td>{{$pbb->nomor_formulir}}
                                <div class="">
                                    <a href="{{route('pbb.edit',$pbb->id)}}" class="badge badge-primary">Edit</a>
                                    <button data-id="{{$pbb->id}}" data-toggle="modal" data-target="#modal-lihat_pbb" class="badge badge-success ml-1 btn-lihat_pbb">Lihat</button>
                                </div>
                            </td>
                            <td>
                                {{$pbb->nama_wp}} <br>
                                NIK. {{$pbb->nik}}

                            </td>
                            <td>
                                <div class="alamat">
                                    {{ $pbb->alamat_wp}} <br>
                                    RT/RW {{ $pbb->rtrw_wp}} <br>
                                    Desa {{ $pbb->desaWp->nama_desa ?? ''}}, Kec. {{ $pbb->kecamatanWp->nama_kec ??'' }}
                                </div>
                            </td>
                            <td>{{$pbb->nop}} <br>
                                Total NJOP : Rp {{ number_format($pbb->jumlah_njop)}}
                            </td>
                            <td>
                                <div class="alamat">
                                    {{ $pbb->letak_nop}} <br>
                                    RT/RW {{ $pbb->rtrw_wp}} <br>
                                    Desa {{ $pbb->desaNop->nama_desa ??''}}, Kec. {{ $pbb->kecamatanNop->nama_kec ??''}}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="999">Data Kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    {{ $pbbs->links('templates.bootstrap-4') }}
                </div>
            </div>
        </div><!-- /.card -->
    </div> <!-- /.col -->
</div><!-- /.row -->
<div class="modal fade bd-example-modal-lg" id="modal-lihat_pbb" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

        </div>
    </div>
</div>
@endSection
@push("scripts")
<script>
    $(".btn-lihat_pbb").click(function(e) {
        e.preventDefault();
        let url = "{{ route('pbb.lihat','XXX_ID')}}"
        url = url.replace("XXX_ID", $(this).data('id'));
        $("#modal-lihat_pbb").find(".modal-content").html(`<div class="my-loader"><div class="my-loader-content"></div></div>`);
        $.ajax(url)
            .done(function(html) {
                $("#modal-lihat_pbb").find(".modal-content").html(html)
            })
            .always(function() {
                $("#modal-lihat_pbb").find(".my-loader").html("...");
            });
    })
</script>
@endpush
@push("styles")
<style>
    .my-loader {
        width: 100%;
        min-height: 400px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .my-loader-content {
        border: 16px solid #f3f3f3;
        border-top: 16px solid blue;
        border-bottom: 16px solid blue;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }



    #printThis {
        display: none;
    }

    @page {
        size: 18cm 19cm;
        margin: 0;
    }

    /* style sheet for "A4" printing */
    @media print {

        html,
        body {
            width: 673.51181102px !important;
            height: 721.88976378px !important;
            overflow: hidden;
        }

        pre {
            border: none;
        }

        body>:not(#printThis) {
            visibility: hidden;
            width: 0px !important;
            height: 0px !important;
        }

        div#printThis * {
            visibility: visible;
        }

        body #printThis {
            display: block;
            position: fixed;
            top: 0;
            left: 0;
        }
    }
</style>
@endpush
