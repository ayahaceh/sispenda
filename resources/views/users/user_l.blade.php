@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-12">
        <div class="card card-default card-outline">
            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-3">
                        <h3 class="card-title text-indigo">
                            <i class="fas fa-user-friends mr-2"></i>Manajemen User</a>
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('user') }}" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" name="cari" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search text-indigo"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('user.tambah') }}" class="btn btn-default btn-sm btn-block text-indigo">
                            <i class="fas fa-user-plus mr-2 ml-2"></i> Tambah User
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr class="text-indigo">
                            <th>#</i></th>
                            <th>Foto</th>
                            <th>Username / Email</th>
                            <th>Nama / NIK</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-dark">
                        @foreach ($manaj_user as $key => $mu)
                        <?php
                        if ($mu->status_user == 1) {
                            $warna = 'success';
                        } elseif ($mu->status_user == 2) {
                            $warna = 'info';
                        } elseif ($mu->status_user == 3) {
                            $warna = 'warning';
                        } elseif ($mu->status_user == 4) {
                            $warna = 'danger';
                        } else {
                            $warna = 'indigo';
                        }
                        ?>
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                <img src="{{ asset('/upload/users/comp/' . $mu->foto) }}" style="width: 50px; height: 50px;" class="user-image img-circle elevation-1" alt="User Image">
                            </td>
                            <td>
                                {{ $mu->username }}
                                <br />{{ $mu->email }}
                            </td>
                            <td>
                                {{ $mu->nama }} <br /> {{ $mu->nik }}
                            </td>
                            <td>
                                @isset($mu->usergroup->nama_group)
                                {{ $mu->usergroup->nama_group }}
                                @endisset
                            </td>
                            <td>
                                <div class="badge bg-{{$warna}}">{{$mu->joinStatusUser->nama_status}}</div>
                            </td>

                            <td>
                                <div class="btn-group">
                                    @if (auth()->user()->user_group <= 2) <!-- // Reset Password -->
                                        @if($mu->status_user >= 3)
                                        <form action="{{ route('user.aktivasi', $mu->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <button class="btn btn-sm btn-flat btn-success aktivasiFunction" data-toggle="tooltip" data-placement="bottom" title="Aktifkan User">
                                                <i class="fas fa-check-circle ml-2 mr-2"></i> Aktifkan
                                            </button>
                                        </form>
                                        @endif
                                        <!-- detail  -->
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" data-id="{{ $mu->id }}" data-username="{{ $mu->username }}" data-nama="{{ $mu->nama }}" data-email="{{ $mu->email }}" data-foto="{{ asset('/upload/users/comp/' . $mu->foto) }}" data-deskripsi="{{ $mu->deskripsi }}" data-terakhir="{{ $mu->terakhir }}" data-user_group="@isset($mu->usergroup->nama_group){{ $mu->usergroup->nama_group }}@endisset" data-verified_at="{{ $mu->email_verified_at }}" data-placement="bottom" title="Lihat Detail">
                                            <i class="fas fa-info-circle ml-2 mr-2"></i>
                                        </button>
                                        <!-- reset  -->
                                        <a href="{{ route('user.reset', $mu->id) }}" class="btn btn-sm btn-flat bg-indigo resetFunction" data-toggle="tooltip" data-placement="bottom" title="Reset Password">
                                            <i class="fas fa-undo-alt ml-2 mr-2"></i>
                                        </a>
                                        <!-- // Bekukan Aksess -->
                                        <a href="{{ route('user.freeze', $mu->id) }}" class="btn btn-sm btn-flat btn-danger freezeFunction" data-toggle="tooltip" data-placement="bottom" title="Bekukan Akses">
                                            <i class="fas fa-ban ml-2 mr-2"></i>
                                        </a>
                                        <!-- edit  -->
                                        <a href="{{ route('user.edit', $mu->id) }}" class="btn btn-sm bg-warning editFunction" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                            <i class="fas fa-edit ml-2 mr-2"></i>
                                        </a>
                                        <!-- hapus  -->
                                        <form action="{{ route('user.hapus', $mu->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            @if ($mu->id == auth()->user()->id)
                                            <button class="btn btn-sm btn-flat btn-danger deleteFunction" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                <i class="fas fa-trash-alt ml-2 mr-2"></i>
                                            </button>
                                            @else
                                            <button class="btn btn-sm btn-flat btn-danger deleteFunction" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                <i class="fas fa-trash-alt ml-2 mr-2"></i>
                                            </button>
                                            @endif
                                        </form>
                                        @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    {{ $manaj_user->links('templates.bootstrap-4') }}
                </div>
            </div>
        </div><!-- /.card -->
    </div> <!-- /.col -->
</div><!-- /.row -->



