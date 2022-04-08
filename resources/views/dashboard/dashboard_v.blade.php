@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
    <?php $roleNow = Auth()->user()->user_group; ?>
    @if ($roleNow >= USER_ADMIN && $roleNow <= USER_OPERATOR) @include('dashboard.panel.panel_admin')
        <!-- // -->
    @elseif($roleNow >= USER_KABID && $roleNow <= USER_KABAN) @include('dashboard.panel.panel_pejabat')
        <!-- // -->
    @elseif($roleNow == USER_PPAT) @include('dashboard.panel.panel_ppat')
        <!-- // -->
    @elseif($roleNow == USER_WAJIB_PAJAK) @include('dashboard.panel.panel_wp')
    @elseif($roleNow == USER_BPN) @include('dashboard.panel.panel_bpn')
        <!-- // -->
    @elseif($roleNow == USER_PUBLIK) @include('dashboard.panel.panel_public')
        <!-- // -->
    @elseif($roleNow == USER_SUPER_ADMIN) @include('dashboard.panel.panel_admin')
        @include('dashboard.panel.panel_pejabat') @include('dashboard.panel.panel_ppat')
        @include('dashboard.panel.panel_wp') @include('dashboard.panel.panel_public')
    @endif @endSection @section('script')
@endSection
