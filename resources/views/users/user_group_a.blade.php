@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<!-- /.row -->
<div class="row d-flex justify-content-center">
    <div class="col-md-6">
        <div class="card card-default card-outline">
            <div class="card-header text-indigo">
                <h3 class="card-title">
                    <i class="fas fa-users-cog mr-2"></i> Tambah Role
                </h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm">
                        <li class="page-item">
                            <a href="{{ url()->previous() }}" class="page-link bg-indigo">
                                <i class="fas fa-angle-double-left mr-2"></i>
                                Kembali
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <form action="{{ route('user-groups.simpan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body table-responsive p-3 text-indigo">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="group_name" class="col-sm-3 col-form-label">
                                    Nama Grup
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="group_name" class="form-control" id="no_surat" placeholder="Nama Group ..." autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="group_description" class="col-sm-3 col-form-label">
                                    Deskripsi Grup
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="group_description" class="form-control" id="group_description">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3">
                            <a href="{{ url()->previous() }}" class="btn btn-block btn-warning">
                                <i class="fas fa-undo mr-2"></i> Batal
                            </a>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-block bg-indigo">
                                <i class="fas fa-save mr-2"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.card -->
    </div>
</div>
<!-- /.row -->



@endSection