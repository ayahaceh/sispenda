<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <a href="{{route('pejabat.bphtb.belum-approve')}}" class="text-warning">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="far fa-check-square"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Otorisasi BPHTB</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Lihat
                        @if(session()->has('sesiBaru'))
                        @isset(session('sesiBaru')['jumlahBelumApprove'])
                        @if (session('sesiBaru')['jumlahBelumApprove'] >= 1)
                        <span class="badge badge-danger float-right badge-sm">{{session('sesiBaru')['jumlahBelumApprove']}}</span>
                        @endif
                        @endisset
                        @endif
                    </span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <a href="{{route('pejabat.bphtb.semua')}}" class="text-warning">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="fas fa-check-double"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Data BPHTB</span>
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

    <div class="col-md-3 col-sm-6 col-12">
        <a href="{{route('ringkasan.bphtb.kas')}}" class="text-warning">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="fas fa-chart-bar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Grafik BPHTB</span>
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

    <div class="col-md-3 col-sm-6 col-12">
        <a href="#" class="text-warning">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="fas fa-user-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Aktivitas Operator</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Lihat semua aktivitas
                    </span>
                </div>
            </div>
        </a>
    </div>


</div>