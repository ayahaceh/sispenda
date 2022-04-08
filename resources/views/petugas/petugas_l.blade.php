@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-indigo">

                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('petugas.cari') }}" method="GET">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="cari" class="form-control" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-default">
                                            <i class="fas fa-search text-indigo"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <button type="buttton" data-toggle="modal" data-target="#tambahPetugasModal"
                                class="btn btn-default btn-sm text-indigo float-right">
                                <i class="fas fa-clone mr-2 ml-2"></i> Tambah Petugas
                            </button>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead class="bg-gray-light">
                            <tr class="text-indigo">
                                <th>Nama Petugas</th>
                                <th>NIP Petugas</th>
                                <th>Jabatan Petugas </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="text-dark">
                            @foreach ($data as $dt)
                                <tr>
                                    <td>
                                        {{ $dt->nama_penandatangan }}
                                    </td>
                                    <td>
                                        {{ $dt->format_nip }}
                                    </td>
                                    <td>
                                        {{ $dt->format_jabatan }}
                                    </td>
                                    <td>
                                        <div class="form-group row">
                                            <button type="button" data-route="{{ route('petugas.update', $dt->id) }}"
                                                data-nip="{{ $dt->nip_penandatangan }}"
                                                data-nama="{{ $dt->nama_penandatangan }}"
                                                data-kode="{{ $dt->kode_penandatangan }}"
                                                class="btn btn-sm btn-flat bg-indigo edit">
                                                <i class="fas fa-edit mr-2"></i> Edit
                                            </button>

                                            <button type="button" onclick="hapus('{{ route('petugas.hapus', $dt->id) }}')"
                                                class="btn btn-sm btn-flat btn-danger">
                                                <i class="fas fa-trash mr-2"></i> Hapus
                                            </button>
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

@endSection

@section('modal')
    <div class="modal fade" id="tambahPetugasModal" tabindex="-1" aria-labelledby="tambahPetugasModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('petugas.simpan') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPetugasModalLabel">Tambah Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nip_penandatangan">NIP Petugas</label>
                            <input type="text" name="nip_penandatangan"
                                class="form-control @error('nip_penandatangan') is-invalid @enderror" id="nip_penandatangan"
                                value="{{ old('nip_penandatangan') }}" placeholder="" autofocus maxlength="18">
                            @error('nip_penandatangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_penandatangan">Nama Petugas</label>
                            <input type="text" name="nama_penandatangan"
                                class="form-control @error('nama_penandatangan') is-invalid @enderror"
                                id="nama_penandatangan" value="{{ old('nama_penandatangan') }}" placeholder="" autofocus>
                            @error('nama_penandatangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kode_penandatangan">Jabatan
                                Petugas</label>
                            <select name="kode_penandatangan" id="kode_penandatangan"
                                class="form-control @error('kode_penandatangan') is-invalid @enderror">
                                <option value="">Pilih jabatan</option>
                                <option value="{{ PETUGAS_TTD_BPHTB_VERIFIKASI }}"
                                    {{ old('kode_penandatangan') == PETUGAS_TTD_BPHTB_VERIFIKASI ? 'selected' : '' }}>
                                    Verifikator
                                </option>
                                <option value="{{ PETUGAS_TTD_BPHTB_BENDAHARA }}"
                                    {{ old('kode_penandatangan') == PETUGAS_TTD_BPHTB_BENDAHARA ? 'selected' : '' }}>
                                    Bendahara Penerimaan
                                </option>
                            </select>
                            @error('kode_penandatangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default text-indigo" data-toggle="modal"
                            data-target="#tambahPetugasModal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-default bg-indigo">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPetugasModal" tabindex="-1" aria-labelledby="editPetugasModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formEditPetugas" action="" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPetugasModalLabel">Edit Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nip_penandatangan">NIP Petugas</label>
                            <input type="text" name="nip_penandatangan"
                                class="form-control @error('nip_penandatangan') is-invalid @enderror" id="nip_penandatangan"
                                value="{{ old('nip_penandatangan') }}" placeholder="" autofocus maxlength="18">
                            @error('nip_penandatangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_penandatangan">Nama Petugas</label>
                            <input type="text" name="nama_penandatangan"
                                class="form-control @error('nama_penandatangan') is-invalid @enderror"
                                id="nama_penandatangan" value="{{ old('nama_penandatangan') }}" placeholder="" autofocus>
                            @error('nama_penandatangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kode_penandatangan">Jabatan
                                Petugas</label>
                            <select name="kode_penandatangan" id="kode_penandatangan"
                                class="form-control @error('kode_penandatangan') is-invalid @enderror">
                                <option value="">Pilih jabatan</option>
                                <option value="{{ PETUGAS_TTD_BPHTB_VERIFIKASI }}"
                                    {{ old('kode_penandatangan') == PETUGAS_TTD_BPHTB_VERIFIKASI ? 'selected' : '' }}>
                                    Verifikator
                                </option>
                                <option value="{{ PETUGAS_TTD_BPHTB_BENDAHARA }}"
                                    {{ old('kode_penandatangan') == PETUGAS_TTD_BPHTB_BENDAHARA ? 'selected' : '' }}>
                                    Bendahara Penerimaan
                                </option>
                            </select>
                            @error('kode_penandatangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default text-indigo" data-toggle="modal"
                            data-target="#editPetugasModal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-default bg-indigo">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (Session::has('validator'))
        <script>
            @if (Session::get('validator') == 'store')
                $('#tambahPetugasModal').modal('show');
            @endif

            @if (Session::get('validator') == 'edit')
                $('#editPetugasModal').modal('show');
                $('#formEditPetugas').attr('action', "{{ Session::get('route') }}");
            @endif
        </script>
    @endif

    <script>
        $('.edit').click(function() {
            const route = $(this).attr('data-route');
            const nip = $(this).attr('data-nip');
            const nama = $(this).attr('data-nama');
            const kode = $(this).attr('data-kode');

            $('#editPetugasModal').modal('show');
            $('#formEditPetugas').attr('action', route);
            $('#formEditPetugas #nip_penandatangan').val(nip);
            $('#formEditPetugas #nama_penandatangan').val(nama);
            $('#formEditPetugas #kode_penandatangan').val(kode);
        });

        function hapus(route) {
            swal({
                title: "Yakin menghapus data ini ?",
                text: "Data akan dipindahkan ke tong sampah",
                icon: "warning",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {

                    window.location = route;

                } else {
                    swal("Cancel", "Data anda masih aman :)", "error");
                }
            });
        }
    </script>
@endsection
