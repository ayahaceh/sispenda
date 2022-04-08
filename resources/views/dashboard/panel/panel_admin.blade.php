<div class="row">
    @if($roleNow == USER_ADMIN || $roleNow == USER_SUPER_ADMIN )
    <div class="col-md-3 col-sm-6 col-12">
        <a href="{{route('user')}}" class="text-white">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="fas fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Pendaftar Baru
                        @if(session('sesiBaru')['jumlahUserBaru'] >=1)
                        <i class="badge badge-warning mr-2 ml-2">{{session('sesiBaru')['jumlahUserBaru']}}</i>
                        @endif
                    </span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Lihat Akun Pendaftar Baru
                    </span>
                </div>
            </div>
        </a>
    </div>
    @endif

    <div class="col-md-3 col-sm-6 col-12">
        <a href="{{route('bphtb.verifikasi')}}" class="text-white">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="fas fa-handshake"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">BPHTB Online
                        @if(session('sesiBaru')['jumlahTransaksiBaru'] >=1)
                        <i class="badge badge-warning mr-2 ml-2">{{session('sesiBaru')['jumlahTransaksiBaru']}}</i>
                        @endif
                    </span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        BPHTB Diterima Online
                    </span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <a href="{{route('bphtb')}}" class="text-white">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="fas fa-clone"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">BPHTB</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Buat BPHTB Baru
                    </span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <a href="{{route('laporan.bphtb.rekap.kas')}}" class="text-white">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="fas fa-clone"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Pendapatan BPHTB</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        @if(session('sesiBaru')['jumlahPendapatan'] >= 0)
                        <i class="badge badge-warning mr-2 ml-2">Rp. {{session('sesiBaru')['formatJumlahPendapatan']}}</i>
                        @endif
                    </span>
                </div>
            </div>
        </a>
    </div>


</div>