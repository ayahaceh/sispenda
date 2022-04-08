<div class="row mb-2">
    <div class="col-lg-4 col-xl-4">
        <a href="{{ route('ppat.bphtb') }}" class="text-white">
            <div class="info-box {{ request()->routeIs('ppat.bphtb') ? 'bg-warning' : 'bg-indigo' }}"
                style="{{ request()->routeIs('ppat.bphtb') ? 'color: white !important' : '' }}">
                <span class="info-box-icon"><i class="fas fa-file-invoice"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">List BPHTB</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Daftar BPHTB Saya
                    </span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-xl-4">
        <a href="{{ route('ppat.bphtb.create') }}" class="text-white">
            <div class="info-box {{ request()->routeIs('ppat.bphtb.create') ? 'bg-warning' : 'bg-indigo' }}"
                style="{{ request()->routeIs('ppat.bphtb.create') ? 'color: white !important' : '' }}">
                <span class="info-box-icon"><i class="fas fa-handshake"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Input Transaksi</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Menambahkan BPHTB
                    </span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-xl-4">
        <a href="{{ route('contactAdmin') }}" class="text-white">
            <div class="info-box {{ request()->routeIs('contactAdmin') ? 'bg-warning' : 'bg-indigo' }}"
                style="{{ request()->routeIs('contactAdmin') ? 'color: white !important' : '' }}">
                <span class="info-box-icon"><i class="fas fa-headset"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Hotline BPHTB</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Hubungi Layanan BPHTB
                    </span>
                </div>
            </div>
        </a>
    </div>
</div>
