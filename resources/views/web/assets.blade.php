@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-6">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title text-indigo">
                        <i class="fas fa-photo-video mr-2"></i>
                        Pilih Video / Gambar yang ingin di ubah!
                    </h3>
                </div>

                <form action="{{ route('web.public.assets.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-sm-12">

                                    <div class="border rounded mb-2 py-2 px-5 text-center"
                                        style="cursor: pointer; width: fit-content;" data-toggle="modal"
                                        data-target="#playVideoModal">
                                        <div class="d-flex justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo " fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" style="width: 50px">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span>Putar</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="video">Ubah Video Latar Halaman Depan Website</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas_video"
                                            class="custom-file-input @error('berkas_video') is-invalid @enderror"
                                            id="berkas_video" onchange="loadPreviewVideo(this);" class="form-control">
                                        <label class="custom-file-label" for="berkas_video">Pilih Video Maksimal 5 MB (mp4)
                                        </label>
                                        @error('berkas_video')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-sm-4">
                                        <img id="preview_img" src="{{ $dataAssets->file_gambar }}"
                                            class="mt-4 mb-2 img-thumbnail" width="320" height="230" />
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="gambar">Ubah Gambar Kantor</label>
                                        <div class="custom-file">
                                            <input type="file" name="berkas_gambar"
                                                class="custom-file-input @error('berkas_gambar') is-invalid @enderror"
                                                id="berkas_gambar" onchange="loadPreviewGambar(this);"
                                                class="form-control">
                                            <label class="custom-file-label" for="berkas_gambar">Pilih Foto Maksimal 1 MB
                                                (png, jpg atau jpeg)
                                            </label>
                                            @error('berkas_gambar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
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

@section('modal')
    <div class="modal fade" id="playVideoModal" tabindex="-1" aria-labelledby="playVideoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="playVideoModalLabel">Video sedang diputar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <video height="240" controls style="width: 100%; object-fit: fill; ">
                        <source src="{{ $dataAssets->file_video }}" type="video/mp4">
                        Browser (perambah) anda tidak mendukung pemutaran video ini!
                    </video>
                </div>
            </div>
        </div>
    </div>
@endsection

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
