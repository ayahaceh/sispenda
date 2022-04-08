<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('tittle') - BPHTB ONLINE {{ session()->get('datasatker')->nama_satker }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('/upload/app/logos/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    {{-- <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --> --}}
    <link rel="stylesheet" href="{{ asset('lte/css/GoogleSansPro.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/toastr/toastr.css') }}">
    @stack("styles")
</head>

<body class="hold-transition sidebar-mini">
    <!-- Ambil user_group  -->
    <?php
    $userGroupAktif = Auth()->user()->user_group;
    ?>
    <div class="wrapper">
        <!-- Navbar -->
        <!-- <nav class="main-header navbar navbar-expand navbar-navy navbar-dark"> -->
        <nav class="main-header navbar navbar-expand navbar-light bg-light border-0">

            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-indigo" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <div class="nav-link text-indigo">
                        <strong>{{ strtoupper(session()->get('datasatker')->nama_satker) }}</strong> |
                        ONLINE BPHTB
                    </div>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                @if (session()->has('sesiBaru'))
                @if (session('sesiBaru')['jumlahBaru'] >= 1)
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user text-indigo"></i>
                        <span class="badge badge-danger navbar-badge">
                            {{ session('sesiBaru')['jumlahBaru'] }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @if (session('sesiBaru')['jumlahUserBaru'] >= 1)
                        <span class="dropdown-item dropdown-header bg-indigo text-indigo">
                            <i class="fas fa-mail-bulk mr-2"></i> Data Masuk
                        </span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('user') }}" class="dropdown-item text-indigo">
                            <i class="fas fa-star mr-2 text-indigo"></i> Verifikasi Akun Baru
                            <span class="badge badge-danger float-right badge-sm">
                                {{ session('sesiBaru')['jumlahUserBaru'] }}
                            </span>
                        </a>
                        @endif

                        @if (session('sesiBaru')['jumlahProfilBaru'] >= 1)
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profil.user.baru') }}" class="dropdown-item text-indigo">
                            <i class="fas fa-star mr-2 text-indigo"></i> Verifikasi Profil WP Baru
                            <span class="badge badge-danger float-right badge-sm">
                                {{ session('sesiBaru')['jumlahProfilBaru'] }}</i></span>
                        </a>
                        @endif
                        {{-- @if (session('sesiBaru')['jumlahNopBaru'] >= 1)
                        <!-- <div class="dropdown-divider"></div>
                        <a href="{{ route('nop.pbb.verifikasi') }}" class="dropdown-item text-indigo">
                        <i class="fas fa-star mr-2 text-indigo"></i>
                        Verifikasi NOP Baru
                        <span class="badge badge-danger float-right badge-sm">
                            {{session('sesiBaru')['jumlahNopBaru']}}
                        </span>
                        </a> -->
                        @endif --}}

                        @if (session('sesiBaru')['jumlahTransaksiBaru'] >= 1)
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-indigo">
                            <i class="fas fa-star mr-2 text-indigo"></i>
                            Verifikasi BPHTB Baru
                            <span class="badge badge-danger float-right badge-sm">
                                {{ session('sesiBaru')['jumlahTransaksiBaru'] }}
                            </span>
                        </a>
                        @endif
                    </div>
                </li>
                @endif
                @endif


                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fab fa-xing-square text-indigo"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header bg-indigo">
                            Export Data
                        </span>
                        {{-- <div class="dropdown-divider"></div>
                        <a href="{{route('profil.user.export')}}" class="dropdown-item text-indigo">
                        <i class="fas fa-file-excel mr-2 text-indigo"></i> Data WP
                        <span class="badge bg-indigo float-right badge-sm"> <i class="fas fa-list"></i></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('nop.pbb.export')}}" class="dropdown-item text-indigo">
                            <i class="fas fa-file-excel mr-2 text-indigo"></i> Data NOP
                            <span class="badge bg-indigo float-right badge-sm"> <i class="fas fa-list"></i></span>
                        </a> --}}
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('bphtb.export') }}" class="dropdown-item text-indigo" data-toggle="modal" data-target="#filterExportModal">
                            <i class="fas fa-file-excel mr-2 text-indigo"></i> Export Data BPHTB
                            <span class="badge bg-indigo float-right badge-sm"> <i class="fas fa-list"></i></span>
                        </a>
                    </div>
                </li>


                <!-- Menu Download APK -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-cloud-download-alt text-indigo"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header bg-indigo">Download APK</span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ asset('upload/app/docs/BPHTB_APP.apk') }}" target="_blank" class="dropdown-item text-indigo">
                            <i class="fas fa-mobile-alt mr-2 text-indigo"></i> Aplikasi Mobile
                            <span class="float-right text-muted  text-yellow text-sm">BPHTB-APP.apk</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" target="_blank" class="dropdown-item  text-indigo">
                            <i class="fas fa-file-pdf mr-2 text-indigo"></i> Petunjuk Pemasangan
                        </a>
                        <!-- <a href="" class="dropdown-item dropdown-footer text-indigo">Cara Install</a> -->
                    </div>
                </li>
                <!-- .Menu Download APK -->

                @php
                $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
                $files = $disk->files('/' . env('BACKUP_NAME') . '/');
                $backups = [];
                foreach ($files as $k => $f) {
                if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                'file_name' => str_replace(config('laravel-backup.backup.name') . env('BACKUP_NAME') . '/', '', $f),
                'file_size' => $disk->size($f),
                'last_modified' => $disk->lastModified($f),
                ];
                }
                }

                $data = end($backups);
                @endphp

                <!-- Menu Database -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-database text-warning"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header bg-indigo">Status Database</span>
                        <div class="dropdown-divider"></div>
                        @if ($data !== false)
                        <a href="../../backup/{{ $data['file_name'] }}" class="dropdown-item  text-indigo">
                            <i class="fas fa-database mr-2 text-indigo"></i> Terakhir Backup
                            <span class="float-right text-muted text-yellow text-sm">
                                {{ \Carbon\Carbon::parse($data['last_modified'])->diffForHumans() }}
                            </span>
                            <span class="float-right text-muted text-sm">
                                {{ \App\Http\Controllers\Backup\DatabaseCont::humanFilesize($data['file_size']) }}
                            </span>
                            <div>
                                <small>Klik untuk mengunduh</small>
                            </div>
                        </a>
                        @else
                        <!-- <p class="text-sm p-3 d-flex justify-content-center">Database belum di backup!</p> -->
                        @endif
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('backup.database') }}" class="dropdown-item dropdown-footer text-indigo">
                            Backup Database
                        </a>
                    </div>
                </li>
                <!-- .Menu Database -->


                <!-- .Menu User -->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="/upload/users/comp/{{ Auth()->user()->foto }}" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline"> {{ Auth()->user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-indigo text-indigo">
                            <img src="/upload/users/comp/{{ Auth()->user()->foto }}" class="img-circle elevation-2" alt="User Image">
                            <p>
                                {{ Auth()->user()->nama }}
                                <small> {{ Auth()->user()->email }}</small>
                            </p>
                        </li>

                        <!-- Menu Body -->
                        <li class="user-body">
                            <a href="{{ route('my-account') }}" class="dropdown-item">
                                <i class="fa fa-edit text-indigo mr-2"></i> Akun Saya
                            </a>
                            <a href="{{ route('my.logs') }}" class="dropdown-item">
                                <i class="fa fa-bullseye text-indigo mr-2"></i> Aktivitas saya
                            </a>
                            <a href="{{ route('my-account.photo') }}" class="dropdown-item">
                                <i class="fas fa-file-image text-indigo mr-2"></i>Ganti Foto
                            </a>
                            <a href="{{ route('my-account.pass') }}" class="dropdown-item">
                                <i class="fa fa-ellipsis-h text-indigo mr-2"></i> Ubah Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="logout dropdown-item">
                                <i class="fas fa-sign-out-alt text-red mr-2 "></i> Keluar <i>(Sign Out)</i>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fa fa-question-circle text-indigo mr-2"></i> Petunjuk Penggunaan
                            </a>
                            <a href="{{ route('contactAdmin') }}" class="dropdown-item">
                                <i class="fa fa-envelope-square text-indigo mr-2"></i> Hubungi Admin
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-warning bg-indigo elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/home') }}" class="brand-link bg-indigo">
                <img src="/upload/app/logos/default.png" alt="BPHTB-Online" class="brand-image elevation-4" style="opacity: .8">
                <span class="brand-text font-weight-dark">BPHTB Online</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar nav-child-indent">

                <nav class="mt-3">
                    <!-- <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                        <!-- Ini untuk Home (Semua role BPKK) -->
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link <?= isset($menu_home) ? 'active text-warning' : '' ?>">
                                <i class="nav-icon fas fa-home text-white"></i>
                                <p class="text-white">
                                    Home
                                </p>
                            </a>
                        </li>

                        @if ($userGroupAktif == USER_SUPER_ADMIN)
                        <li class="nav-item">
                            <a href="{{ route('pbb') }}" class="nav-link <?= isset($menu_pbb) ? 'active text-warning' : '' ?>">
                                <i class="fas fa-handshake nav-icon text-white"></i>
                                <p class="text-white">PBB</p>
                            </a>
                        </li>
                        @endif
                        @if ($userGroupAktif == USER_OPERATOR || $userGroupAktif == USER_ADMIN || $userGroupAktif == USER_SUPER_ADMIN)
                        <li class="nav-item">
                            <a href="{{ route('bphtb') }}" class="nav-link <?= isset($menu_bphtb) ? 'active text-warning' : '' ?>">
                                <i class="fas fa-handshake nav-icon text-white"></i>
                                <p class="text-white">Daftar BPHTB</p>
                            </a>
                        </li>
                        @endif
                        @if ($userGroupAktif == USER_OPERATOR)
                        <li class="nav-item has-treeview  <?= isset($menu_tindakan_bphtb_group) ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link <?= isset($menu_tindakan_bphtb_group) ? 'active text-warning' : '' ?>">
                                <i class="nav-icon fas fa-mouse-pointer text-white"></i>
                                <p class="text-white">
                                    Menindak BPHTB
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('bphtb.verifikasi') }}" class="nav-link <?= isset($menu_tindakan_bphtb) && $menu_tindakan_bphtb == STATUS_BPHTB_BELUM_VERIFIKASI ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ STATUS_BPHTB_BELUM_VERIFIKASI }}</p>
                                    </a>
                                    <a href="{{ route('bphtb.verifikasi') }}?status={{ STATUS_PEMBAYARAN_BELUM_BAYAR }}" class="nav-link <?= isset($menu_tindakan_bphtb) && $menu_tindakan_bphtb == STATUS_PEMBAYARAN_BELUM_BAYAR ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ STATUS_PEMBAYARAN_BELUM_BAYAR }}</p>
                                    </a>
                                    <a href="{{ route('bphtb.verifikasi') }}?status=Sudah Bayar (pending)" class="nav-link <?= isset($menu_tindakan_bphtb) && $menu_tindakan_bphtb == 'Sudah Bayar (pending)' ? 'active' : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sudah Bayar (pending)</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if ($userGroupAktif == USER_KABID || $userGroupAktif == USER_KABAN || $userGroupAktif == USER_ADMIN)
                        {{-- <li
                                class="nav-item has-treeview  <?= isset($menu_persetujuan_bphtb_group) ? 'menu-open' : '' ?>">
                                <a href="#"
                                    class="nav-link <?= isset($menu_persetujuan_bphtb_group) ? 'active text-warning' : '' ?>">
                                    <i class="nav-icon fas fa-bold text-white"></i>
                                    <p class="text-white">
                                        Persetujuan BPHTB
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('pejabat.bphtb.belum-approve') }}"
                        class="nav-link <?= isset($menu_bphtb_belum) ? 'active text-warning' : '' ?>">
                        <i class="far fa-square nav-icon"></i>
                        <p>BPHTB Belum Disetujui</p>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pejabat.bphtb.sudah-approve') }}" class="nav-link <?= isset($menu_bphtb_sudah) ? 'active text-warning' : '' ?>">
                                <i class="far fa-check-square nav-icon"></i>
                                <p>BPHTB Telah Disetujui</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pejabat.bphtb.semua') }}" class="nav-link <?= isset($menu_bphtb_semua) ? 'active text-warning' : '' ?>">
                                <i class="fas fa-check-double nav-icon"></i>
                                <p>Semua BPHTB</p>
                            </a>
                        </li>
                    </ul>
                    </li> --}}
                    @endif
                    @if ($userGroupAktif == USER_ADMIN)
                    <li class="nav-item has-treeview  <?= isset($menu_tindakan_bphtb_group) || request()->routeIs('bphtb.pembatalan*') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= isset($menu_tindakan_bphtb_group) || request()->routeIs('bphtb.pembatalan*') ? 'active text-warning' : '' ?>">
                            <i class="nav-icon fas fa-mouse-pointer text-white"></i>
                            <p class="text-white">
                                Menindak BPHTB
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bphtb.verifikasi') }}" class="nav-link <?= isset($menu_tindakan_bphtb) && $menu_tindakan_bphtb == STATUS_BPHTB_BELUM_VERIFIKASI ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ STATUS_BPHTB_BELUM_VERIFIKASI }}</p>
                                </a>
                                <a href="{{ route('bphtb.verifikasi') }}?status={{ STATUS_PEMBAYARAN_BELUM_BAYAR }}" class="nav-link <?= isset($menu_tindakan_bphtb) && $menu_tindakan_bphtb == STATUS_PEMBAYARAN_BELUM_BAYAR ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ STATUS_PEMBAYARAN_BELUM_BAYAR }}</p>
                                </a>
                                <a href="{{ route('bphtb.verifikasi') }}?status=Sudah Bayar (pending)" class="nav-link <?= isset($menu_tindakan_bphtb) && $menu_tindakan_bphtb == 'Sudah Bayar (pending)' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sudah Bayar (pending)</p>
                                </a>
                                <a href="{{ route('bphtb.verifikasi') }}?status={{ STATUS_BPHTB_BELUM_DISETUJUI }}" class="nav-link <?= isset($menu_tindakan_bphtb) && $menu_tindakan_bphtb == STATUS_BPHTB_BELUM_DISETUJUI ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ STATUS_BPHTB_BELUM_DISETUJUI }}</p>
                                </a>
                                <a href="{{ route('bphtb.pembatalan.index') }}" class="nav-link <?= request()->routeIs('bphtb.pembatalan*') ? 'active' : '' ?> text-warning">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pembatalan BPHTB</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if ($userGroupAktif == USER_ADMIN)
                    <li class="nav-item has-treeview  <?= isset($menu_laporan_group) ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= isset($menu_laporan_group) ? 'active text-warning' : '' ?>">
                            <i class="nav-icon fas fa-chart-bar text-white"></i>
                            <p class="text-white">
                                Laporan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('laporan.bphtb.ringkasan.kas') }}" class="nav-link <?= isset($menu_laporan_bphtb) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-chart-bar nav-icon"></i>
                                    <p>Ringkasan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('laporan.bphtb.rekap.kas') }}" class="nav-link <?= isset($menu_laporan_rekap) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-chart-bar nav-icon"></i>
                                    <p>Rekap</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if ($userGroupAktif == USER_SUPER_ADMIN)
                    <!-- HANYA UNTUK SUPER ADMIN (SEMENTARA DISABLE) -->
                    <li class="nav-item has-treeview  <?= isset($menu_bphtb_group) ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= isset($menu_bphtb_group) ? 'active text-warning' : '' ?>">
                            <i class="nav-icon fas fa-bold text-white"></i>
                            <p class="text-white">
                                BPHTB
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('profil.user') }}" class="nav-link <?= isset($menu_profil) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-user nav-icon <?= isset($menu_profil) ? 'text-warning' : '' ?>"></i>
                                    <p>Profil WP</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('nop.pbb') }}" class="nav-link <?= isset($menu_nop_pbb) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-map-marked-alt nav-icon <?= isset($menu_nop_pbb) ? 'text-warning' : '' ?>"></i>
                                    <p>Data NOP</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('transaksi.peralihan') }}" class="nav-link <?= isset($menu_trans_bphtb) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-handshake nav-icon"></i>
                                    <p>BPHTB</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('bphtb') }}" class="nav-link <?= isset($menu_bphtb) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-handshake nav-icon"></i>
                                    <p>BPHTB Revisi</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    @endif


                    @if ($userGroupAktif == USER_SUPER_ADMIN)
                    <!-- HANYA UNTUK SUPER ADMIN (SEMENTARA DISABLE) -->
                    <li class="nav-item has-treeview  <?= isset($menu_tarif) ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= isset($menu_tarif) ? 'active text-warning' : '' ?>">
                            <i class="nav-icon fas fa-tags text-white"></i>
                            <p class="text-white">
                                Tarif
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('tarif.npoptkp') }}" class="nav-link <?= isset($menu_tarif_npoptkp) ? 'active text-warning' : '' ?>">
                                    <i class="far fa-circle nav-icon <?= isset($menu_tarif_npoptkp) ? 'text-warning' : '' ?>"></i>
                                    <p>Tarif NOPTKP</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tarif.njop') }}" class="nav-link <?= isset($menu_tarif_znt) ? 'active text-warning' : '' ?>">
                                    <i class="far fa-circle nav-icon <?= isset($menu_tarif_znt) ? 'text-warning' : '' ?>"></i>
                                    <p>Zona Nilai Tanah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tarif.bphtb') }}" class="nav-link <?= isset($menu_bphtb) ? 'active text-warning' : '' ?>">
                                    <i class="far fa-circle nav-icon <?= isset($menu_bphtb) ? 'text-warning' : '' ?>"></i>
                                    <p>Tarif BPHTB</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if ($userGroupAktif == USER_OPERATOR || $userGroupAktif == USER_ADMIN || $userGroupAktif == USER_SUPER_ADMIN)
                    <!-- User group 1,2,3 -->
                    <li class="nav-item has-treeview  <?= isset($menu_setting_web) ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= isset($menu_setting_web) ? 'active text-warning' : '' ?>">
                            <i class="nav-icon fas fa-globe-asia text-white"></i>
                            <p class="text-white">
                                Tampilan Web
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('web.public') }}" target="_blank" class="nav-link <?= isset($menu_web_publik) ? 'active text-warning' : '' ?>">
                                    <i class="far fa-circle nav-icon <?= isset($menu_web_publik) ? 'text-warning' : '' ?>"></i>
                                    <p>Lihat Web publik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('web.public.assets') }}" class="nav-link <?= isset($menu_web_assets) ? 'active text-warning' : '' ?>">
                                    <i class="far fa-circle nav-icon <?= isset($menu_web_assets) ? 'text-warning' : '' ?>"></i>
                                    <p>Ubah Video/Foto</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('web.public.profil-pejabat') }}" class="nav-link <?= isset($menu_web_profil) ? 'active text-warning' : '' ?>">
                                    <i class="far fa-circle nav-icon <?= isset($menu_web_profil) ? 'text-warning' : '' ?>"></i>
                                    <p>Ubah Ucapan Pejabat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('web.public.kanal-pembayaran') }}" class="nav-link <?= isset($menu_web_kanal_pembayaran) ? 'active text-warning' : '' ?>">
                                    <i class="far fa-circle nav-icon <?= isset($menu_web_kanal_pembayaran) ? 'text-warning' : '' ?>"></i>
                                    <p>Kanal Pembayaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('web.public.regulasi') }}" class="nav-link <?= isset($menu_web_regulasi) ? 'active text-warning' : '' ?>">
                                    <i class="far fa-circle nav-icon <?= isset($menu_web_regulasi) ? 'text-warning' : '' ?>"></i>
                                    <p>Ubah Regulasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if ($userGroupAktif == USER_ADMIN || $userGroupAktif == USER_SUPER_ADMIN)
                    <!-- User group 1,2,3 -->
                    <li class="nav-item has-treeview  <?= isset($menu_setting) ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= isset($menu_setting) ? 'active text-warning' : '' ?>">
                            <i class="nav-icon fas fa-users-cog text-white"></i>
                            <p class="text-white">
                                Pengaturan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user') }}" class="nav-link <?= isset($menu_setting_user) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-cog nav-icon <?= isset($menu_setting_user) ? 'text-warning' : '' ?>"></i>
                                    <p>Pengaturan User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('petugas') }}" class="nav-link <?= isset($menu_setting_petugas) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-cog nav-icon <?= isset($menu_setting_petugas) ? 'text-warning' : '' ?>"></i>
                                    <p>Pengaturan Petugas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user-groups') }}" class="nav-link <?= isset($menu_setting_user_group) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-cog nav-icon <?= isset($menu_setting_user_group) ? 'text-warning' : '' ?>"></i>
                                    <p>Role</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rekening') }}" class="nav-link <?= isset($menu_setting_rekening) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-cog nav-icon <?= isset($menu_setting_rekening) ? 'text-warning' : '' ?>"></i>
                                    <p>Rekening Penerimaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tarif.bphtb') }}" class="nav-link <?= isset($menu_bphtb) ? 'active text-warning' : '' ?>">
                                    <i class="far fa-circle nav-icon <?= isset($menu_bphtb) ? 'text-warning' : '' ?>"></i>
                                    <p>Tarif BPHTB</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('setting.satkers') }}" class="nav-link <?= isset($menu_setting_satker) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-cog nav-icon <?= isset($menu_setting_satker) ? 'text-warning' : '' ?>"></i>
                                    <p>Identitas Kantor</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li class="nav-item has-treeview  <?= isset($menu_logs) ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= isset($menu_logs) ? 'active text-warning' : '' ?>">
                            <i class="nav-icon fas fa-user-clock text-white"></i>
                            <p class="text-white">
                                Aktivitas User (Logs)
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('my.logs') }}" class="nav-link <?= isset($menu_my_logs) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-arrow-alt-circle-right nav-icon <?= isset($menu_my_logs) ? 'text-warning' : '' ?>"></i>
                                    <p>Logs Saya</p>
                                </a>
                            </li>
                            @if ($userGroupAktif == USER_SUPER_ADMIN)
                            <!-- Admin bisa lihat semua -->
                            <li class="nav-item">
                                <a href="{{ route('logs.pejabat') }}" class="nav-link <?= isset($menu_logs_pejabat) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-arrow-alt-circle-right nav-icon <?= isset($menu_logs_pejabat) ? 'text-warning' : '' ?>"></i>
                                    <p>Logs Pejabat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logs.admin') }}" class="nav-link <?= isset($menu_logs_admin) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-arrow-alt-circle-right nav-icon <?= isset($menu_logs_admin) ? 'text-warning' : '' ?>"></i>
                                    <p>Logs Admin</p>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('logs.operator') }}" class="nav-link <?= isset($menu_logs_operator) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-arrow-alt-circle-right nav-icon <?= isset($menu_logs_operator) ? 'text-warning' : '' ?>"></i>
                                    <p>Logs Operator</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logs.ppat') }}" class="nav-link <?= isset($menu_logs_ppat) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-arrow-alt-circle-right nav-icon <?= isset($menu_logs_ppat) ? 'text-warning' : '' ?>"></i>
                                    <p>Logs PPAT</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logs.publik') }}" class="nav-link <?= isset($menu_logs_publik) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-arrow-alt-circle-right nav-icon <?= isset($menu_logs_publik) ? 'text-warning' : '' ?>"></i>
                                    <p>Logs Publik</p>
                                </a>
                            </li>
                            @if ($userGroupAktif == USER_SUPER_ADMIN)
                            <li class="nav-item">
                                <a href="{{ route('logs.semua') }}" class="nav-link <?= isset($menu_logs_semua) ? 'active text-warning' : '' ?>">
                                    <i class="fas fa-arrow-alt-circle-right nav-icon <?= isset($menu_logs_semua) ? 'text-warning' : '' ?>"></i>
                                    <p>Semua</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    </ul>
                </nav><!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="text-indigo">@yield('tittle')</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <span class="badge bg-indigo">
                                    @yield('bread')
                                </span>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <!-- <div class="row"> -->
                    @yield('container')
                    <!-- </div> -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer no-print text-indigo d-print-none">
            <div class="float-right d-none d-sm-block">
                <small><b>ONLINE BPHTB </b> | Aceh Singkil</small>
            </div>
            <strong>Copyright &copy; 2021
                <a href="https://bpkk.acehsingkilkab.go.id" class="text-indigo">
                    {{ session()->get('datasatker')->nama_satker }}
                </a>.
            </strong>
            All rights reserved.
        </footer>


    </div>
    <!-- ./wrapper -->


    <!-- // Modal Export -->
    <div class="modal fade" id="filterExportModal" tabindex="-1" aria-labelledby="filterExportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('bphtb.export') }}" method="GET">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterExportModalLabel">Filter Export</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @php
                        $hari_ini = date('Y-m-d');
                        $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
                        $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));
                        @endphp
                        <div class="form-group">
                            <label for="start_date">Dari Tanggal</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $tgl_pertama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">Sampai Tanggal</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $tgl_terakhir }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default btn-sm text-indigo" data-toggle="modal" data-target="#filterExportModal">
                            <i class="fas fa-file-excel mr-2 ml-2"></i> Export
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- // Modal Export  -->

    @yield('modal')

    <!-- jQuery 4.2.2 -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery/jquery.form.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <!-- <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> -->
    <script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>
    <!-- <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script> -->
    <script src="{{ asset('lte/plugins/ckeditor/ckeditor.js') }}"></script>
    <!-- lte App -->
    <script src="{{ asset('lte/js/adminlte.min.js') }}"></script>

    @include('sweet::alert')
    @yield('script')
    @include('templates.toastMessage')

    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });

        $('body').on('click', '.logout', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            var me = $(this),
                url = me.attr('href');
            console.log(url);
            swal({
                title: "Apakah anda ingin logout ?",
                text: "Anda dapat login kembali untuk melanjutkan aktivitas",
                icon: "warning",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {
                    window.location = url;
                    // $('#logout-form').submit();
                    // document.getElementById('logout-form').submit();
                } else {
                    swal("Cancel", "Anda belum logout ", "error");
                }
            })
        });

        function previewImg() {
            const berkas = document.querySelector('#berkas');
            const berkaslabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');
            berkaslabel.textContent = berkas.files[0].name;

            const fileberkas = new FileReader();
            fileberkas.readAsDataURL(berkas.files[0]);
            fileberkas.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

        $(function() {
            //Enable check and uncheck all functionality
            $('.checkbox-toggle').click(function() {
                var clicks = $(this).data('clicks')
                if (clicks) {
                    //Uncheck all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
                    $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass(
                        'fa-square')
                } else {
                    //Check all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
                    $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass(
                        'fa-check-square')
                }
                $(this).data('clicks', !clicks)
            })
        })
    </script>

    @if (session::has('sukses'))
    <script>
        //Alert Sukses sweet alert!
        swal("sukses", "{!! Session::get('sukses') !!}", "success", {
            button: "OK",
        })
    </script>
    @endif
    @if (session::has('gagal'))
    <script>
        //Alert Gagal Toarts
        toastr.success("{!! Session::get('gagal') !!}");
    </script>
    @endif
    @if (session::has('success'))
    <script>
        toastr.success("{!! Session::get('success') !!}");
    </script>
    @endif
    @if (session::has('failur'))
    <script>
        toastr.error("{!! Session::get('failur') !!}");
    </script>
    @endif
    <script>
        $(".btn-refresh").click(function(e) {
            e.preventDefault();
            let url = $(this).data("url");
            if (url)
                return location.replace(url);
            location.reload();
        })
    </script>
    @stack("scripts")
</body>

</html>