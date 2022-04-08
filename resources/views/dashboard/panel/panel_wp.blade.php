<div class="row mb-2">
    <div class="col-sm-6 col-xl-3">
        <a href="{{ route('wp.profil-saya') }}" class="text-white">
            <div class="info-box {{ request()->routeIs('wp.profil-saya') ? 'bg-warning' : 'bg-indigo' }}"
                style="{{ request()->routeIs('wp.profil-saya') ? 'color: white !important' : '' }}">
                <span class="info-box-icon"><i class="fas fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Profil Saya</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Lihat
                    </span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
        <a href="{{ route('wp.bphtb.create') }}" class="text-white">
            <div class="info-box {{ request()->routeIs('wp.bphtb.create') ? 'bg-warning' : 'bg-indigo' }}"
                style="{{ request()->routeIs('wp.bphtb.create') ? 'color: white !important' : '' }}">
                <span class="info-box-icon"><i class="fas fa-file-invoice"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Pengajuan BPHTB</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Ajukan BPHTB
                    </span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
        <a href="{{ route('wp.bphtb') }}" class="text-white">
            <div class="info-box {{ request()->routeIs('wp.bphtb*') && request()->routeIs('wp.bphtb.create') == false ? 'bg-warning' : 'bg-indigo' }}"
                style="{{ request()->routeIs('wp.bphtb*') && request()->routeIs('wp.bphtb.create') == false ? 'color: white !important' : '' }}">
                <span class="info-box-icon"><i class="fas fa-map-marked-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Objek Pajak Saya</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Lihat
                    </span>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
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
