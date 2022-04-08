@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title"><i class="fas fa-user mr-2"></i> Update Password Saya</h3>
                </div><!-- /.card-header -->
                <form action="{{ route('user.updateProfilePassword', $users->id) }}" method="post"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="card-body table-responsive p-3">
                        <div class="row">
                            <div class="col-md-8 offset-2">
                                <div class="form-group row text-cyan">
                                    <label for="" class="col-sm-3 col-form-label text-primary">Password Lama</label>
                                    <div class="col-sm-9">
                                        <input name="current_password" type="password" id="current_password"
                                            placeholder="Masukkan password lama"
                                            class="form-control @error('current_password') is-invalid @enderror">
                                        @error('current_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row text-cyan">
                                    <label for="" class="col-sm-3 col-form-label text-primary">Password Baru</label>
                                    <div class="col-sm-9">
                                        <input name="new_password" type="password" id="new_password"
                                            placeholder="Masukkan password baru"
                                            class="form-control @error('new_password') is-invalid @enderror">
                                        @error('new_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row text-cyan">
                                    <label for="" class="col-sm-3 col-form-label text-primary">Konfirmasi Password
                                        Baru</label>
                                    <div class="col-sm-9">
                                        <input name="new_confirm_password" type="password" id="new_confirm_password"
                                            class="form-control @error('new_confirm_password') is-invalid @enderror"
                                            placeholder="Masukkan ulang password baru">
                                        @error('new_confirm_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-3 offset-7">
                                <button type="submit" class="btn btn-block bg-primary"><i class="fas fa-save mr-2"></i>
                                    Update Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.card -->
        </div>
    </div>
    <!-- /.row -->



@endSection

@section('script')
    <script>
        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
