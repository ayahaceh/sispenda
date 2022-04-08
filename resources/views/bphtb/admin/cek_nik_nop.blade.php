@extends(setTemplate())
@section('tittle', '$tittle')
@section('bread', '$bread')
@section('container')

<div class="row">
    <div class="col-12">
        <div class="card card-default card-outline">
            <div class="card-body">
                <div class="col-md-6">
                    <form action="{{ route('cek-nik-hasil') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="nik-label" class="col-md-3">Masukkan NIK</label>
                            <input name="nik" id="nik" type="text" class="form-control" placeholder="Masukkan NIK" required>
                            <button type="submit" class="btn btn-block bg-indigo">
                                <i class="fas fa-clone mr-2"></i> Cek
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <label for="nik-label" class="col-md-3"> NIK Ditemukan </label>
                    <label for="nik-label" class="col-md-3"> {{$data}} </label>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection