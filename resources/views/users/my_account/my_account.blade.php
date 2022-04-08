@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row  d-flex justify-content-center">
    <div class="col-md-6">
        <div class="card card-default card-outline">
            <div class="card-header bg-light">
                <h3 class="card-title text-indigo"><i class="fas fa-user mr-2"></i> Informasi Akun </h3>
            </div>

            <form action="{{ route('my-account.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- <div class="row">
                        <div class="col-md-6"> -->

                    <div class="card card-body bg-indigo">
                        <div class="row">
                            <div class="col-sm-4">
                                <img id="preview_img" src="{{$users->file_foto}}" style="margin-bottom: 15px" class="" width="160" height="160" />
                                <!-- <input name="nik_lama" type="hidden" id="nik_lama" class="form-control" value="{{$users->nik }}"> -->
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" id="email" class="form-control" value="{{ $users->email }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 ">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="username" class="form-control" value="{{ $users->username }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_group" class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <select id="user_group" class="form-control" disabled>
                                            <option value="{{$users->user_group}}"> {{$users->usergroup->nama_group}} </option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .row -->
                    </div> <!-- .card -->

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
                                <a href="{{ route('home') }}" class="btn btn-block btn-warning">
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