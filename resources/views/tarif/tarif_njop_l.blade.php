@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-12">
        <div class="card card-default card-outline">
            <div class="card-header bg-indigo">
                <div class="row">
                    <div class="col-md-3">
                        <h3 class="card-title">
                            <i class="fas fa-file-invoice-dollar mr-2"></i>
                            Daftar Tarif Zona Nilai Tanah
                            </a>
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('tarif.njop') }}" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" name="cari" class="form-control float-right" @if($keyword !="" ) ? value="{{$keyword}}" : @endif placeholder="Search">
                                <div class="input-group-append">
                                    @if($clearButton == true)
                                    <a href="{{ route('tarif.njop') }}" class="btn btn-default">
                                        <i class="fas fa-times text-danger"></i>
                                    </a>
                                    @endif
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search text-indigo"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <a href="#" data-toggle="modal" data-target="#exampleModal" data-action="{{ route('tarif.njop.save') }}" data-type="save" class="btn btn-default btn-sm btn-block text-indigo">
                            <i class="fas fa-plus-circle mr-2 ml-2"></i> Tambah ZNT Baru
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead class="bg-indigo">
                        <tr>
                            <th>#</i></th>
                            <th>Kode Desa</th>
                            <th>Nama Desa</th>
                            <th>Kode Tarif</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-dark">
                        @foreach ($data as $key => $NJOP)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                <a href="#">
                                    {{ $NJOP->kode_desa }}
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    {{ $NJOP->joinDesa->nama_desa }}
                                </a>
                            </td>
                            <td>
                                {{ $NJOP->kode_tarif_njop }}
                            </td>
                            <td>
                                <a href="#" class="text-dark">
                                    {{ $NJOP->format_tarif_njop }}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    {{-- <button type="button" class="btn bg-indigo btn-sm">Lihat</button> --}}
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" data-id="{{ $NJOP->id }}"  data-kode_desa="{{ $NJOP->kode_desa }}" data-nama_desa="{{ $NJOP->joinDesa->nama_desa }}" data-kode_tarif_njop="{{ $NJOP->kode_tarif_njop }}" data-jumlah_tarif_njop="{{ $NJOP->jumlah_tarif_njop }}" data-type="detail" data-placement="bottom" title="Lihat Detail">
                                        <i class="fas fa-info-circle ml-2 mr-2"></i> Lihat
                                    </button>
                                    {{-- <button type="button" class="btn btn-warning btn-sm">Edit</button> --}}
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal" data-id="{{ $NJOP->id }}" data-kode_desa="{{ $NJOP->kode_desa }}" data-nama_desa="{{ $NJOP->joinDesa->nama_desa }}" data-kode_tarif_njop="{{ $NJOP->kode_tarif_njop }}" data-jumlah_tarif_njop="{{ $NJOP->jumlah_tarif_njop }}" data-action="{{ route('tarif.njop.update', $NJOP->id) }}" data-type="update" data-placement="bottom" title="Edit Data">
                                        <i class="fas fa-pen ml-2 mr-2"></i> Edit
                                    </button>
                                    <form action="{{ route('tarif.njop.delete', $NJOP->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-flat btn-danger deleteFunction" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                            <i class="fas fa-trash-alt ml-2 mr-2"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    {{ $data->links('templates.bootstrap-4') }}
                </div>
            </div>
        </div><!-- /.card -->
    </div> <!-- /.col -->
</div><!-- /.row -->

