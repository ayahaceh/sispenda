@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row d-flex justify-content-center">
    <div class="col-md-12 col-lg-8 col-xl-6">
        <div class="card card-default card-outline">
            <div class="card-header bg-light">
                <div class="row d-flex align-items-center">
                    <div class="col-md-6">
                        <h3 class="card-title text-indigo">
                            <i class="fas fa-user-friends mr-2"></i>Verifikasi Profil Wajib Pajak Baru</a>
                        </h3>
                    </div>
                    <div class="col-md-6 mt-2 mt-md-0">
                        <div class="d-md-flex justify-content-end">
                            <div class="mr-2">
                                <form action="{{ route('profil.user.verifikasi.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="nik" value="{{ $data->nik }}">
                                    <div class="input-group input-group-sm">
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Valid">Valid</option>
                                            <option value="Tidak Valid">Tidak Valid</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn bg-indigo">
                                                Verifikasi
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <div class="d-none d-md-block">
                    <div class="row m-4">
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <div>
                                <a href="{{ $data->file_foto }}" target="_BLANK">
                                    <img src="{{ $data->file_foto }}" alt="Berkas foto" class="img-thumbnail">
                                </a>
                                <p class="text-center mt-2">Berkas Foto</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <div>
                                <a href="{{ $data->file_ktp }}" target="_BLANK">
                                    <img src="{{ $data->file_ktp }}" alt="Berkas foto" class="img-thumbnail">
                                </a>
                                <p class="text-center mt-2">Berkas KTP</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <div class="border py-3 px-4 rounded-lg bg-white" style="cursor: pointer; width: fit-content;" data-target="#openFileKK" data-toggle="modal">
                                <div class="d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 50px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-center">Berkas KK</span>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tr class="d-md-none">
                        <th width="35%">Berkas Foto</th>
                        <td>
                            <a href="{{ $data->file_foto }}" target="_BLANK">
                                <img src="{{ $data->file_foto }}" alt="Berkas foto" class="img-thumbnail">
                            </a>
                        </td>
                    </tr>
                    <tr class="d-md-none">
                        <th width="35%">Berkas KTP</th>
                        <td>
                            <a href="{{ $data->file_ktp }}" target="_BLANK">
                                <img src="{{ $data->file_ktp }}" alt="Berkas foto" class="img-thumbnail">
                            </a>
                        </td>
                    </tr>
                    <tr class="d-md-none">
                        <th width="35%">Berkas KK</th>
                        <td>
                            <div class="border py-3 px-4 rounded-lg bg-white" style="cursor: pointer; width: fit-content;" data-target="#openFileKK" data-toggle="modal">
                                <div class="d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 50px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-center">Berkas KK</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th width="35%">NIK</th>
                        <td>: {{ $data->nik }}</td>
                    </tr>
                    <tr>
                        <th width="35%">No. KK</th>
                        <td>: {{ $data->kk }}</td>
                    </tr>
                    <tr>
                        <th width="35%">Nama</th>
                        <td>: {{ $data->nama }}</td>
                    </tr>
                    <tr>
                        <th width="35%">Alamat email</th>
                        <td>: {{ $data->email }}</td>
                    </tr>
                    <tr>
                        <th width="35%">Jenis kelamin</th>
                        <td>: {{ $data->jk }}</td>
                    </tr>
                    <tr>
                        <th width="35%">Provinsi</th>
                        <td>: {{ $data->joinProv->nama_prov }}</td>
                    </tr>
                    <tr>
                        <th width="35%">Kabupaten</th>
                        <td>: {{ $data->joinKab->nama_kab }}</td>
                    </tr>
                    <tr>
                        <th width="35%">Kecamatan</th>
                        <td>: {{ $data->joinKec->nama_kec }}</td>
                    </tr>
                    <tr>
                        <th width="35%">Desa</th>
                        <td>: {{ $data->joinDesa->nama_desa }}</td>
                    </tr>
                    <tr>
                        <th width="35%">RT / RW</th>
                        <td>: {{ $data->rtrw }}</td>
                    </tr>
                    <tr>
                        <th width="35%">Kode Pos</th>
                        <td>: {{ $data->kode_pos }}</td>
                    </tr>
                    <tr>
                        <th width="35%">Alamat</th>
                        <td>: {{ $data->alamat }}</td>
                    </tr>
                    <tr>
                        <th width="35%">No. Telpon</th>
                        <td>: {{ $data->hp }}</td>
                    </tr>
                    <tr>
                        <th width="35%">No. WhatsApp</th>
                        <td>: {{ $data->wa }}</td>
                    </tr>
                    <tr>
                        <th width="35%">Telegram</th>
                        <td>: {{ $data->tg }}</td>
                    </tr>
                </table>
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div> <!-- /.col -->
</div><!-- /.row -->
@endSection

@section('modal')
<div class="modal fade" id="openFileKK" tabindex="-1" aria-labelledby="openFileKKLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openFileKKLabel">Preview File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <embed src="{{ $data->file_kk }}" height="768px" style="width: 100%; object-fit: fill; " />
            </div>
        </div>
    </div>
</div>
@endsection