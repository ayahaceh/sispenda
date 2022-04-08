<!-- Menu BPN DAN PUBLIK -->
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" class="text-white">
        <i class="fas fa-bold text-white"></i> BPHTB
        <!-- <span class="badge badge-warning navbar-badge">15</span> -->
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header bg-indigo">Daftar BPHTB</span>
        <div class="dropdown-divider"></div>
        <a href="{{route('bpn.publik.bulan-ini')}}" class="dropdown-item text-indigo">
            <i class="fas fa-calendar-alt mr-2 text-indigo"></i> BPHTB Bulan Ini
            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{route('bpn.publik.semua')}}" class="dropdown-item text-indigo">
            <i class="fas fa-calendar-alt mr-2 text-indigo"></i> Semua BPHTB
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{route('ringkasan.bphtb.kas')}}" class="dropdown-item text-indigo">
            <i class="fas fa-chart-bar mr-2 text-indigo"></i> Ringkasan BPHTB
        </a>
    </div>
</li>