 <!-- Data Diri -->
 <div class="modal fade dataDiri" id="dataDiri" tabindex="-1" role="dialog" aria-labelledby="dataDiriTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="dataDiriLongTitle">
                     <i class="fas fa-user mr-2"></i> Data Diri Wajib Pajak
                 </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('ppat.profil.user.updateDataDiri', $data->id) }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     @method('put')
                     <div class="form-group">
                         <label for="">Nama Lengkap</label>
                         <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
                     </div>
                     <div class="form-group">
                         <label for="">NIK</label>
                         <input type="text" class="form-control" name="nik" value="{{ $data->nik }}" required>
                     </div>
                     <div class="form-group">
                         <label for="">No KK</label>
                         <input type="text" class="form-control" name="kk" value="{{ $data->kk }}" required>
                     </div>
                     <div class="form-group">
                         <label for="">Jenis Kelamin</label>
                         <select name="jk" class="form-control" required>
                             <option value="Laki-laki" {{ ($data->jk=="Laki-laki") ? 'selected' : '' }}>Laki-laki</option>
                             <option value="Perempuan" {{ ($data->jk=="Perempuan") ? 'selected' : '' }}>Perempuan</option>
                         </select>
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