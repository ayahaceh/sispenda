@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header text-indigo">
                    <h3 class="card-title"><i class="fas fa-users mr-2"></i> Edit Informasi kantor</h3>
                    <div class="card-tools">
                        <div class="btn-group d-inline">
                            <a href="{{ route('setting.satkers') }}" class="btn btn-sm bg-indigo">
                                <i class="fas fa-angle-double-left mr-2"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div><!-- /.card-header -->
                <form action="{{ route('setting.satkers.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body text-indigo">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="nama_satker" class="col-sm-3 col-form-label">Nama Kantor (singkat)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_satker"
                                            class="form-control @error('nama_satker') is-invalid @enderror" id="nama_satker"
                                            value="{{ $satkers->nama_satker }}" placeholder="Nama satker..." autofocus
                                            required>
                                        @error('nama_satker')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat_satker" class="col-sm-3 col-form-label">Alamat / telp</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="alamat_satker"
                                            class="form-control @error('alamat_satker') is-invalid @enderror"
                                            id="alamat_satker" value="{{ $satkers->alamat_satker }}"
                                            placeholder="Alamat satker..." autofocus>
                                        @error('alamat_satker')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama_satkera" class="col-sm-3 col-form-label">KOP Baris 1 </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_satkera"
                                            class="form-control @error('nama_satkera') is-invalid @enderror"
                                            id="nama_satkera" value="{{ $satkers->nama_satkera }}"
                                            placeholder="KOP Baris 1..." autofocus>
                                        @error('nama_satkera')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_satkerb" class="col-sm-3 col-form-label">KOP Baris 2 </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_satkerb"
                                            class="form-control @error('nama_satkerb') is-invalid @enderror"
                                            id="nama_satkerb" value="{{ $satkers->nama_satkerb }}"
                                            placeholder="KOP Baris 2..." autofocus>
                                        @error('nama_satkerb')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kota_satker" class="col-sm-3 col-form-label">Kab/Kota</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="kota_satker"
                                            class="form-control @error('kota_satker') is-invalid @enderror" id="kota_satker"
                                            value="{{ $satkers->kota_satker }}" placeholder="Kota satker..." autofocus>
                                        @error('kota_satker')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="prov_satker" class="col-sm-3 col-form-label">Provinsi</label>
                                    <div class="col-sm-9">
                                        <textarea rows="2" name="prov_satker"
                                            class="form-control @error('prov_satker') is-invalid @enderror" id="prov_satker"
                                            placeholder="Provinsi satker...">{{ $satkers->prov_satker }}</textarea>
                                        @error('prov_satker')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-3 col-form-label">Nomor Telpon</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="telp_satker"
                                            class="form-control @error('telp_satker') is-invalid @enderror" id="telp_satker"
                                            value="{{ $satkers->telp_satker }}" placeholder="Telp satker..." autofocus>
                                        @error('telp_satker')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-3 col-form-label">Alamat Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email_satker"
                                            class="form-control @error('email_satker') is-invalid @enderror"
                                            id="email_satker" value="{{ $satkers->email_satker }}"
                                            placeholder="Alamat email satker..." autofocus>
                                        @error('email_satker')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ket_satker" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea rows="2" name="ket_satker"
                                            class="form-control @error('ket_satker') is-invalid @enderror" id="ket_satker"
                                            placeholder="Keteragan satker...">{{ $satkers->ket_satker }}</textarea>
                                        @error('ket_satker')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="nama_kepala" class="col-sm-3 col-form-label">Nama Kepala</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_kepala"
                                            class="form-control @error('nama_kepala') is-invalid @enderror" id="nama_kepala"
                                            value="{{ $satkers->nama_kepala }}" placeholder="Nama kepala..." autofocus>
                                        @error('nama_kepala')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nip_kepala" class="col-sm-3 col-form-label">NIP</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nip_kepala"
                                            class="form-control @error('nip_kepala') is-invalid @enderror" id="nip_kepala"
                                            value="{{ $satkers->nip_kepala }}" placeholder="NIP..." autofocus>
                                        @error('nip_kepala')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jab_kepala" class="col-sm-3 col-form-label">Sebutan Jabatan kepala</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="jab_kepala"
                                            class="form-control @error('jab_kepala') is-invalid @enderror" id="jab_kepala"
                                            value="{{ $satkers->jab_kepala }}" placeholder="Jabatan kepala..." autofocus>
                                        @error('jab_kepala')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="logo_satker" class="col-sm-3 col-form-label">File Logo</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <img id="preview_img"
                                                src="{{ asset('/upload/app/logos/' . $satkers->logo_satker) }}"
                                                class="img-fluid img-thumbnail" width="150" height="150" />
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="logo_satker"
                                                class="custom-file-input @error('logo_satker') is-invalid @enderror"
                                                id="logo_satker" onchange="loadPreviewGambar(this);" class="form-control">
                                            <label class="custom-file-label" for="logo_satker">Pilih Logo Maksimal 1 MB
                                                (png, jpg atau jpeg)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-block bg-indigo">
                                    <i class="fas fa-save mr-2"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endSection

@section('script')
    <script>
        $(document).on('submit', 'form', function() {
            $('button').attr('disabled', 'disabled');
        });

        function loadPreviewGambar(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(150)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
