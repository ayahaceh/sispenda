 <!-- Berkas Identitas -->
 <div class="modal fade berkasIdentitas" id="berkasIdentitas" tabindex="-1" role="dialog" aria-labelledby="berkasIdentitasTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="berkasIdentitasLongTitle">
                    <i class="fas fa-cloud-upload-alt mr-2"></i>Berkas Identitas
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profil.user.updateBerkasIdentitas', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-sm-4">
                            <img id="preview_img" src="{{ $data->file_foto }}" style="margin-bottom: 15px" class="" width="128" height="128" />
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="foto">Upload Foto Wajah</label>
                                <div class="custom-file">
                                    <input type="file" name="berkas_foto" class="custom-file-input @error('berkas_foto') is-invalid @enderror" id="berkas_foto" onchange="loadPreview(this);" class="form-control">
                                    <label class="custom-file-label" for="berkas_foto">Pilih Foto Maksimal 5
                                        MB...</label>
                                    @error('berkas_foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <label for="berkas_ktp">Upload Foto KTP</label>
                                <div class="custom-file">
                                    <input type="file" name="berkas_ktp" class="custom-file-input @error('berkas_ktp') is-invalid @enderror" id="berkas_ktp" class="form-control">
                                    <label class="custom-file-label" for="berkas_ktp">Pilih Foto KTP Maksimal 5
                                        MB...</label>
                                    @error('berkas_ktp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <label for="foto">Upload Foto Kartu Keluarga </label>
                                <div class="custom-file">
                                    <input type="file" name="berkas_kk" class="custom-file-input @error('berkas_kk') is-invalid @enderror" id="berkas_kk" class="form-control">
                                    <label class="custom-file-label" for="berkas_kk">Pilih foto Kartu Keluarga Maksimal 5
                                        MB</label>
                                    @error('berkas_kk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div> <!-- .row -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>