@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<!-- /.row -->
<div class="row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card card-default p-0">
            <div class="card-header bg-indigo">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="card-title">
                            <i class="fas fa-building mr-2"></i> Rekening Penerimaan
                        </h3>
                    </div>
                    <div class="col-md-8">
                        <div class="btn-group d-inline float-right">

                            <a href="{{ url()->previous() }}" class="btn btn-default btn-sm text-indigo">
                                <i class="fas fa-angle-double-left text-indigo mr-2"></i>
                                Kembali
                            </a>
                            @if (session()->get('datauser')->user_group <= USER_ADMIN) <!-- hanya admin dan super admin -->
                                <a href="{{ route('rekening.edit', $rekening->id) }}" class="btn btn-default btn-sm text-warning editFunction" data-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                                @endif
                                @if (session()->get('datauser')->user_group == USER_SUPER_ADMIN)
                                <form action="{{ route('rekening.hapus', $rekening->id) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-default btn-sm text-danger deleteFunction">
                                        <i class="fas fa-trash text-danger mr-2"></i>Delete
                                    </button>
                                </form>
                                @endif
                        </div>
                    </div>
                </div>

            </div><!-- /.card-header -->

            <div class="card-body table-responsive p-3">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group row text-indigo">
                            <label class="col-sm-4 col-form-label">Nomor Rekening</label>
                            <div class="col-sm-8">
                                <div class="attachment-block clearfix">
                                    <div class="attachment-text">
                                        {{ $rekening->no_rekening }}
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-4 col-form-label">Nama Rekening</label>
                            <div class="col-sm-8">
                                <div class="attachment-block clearfix">
                                    <div class="attachment-text">
                                        {{ $rekening->nama_rekening }}
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-4 col-form-label">Status Rekening</label>
                            <div class="col-sm-8">
                                <div class="attachment-block clearfix">
                                    <div class="attachment-text">
                                        {{ $rekening->status_rekening }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row text-indigo">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <strong class="text-indigo">Gambar QRIS</strong><br />
                                @if($rekening->gambar_qris != NULL || $rekening->gambar_qris != "")
                                <img src="{{$rekening->file_qris}}" alt="" class="img-fluid img-thumbnail" id="preview_qris">
                                @else
                                <img src="" alt="" class="img-fluid img-thumbnail d-none" id="preview_qris">
                                @endif
                            </div>
                            <div class="col-md-4">
                                <strong class="text-indigo">Gambar Logo Bank</strong><br />
                                @if($rekening->gambar_logo_bank != NULL || $rekening->gambar_logo_bank != "")
                                <img src="{{$rekening->file_logo_bank}}" alt="" class="img-fluid img-thumbnail" id="preview_logo_bank">
                                @else
                                <img src="" alt="" class="img-fluid img-thumbnail d-none" id="preview_logo_bank">
                                @endif
                            </div>
                        </div>

                        <!-- </div> -->
                    </div>

                </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div>
</div>
<!-- /.row -->

@endSection

@section('script')
<script>
    $('body').on('click', '.deleteFunction', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var form = event.target.form;
        // var url = $(this).attr("href");
        console.log(form);
        // console.log(url);
        swal({
            title: "Yakin menghapus rekening ini ?",
            text: "Anda tidak dapat mengembalikan lagi rekening yang telah dihapus!",
            icon: "warning",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
                // window.location.href = url;
            } else {
                swal("Cancel", "Rekening tidak dihapus!", "error");
            }
        })
    });

    $('body').on('click', '.editFunction', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        // var form = event.target.form;
        var url = $(this).attr("href");
        // console.log(form);
        console.log(url);
        swal({
            title: "Yakin ingin mengubah data ini ?",
            text: "Pastikan anda benar-benar ingin mengubah Rekening ini!",
            icon: "warning",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                // form.submit(); 
                window.location.href = url;
            } else {
                swal("Cancel", "Rekening batal diubah", "error");
            }
        })
    });
</script>
@endsection