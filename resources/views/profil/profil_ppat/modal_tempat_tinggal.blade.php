 <!-- Tempat Tinggal -->
 <div class="modal fade tempatTinggal" id="tempatTinggal" tabindex="-1" role="dialog" aria-labelledby="tempatTinggalTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="tempatTinggalLongTitle">
                     <i class="fas fa-map-marker-alt mr-2"></i>Tempat Tinggal Wajib Pajak
                 </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('ppat.profil.user.updateTempatTinggal', $data->id) }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     @method('put')
                     <div class="form-group row">
                         <label for="prov" class="col-sm-3 col-form-label">Provinsi</label>
                         <div class="col-sm-9">
                             <select name="kode_prov" id="provinsi" class="form-control" onchange="UpdateKab()">
                                 @foreach ($dataProv as $item)
                                 <option value="{{ $item->kode_prov }}" {{ ($data->kode_prov==$item->kode_prov) ? 'selected':'' }}> {{ $item->nama_prov }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <div class="form-group row">
                         <label for="kode_kab" class="col-sm-3 col-form-label">Kabupaten</label>
                         <div class="col-sm-9">
                             <select name="kode_kab" id="kabupaten" class="form-control" onchange="UpdateKec()">

                             </select>
                         </div>
                     </div>

                     <div class="form-group row">
                         <label for="kode_kec" class="col-sm-3 col-form-label">Kecamatan</label>
                         <div class="col-sm-9">
                             <select name="kode_kec" id="kecamatan" class="form-control" onchange="UpdateDesa()">

                             </select>
                         </div>
                     </div>

                     <div class="form-group row">
                         <label for="kode_desa" class="col-sm-3 col-form-label">Desa</label>
                         <div class="col-sm-9">
                             <select name="kode_desa" id="desa" class="form-control">

                             </select>
                         </div>
                     </div>

                     <div class="form-group row">
                         <label for="rtrw" class="col-sm-3 col-form-label">RT / RW </label>
                         <div class="col-sm-9">
                             <input name="rtrw" type="text" class="form-control" value="{{ $data->rtrw }}">
                         </div>
                     </div>

                     <div class="form-group row">
                         <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                         <div class="col-sm-9">
                             <textarea name="alamat" class="form-control">{{ $data->alamat }}</textarea>
                         </div>
                     </div>

                     <div class="form-group row">
                         <label for="kode_pos" class="col-sm-3 col-form-label">Kode Pos</label>
                         <div class="col-sm-9">
                             <input name="kode_pos" type="text" class="form-control" value="{{ $data->kode_pos }}">
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