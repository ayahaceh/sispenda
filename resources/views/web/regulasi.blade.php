@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header bg-indigo">
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="card-title">
                            <i class="fas fa-balance-scale mr-2"></i>
                            Daftar Regulasi BPHTB
                        </h3>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('web.public.regulasi.tambah') }}" class="btn btn-default btn-sm btn-block text-indigo">
                            <i class="fas fa-plus-circle mr-2 ml-2"></i> Tambah
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead class="bg-indigo">
                        <tr>
                            <th>#</i></th>
                            <th>Nama Regulasi</th>
                            <th>Berkas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        @foreach ($dataRegulasi as $key => $Regulasi)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                <a href="#" class="text-indigo">
                                    {{ $Regulasi->nama_regulasi }}
                                </a>
                            </td>
                            <td>
                                <small><i> {{ $Regulasi->berkas_regulasi }}</i></small>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('web.public.regulasi.edit', ['id' => $Regulasi->id]) }}" class="btn btn-xs btn-warning"><i class="fas fa-edit mr-1"></i>
                                        Edit</a>
                                    <button type="button" class="btn btn-xs btn-danger hapus" data-id="{{ $Regulasi->id }}" data-route="{{ route('web.public.regulasi.hapus', ['id' => $Regulasi->id]) }}">
                                        <i class="fas fa-trash mr-1"></i>Hapus</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endSection

@section('script')
<script>
    $(".hapus").click(function() {
        const id = $(this).attr('data-id'),
            route = $(this).attr('data-route');

        swal({
            title: "Konfirmasi",
            text: "Apakah Anda ingin menghapus data ini?",
            icon: "warning",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: route,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data) {
                        if (data.message == 'success') {
                            window.location.reload();
                        }
                    },
                    error: function(error) {
                        toastr.error(
                            error.responseText,
                            'Error!')
                    }
                });
            }
        })
    });
</script>
@endsection