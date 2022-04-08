@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-md-12">
        <div class="card card-default card-outline">
            <div class="card-header bg-light">
                <h3 class="card-title text-indigo"><i class="fas fa-user mr-2"></i> Tambah User Baru</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm">
                        <li class="page-item">
                            <a href="{{ url()->previous() }}" class="page-link text-indigo">
                                <i class="fas fa-angle-double-left text-indigo mr-2"></i>
                                Kembali
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <form action="{{ route('user.update', $users->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="card card-body bg-indigo">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input name="email" type="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $users->email }}" placeholder="Email ...">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-3 ">Username</label>
                                            <div class="col-sm-9">
                                                <input name="username" maxlength="25" type="text" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ $users->username }}" placeholder="Username ...">
                                                @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="user_group" class="col-sm-3 col-form-label">Role</label>
                                            <div class="col-sm-9">
                                                <select id="user_group" name="user_group" class="form-control" required>
                                                    <option value="{{$users->user_group}}"> {{$users->usergroup->nama_group}} </option>
                                                    @foreach($userGroup as $UG)
                                                    <option value="{{$UG->id}}">Akun {{$UG->nama_group}}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_group')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="foto" class="col-sm-3">Pilih Foto </label>
                                            <div class="col-sm-9">
                                                <div class="custom-file">
                                                    <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" onchange="loadPreview(this);" class="form-control">
                                                    <label class="custom-file-label" for="foto">Foto Maksimal 1 MB</label>
                                                    @error('foto')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- .row -->
                            </div> <!-- .card -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <img id="preview_img" src="{{$users->file_foto}}" style="margin-bottom: 15px" class="" width="120" height="120" />
                                    <!-- <input name="nik_lama" type="hidden" id="nik_lama" class="form-control" value="{{$users->nik }}"> -->
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">


                            <div class="card-header bg-indigo disabled p-2">
                                <h6><i class="fas fa-id-card mr-2"></i> Identitas </h6>
                            </div>
                            <br />
                            <div class="form-group row text-indigo">
                                <label for="nama" maxlength="30" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input name="nama" type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{$users->nama }}" placeholder="Nama Lengkap sesuai KTP ..." required>
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row text-indigo">
                                <label for="hp" class="col-sm-3 col-form-label">Handphone</label>
                                <div class="col-sm-9">
                                    <input name="hp" type="text" id="hp" maxlength="15" onkeypress="return hanyaAngka (event)" class="form-control @error('hp') is-invalid @enderror" value="{{$users->hp}}" placeholder="08..." required>
                                    @error('hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row text-indigo">
                                <label for="wa" class="col-sm-3 col-form-label">WhatsApp</label>
                                <div class="col-sm-9">
                                    <input name="wa" type="text" id="wa" maxlength="15" onkeypress="return hanyaAngka (event)" class="form-control @error('wa') is-invalid @enderror" value="{{ $users->wa }}" placeholder="08 (boleh dikosongkan) ">
                                    @error('wa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row text-indigo">
                                <label for="tg" class="col-sm-3 col-form-label">Telegram</label>
                                <div class="col-sm-9">
                                    <input name="tg" type="text" id="tg" maxlength="12" onkeypress="return hanyaAngka (event)" class="form-control @error('tg') is-invalid @enderror" value="{{ $users->tg }}" placeholder="ID Telegram (boleh dikosongkan) ">
                                    @error('tg')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('user') }}" class="btn btn-block btn-warning">
                                            <i class="fas fa-undo-alt mr-2"></i> Batal
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-block bg-indigo">
                                            <i class="fas fa-save mr-2"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
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
    // disable form's submit button after clicking on submit
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });

    $(document).ready(function() {
        $('#username').on({
            keydown: function(e) {
                if (e.which === 32) return false
            },
            keyup: function() {
                this.value = this.value.toLowerCase();
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
        });
    });

    function loadPreview(input, id) {
        id = id || '#preview_img';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
</script>
@endsection