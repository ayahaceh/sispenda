<div class="row d-flex justify-content-center">

    <div class="col-md-8">
        <form action="{{ route('dash.publik') }}" method="GET">
            <div class="input-group input-group-lg">
                <input type="text" name="cari" class="form-control" value="@isset($keyword){{$keyword}}@endisset" placeholder="Masukkan NIK atau NOP secara lengkap ...">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-lg btn-default bg-indigo">
                        <i class="fas fa-search mr-2"></i>Lihat
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@isset($data)
<div class="row d-flex justify-content-center mt-5">
    <h4 class="col-md-12">Hasil Pencarian <b class="text-indigo">@isset($keyword){{$keyword}}@endisset</b></h4>
    @forelse($data as $hasil )
    <div class="col-md-4 mt-2">
        <div class="position-relative p-3 bg-warning" style="height: 280px">
            <div class="ribbon-wrapper">
                <div class="ribbon bg-indigo">
                    Lunas
                </div>
            </div>
            <strong>
                {{ $hasil->nama_wp . ' - NIK ' . $hasil->nik }} <br />
                NOP. {{ $hasil->nop }} <br /> BPHTB Rp. {{ $hasil->format_jumlah_setor }}
            </strong>
            <br />
            <small class="text-indigo">
                Lokasi : {{ $hasil->letak_nop }} - Desa
                @isset($hasil->joinDesaNop->nama_desa){{ $hasil->joinDesaNop->nama_desa }} @endisset <br />
            </small>
            <small class="text-indigo">
                Alamat Wajib Pajak : {{ $hasil->letak_nop }} <br /> Desa
                @isset($hasil->joinDesaWp->nama_desa){{ $hasil->joinDesaWp->nama_desa }} @endisset <br />
            </small>
            <strong>
                Tgl. {{ date('j F, Y', strtotime($hasil->tgl_bphtb)) }}
            </strong>
        </div>
    </div>
    @empty
    <h4 class="text-danger col-md-12">
        TIDAK DITEMUKAN DATA BPHTB ATAS NOMOR NOP : <b class="text-indigo">@isset($keyword){{$keyword}}@endisset</b>
        <br />MAUPUN ATAS NIK : <b class="text-indigo">@isset($keyword){{$keyword}}@endisset</b>
    </h4>
    @endforelse
</div>
@endisset