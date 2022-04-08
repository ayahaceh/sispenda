 <!-- Kontak -->
 <div class="modal fade kontak" id="kontak" tabindex="-1" role="dialog" aria-labelledby="kontakTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kontakLongTitle">
                    <i class="fas fa-mobile-alt mr-2"></i>Kontak Wajib Pajak
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profil.user.updateKontak', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="hp" class="col-sm-3 col-form-label">Handphone</label>
                        <div class="col-sm-9">
                            <input name="hp" type="text" class="form-control" value="{{ $data->hp }}"
                                >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="wa" class="col-sm-3 col-form-label">WhatsApp</label>
                        <div class="col-sm-9">
                            <input name="wa" type="text" class="form-control" value="{{ $data->wa }}"
                                >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tg" class="col-sm-3 col-form-label">Telegram</label>
                        <div class="col-sm-9">
                            <input name="tg" type="text" class="form-control" value="{{ $data->tg }}"
                                >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input name="email" type="text" class="form-control" value="{{ $data->email }}"
                                >
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>