<!--MODAL-->
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-indigo">
            <div class="modal-header">
                <h5 class="modal-title block-title" id="exampleModalLabel"> MODAL TITLE </h5>
                <p id="tes"></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="formTarifNjop" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid">
                    <div class="form-group row text-cyan" style="padding: 10px">
                        <label for="kode_desa" class="col-sm-4 col-form-label text-white mt-2">Kode Desa</label>
                        <div class="col-sm-8 mt-2">
                            <select id="kode_desa" name="kode_desa" class="form-control" required>
                            </select>
                        </div>
                        <label for="nama_desa" class="col-sm-4 col-form-label text-white mt-2">Nama Desa</label>
                        <div class="col-sm-8 mt-2">
                            <input type="text" id="nama_desa" class="form-control" style="margin-bottom: 5px" readonly>
                        </div>
                        <label for="kode_tarif_njop" class="col-sm-4 col-form-label text-white mt-2">Kode Tarif </label>
                        <div class="col-sm-8 mt-2">
                            <input name="kode_tarif_njop" type="text" id="kode_tarif_njop" class="form-control" style="margin-bottom: 5px"  required>

                        </div>
                        <label for="jumlah_tarif_njop" class="col-sm-4 col-form-label text-white mt-2">Jumlah</label>
                        <div class="col-sm-8 mt-2">
                            <input name="jumlah_tarif_njop" type="text" id="jumlah_tarif_njop" class="form-control" style="margin-bottom: 5px"  required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btnSubmit">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endSection

@section('script')
    <script type="application/javascript">
        $('#kode_desa').select2({
            placeholder: 'Kode Desa',
            width: '100%',
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('tarif.kodeDesaAutoComplete') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    }
                },
                cache: true
            }
        }).on('change', function(data) {
            var selected = $(this).select2('data');
            console.log(selected);
            $.each(selected, function (index,value) {
                $('#nama_desa_text').val(value.nama_desa);
            });
        });
         $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var kode_desa = button.data('kode_desa')
            var nama_desa = button.data('nama_desa')
            var kode_tarif_njop = button.data('kode_tarif_njop')
            var jumlah_tarif_njop = button.data('jumlah_tarif_njop')
            var actionForm = button.data('action')
            var type = button.data('type')
            var modal = $(this)
            modal.find('.modal-body #formTarifNjop').attr("action", actionForm);
            modal.find('.modal-title').text('Tarif Zona Nilai Tanah');
            console.log(type);
            if(type=="update" || type=="detail"){
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #kode_desa').val(kode_desa);
                modal.find('.modal-body #nama_desa').val(nama_desa);
                modal.find('.modal-body #kode_tarif_njop').val(kode_tarif_njop);
                modal.find('.modal-body #jumlah_tarif_njop').val(jumlah_tarif_njop);
                
                // select2
                $(".chosen-select").select2();
                $('.select2-container').css('width', '100%');
                var data2 = {
                    id: kode_desa,
                    text:  kode_desa
                };
                // console.log(data2);
                var newOption = new Option(data2.text, data2.id, true, true);
                $('#kode_desa').append(newOption).trigger('change');
                // console.log(newOption);
                $('.select2-container').css('width', '100%');

                if(type=="detail"){    
                    modal.find('.modal-body #kode_desa').addClass('d-none');
                    modal.find('.modal-footer #btnSubmit').addClass('d-none');
                }else{
                    modal.find('.modal-body #kode_desa').removeClass('d-none');
                    modal.find('.modal-footer #btnSubmit').removeClass('d-none');
                }
            }else{
                modal.find('.modal-body #id').val('');
                modal.find('.modal-body #kode_desa').val('').trigger('change');
                modal.find('.modal-body #nama_desa').val('');
                modal.find('.modal-body #kode_tarif_njop').val('');
                modal.find('.modal-body #jumlah_tarif_njop').val('');
                modal.find('.modal-body #kode_desa_text').addClass('d-none');
                modal.find('.modal-body #kode_desa').removeClass('d-none');
            }
        });
        $('body').on('click', '.deleteFunction', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            var form = event.target.form;
            console.log(form);
            swal({
                title: "Yakin menghapus data ini ?",
                text: "Anda tidak dapat mengembalikan lagi data yang telah dihapus!",
                icon: "warning",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                } else {
                    swal("Cancel", "Aksi dibatalkan!", "error");
                }
            })

        });
    </script>
@endSection