<!--MODAL DETIL-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-indigo">
            <div class="modal-header">
                <h5 class="modal-title block-title" id="exampleModalLabel"> MODAL TITLE </h5>
                <p id="tes"></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="post"> @csrf
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="form-group row text-cyan" style="padding: 10px">
                            <img src="" id="foto" class="col-sm-4 col-form-label" alt="foto-user" height="150px">
                            <div class="col-sm-8" style="margin-top: 20px">
                                <input type="text" id="username" class="form-control" style="margin-bottom: 5px;">
                                <input type="text" id="nama" class="form-control" style="margin-bottom: 5px;">
                                <input type="email" id="email" class="form-control" style="margin-bottom: 5px;">
                            </div>
                        </div>

                        <div class="form-group row text-cyan" style="padding: 10px">
                            <label for="verified_at" class="col-sm-4 col-form-label text-white">Verifikasi Pada</label>
                            <div class="col-sm-8">
                                <input name="verified_at" type="text" id="verified_at" class="form-control" style="margin-bottom: 5px" placeholder="Username Pengguna ..." required>
                            </div>
                            <label for="user_group" class="col-sm-4 col-form-label text-white">User Group</label>
                            <div class="col-sm-8">
                                <input name="user_group" type="text" id="user_group" class="form-control" style="margin-bottom: 5px" placeholder="Username Pengguna ..." required>
                            </div>
                            <label for="terakhir" class="col-sm-4 col-form-label text-white">Terakhir </label>
                            <div class="col-sm-8">
                                <input name="terakhir" type="text" id="terakhir" class="form-control" style="margin-bottom: 5px" placeholder="Username Pengguna ..." required>

                            </div>
                            <label for="deskripsi" class="col-sm-4 col-form-label text-white">Deskripsi</label>
                            <div class="col-sm-8">
                                <input name="deskripsi" type="text" id="deskripsi" class="form-control" style="margin-bottom: 5px" placeholder="Deskripsi ..." required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>

    @endSection


    @section('script')
    <script type="application/javascript">
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var username = button.data('username')
            var nama = button.data('nama')
            var email = button.data('email')
            var verified_at = button.data('verified_at')
            var user_group = button.data('user_group')
            var terakhir = button.data('terakhir')
            var deskripsi = button.data('deskripsi')
            var foto = button.data('foto')
            var modal = $(this)
            modal.find('.modal-title').text('DETAIL USER');
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #username').val(username);
            modal.find('.modal-body #nama').val(nama);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #verified_at').val(verified_at);
            modal.find('.modal-body #user_group').val(user_group);
            modal.find('.modal-body #terakhir').val(terakhir);
            modal.find('.modal-body #deskripsi').val(deskripsi);
            modal.find('.modal-body #foto').attr('src', foto);
            console.log(foto);
        });

        $('body').on('click', '.resetFunction', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            // var form = event.target.form;
            var url = $(this).attr("href");
            // console.log(form);
            console.log(url);
            swal({
                title: "Yakin ingin Melakukan Reset Password untuk akun User ini?",
                text: "Akun User yang telah direset password tidak dapat mengakses Portal BPHTB Online!",
                icon: "warning",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {
                    // form.submit(); 
                    window.location.href = url;
                } else {
                    swal("Cancel", "Aksi dibatalkan!", "error");
                }
            })
        });


        $('body').on('click', '.freezeFunction', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            // var form = event.target.form;
            var url = $(this).attr("href");
            // console.log(form);
            console.log(url);
            swal({
                title: "Yakin ingin membekukan akses User tersebut kedalam Portal BPHTB Online ?",
                text: "User yang telah dibekukan tidak dapat mengakses Portal BPHTB Online!",
                icon: "warning",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {
                    // form.submit(); 
                    window.location.href = url;
                } else {
                    swal("Cancel", "Aksi dibatalkan!", "error");
                }
            })
        });

        $('body').on('click', '.deleteFunction', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            var form = event.target.form;
            // var url = $(this).attr("href");
            console.log(form);
            // console.log(url);
            swal({
                title: "Yakin menghapus akun user ini ?",
                text: "Anda tidak dapat mengembalikan lagi akun user yang telah dihapus!",
                icon: "warning",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    // window.location.href = url;
                } else {
                    swal("Cancel", "Aksi dibatalkan!", "error");
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
                title: "Yakin ingin mengubah akun user ini ?",
                text: "Pastikan anda benar-benar ingin mengubah akun user ini!",
                icon: "warning",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {
                    // form.submit(); 
                    window.location.href = url;
                } else {
                    swal("Cancel", "Aksi dibatalkan!", "error");
                }
            })
        });

        $('body').on('click', '.aktivasiFunction', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            var form = event.target.form;
            // var url = $(this).attr("href");
            console.log(form);
            // console.log(url);
            swal({
                title: "Yakin ingin mengaktifkan akun user ini ?",
                text: "Setelah Aktivasi, user ini akan dapat melakukan login (masuk) kedalam Portal BPHTB!",
                icon: "warning",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    // window.location.href = url;
                } else {
                    swal("Cancel", "Aksi dibatalkan!", "error");
                }
            })

        });


        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        // $('#example').tooltip(options)
    </script>
    @endsection