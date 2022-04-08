@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<!-- /.row -->
<div class="row d-flex justify-content-center">
    <div class="col-md-4">
        <div class="card card-default card-outline border-0">
            <div class="card-header bg-indigo">
                <h3 class="card-title"><i class="fas fa-user mr-2"></i> Ubah Foto Profil</h3>
            </div><!-- /.card-header -->
            <form id="updatePhoto" action="{{ route('my-account.photo.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body text-indigo p-3">
                    <div class="form-group row d-flex justify-content-center">
                        <img id="preview_img" src="{{ $users->file_foto }}" style="margin-bottom: 15px" class="" width="250" height="250" />
                    </div>

                    <p class="text-center">Silahkan Pilih berkas Foto
                        <br />
                        <small>Format JPG, JPEG, atau GIF maksimal 1 MB</small>
                    </p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            0%
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center">
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" onchange="loadPreview(this);" class="form-control" required>
                            <label class="custom-file-label" for="foto">Pilih berkas foto</label>
                            @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div><!-- /.card-body -->
                <div class="card-footer">
                    <div class="row  d-flex justify-content-center">
                        <button type="submit" class="btn bg-indigo"><i class="fas fa-save mr-2"></i>Simpan</button>
                    </div>
                </div>
            </form>
        </div><!-- /.card -->
    </div>
</div>
<!-- /.row -->



@endSection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script type="text/javascript">
    $(function() {
        $('.progress').hide();
        // disable form's submit button after clicking on submit
        $(document).on('submit', 'form', function() {
            $('button').attr('disabled', 'disabled');
            $('.progress').show();
        });
    });

    function loadPreview(input, id) {
        id = id || '#preview_img';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(250)
                    .height(250);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection