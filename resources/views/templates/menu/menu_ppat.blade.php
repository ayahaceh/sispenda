{{-- <!-- Menu WP -->
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" class="text-white">
        <i class="fas fa-user text-white"></i> WP
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header bg-indigo">Wajib Pajak</span>
        <div class="dropdown-divider"></div>
        <a href="{{ route('ppat.profil.user.valid') }}" class="dropdown-item text-indigo">
            <i class="fas fa-user mr-2"></i> Wajib Pajak Valid
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('ppat.profil.user') }}" class="dropdown-item text-warning">
            <i class="fas fa-user mr-2"></i> Wajib Pajak Belum di approve
        </a>
    </div>
</li>

<!-- Menu NOP -->
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" class="text-white">
        <i class="fas fa-map-marked-alt text-white"></i> NOP
        <!-- <span class="badge badge-warning navbar-badge">15</span> -->
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header bg-indigo">Nomor Objek Pajak</span>
        <div class="dropdown-divider"></div>
        <a href="{{ route('ppat.nop.pbb.valid') }}" class="dropdown-item text-indigo">
            <i class="fas fa-map-marked-alt mr-2"></i>NOP Valid
            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('ppat.nop.pbb') }}" class="dropdown-item text-indigo">
            <i class="fas fa-map-marked-alt mr-2"></i>NOP Belum di Aprove
            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
        </a>
    </div>
</li>

<!-- Menu BPHTB -->
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" class="text-white">
        <i class="fas fa-bold text-white"></i> BPHTB
        <!-- <span class="badge badge-warning navbar-badge">15</span> -->
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header bg-indigo">Daftar BPHTB</span>
        <div class="dropdown-divider"></div>
        <a href="{{ route('ppat.bphtb.create') }}" class="dropdown-item text-indigo">
            <i class="fas fa-clone mr-2 text-indigo"></i> Input BPHTB
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('ppat.bphtb') }}" class="dropdown-item text-indigo">
            <i class="fas fa-bold mr-2 text-indigo"></i> Daftar BPHTB
            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
        </a>
    </div>
</li> --}}
