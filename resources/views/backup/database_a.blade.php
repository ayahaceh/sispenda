@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-6">
            <div class="card card-default card-outline">
                <div class="card-header bg-light">
                    <h3 class="card-title text-indigo">
                        <i class="fas fa-database mr-2"></i>Backup Database</a>
                    </h3>
                    <div class="card-tools">
                        <ul class="pagination pagination-sm">
                            <li class="page-item">
                                <a href="{{ route('backup.database') }}" class="page-link bg-indigo">
                                    <i class="fas fa-angle-double-left mr-2"></i>
                                    Kembali
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form id="backupForm" action="{{ route('backup.database.store') }}" method="POST">
                    @csrf
                    <div class="card-body table-responsive">
                        <div class="alert alert-success d-none" id="output">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="options" id="all" value="all" checked>
                                <label class="form-check-label ml-1" for="all">
                                    Backup semua data
                                </label>
                            </div>
                            <i class="ml-4">Untuk memproses ini membutuhkan waktu yang lama, jika koneksi Anda
                                bermasalah!</i>
                        </div>
                        {{-- <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="options" id="part" value="part">
                                <label class="form-check-label" for="part">
                                    Pilih sendiri data yang akan dibackup
                                </label>
                            </div>
                            <div class="ml-4 mt-2 py-2 px-3 bg-light rounded">
                                @foreach ($tables as $table)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="table[]"
                                            value="{{ $table->Tables_in_bphtb_singkil }}"
                                            id="{{ $table->Tables_in_bphtb_singkil }}">
                                        <label class="form-check-label" for="{{ $table->Tables_in_bphtb_singkil }}">
                                            {{ $table->Tables_in_bphtb_singkil }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-check ml-4 mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="selectAll">
                                <label class="form-check-label" for="selectAll">
                                    Pilih Semua
                                </label>
                            </div>
                        </div> --}}
                    </div><!-- /.card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-block bg-indigo">
                                    <i class="fa fa-database mr-2"></i> Backup
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.card -->
        </div> <!-- /.col -->
    </div><!-- /.row -->

@endSection

@section('script')
    <script>
        $("#backupForm").submit(function(e) {
            e.preventDefault();

            $("button[type='submit']").attr('disabled', 'disabled');
            $("button[type='submit']").text('Dikerjakan...');

            const route = $(this).attr('action');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: route,
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                success: function(data) {
                    if (data.message == 'all_success') {
                        toastr.success('Semua data telah dibackup', 'Berhasil')
                    }

                    $('#output').removeClass('d-none');
                    $('#output').html(data.output);

                    $("button[type='submit']").html(
                        '<i class="fa fa-database mr-2"></i> Backup ');
                    $("button[type='submit']").removeAttr('disabled', 'disabled');
                },
                error: function(error) {
                    $("button[type='submit']").html(
                        '<i class="fa fa-database mr-2"></i> Backup ');
                    $("button[type='submit']").removeAttr('disabled', 'disabled');

                    toastr.error(
                        error.responseText,
                        'Error!')
                }
            });
        });

        // $('#selectAll').change(function(e) {
        //     var checkboxes = document.getElementsByTagName('input');
        //     if (e.checked) {
        //         for (var i = 0; i < checkboxes.length; i++) {
        //             if (checkboxes[i].type == 'checkbox') {
        //                 checkboxes[i].checked = true;
        //             }
        //         }
        //     } else {
        //         for (var i = 0; i < checkboxes.length; i++) {
        //             if (checkboxes[i].type == 'checkbox') {
        //                 checkboxes[i].checked = false;
        //             }
        //         }
        //     }
        // })
    </script>
@endsection
