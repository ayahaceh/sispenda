@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card card-default card-outline">
                <div class="card-header bg-indigo">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">
                                <i class="fas fa-database mr-2"></i>Backup Database</a>
                            </h3>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('backup.database.create') }}"
                                class="btn btn-default btn-sm btn-block text-indigo">
                                <i class="fas fa-plus-circle mr-2 ml-2"></i> Buat Cadangan Baru
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead class="bg-indigo">
                            <tr>
                                <th>#</i></th>
                                <th>Nama File</th>
                                <th>Ukuran File</th>
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            @forelse  ($backups as $key => $data)
                                <tr>
                                    <td>
                                        {{ $key + 1 }}
                                    </td>
                                    <td>
                                        {{ $data['file_name'] }}
                                    </td>
                                    <td>
                                        {{ \App\Http\Controllers\Backup\DatabaseCont::humanFilesize($data['file_size']) }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($data['last_modified'])->diffForHumans() }}
                                    <td>
                                        <div class="btn-group">
                                            <a href="../../backup/{{ $data['file_name'] }}" class="btn btn-xs btn-info">
                                                <i class="fas fa-download mr-1"></i>
                                                Download
                                            </a>
                                            <button type="button" class="btn btn-xs btn-danger hapus"
                                                data-route="{{ route('backup.database.delete', ['file_name' => $data['file_name']]) }}">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div><!-- /.card -->
        </div> <!-- /.col -->
    </div><!-- /.row -->

@endSection

@section('script')
    <script>
        $(".hapus").click(function() {
            const route = $(this).attr('data-route');

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
