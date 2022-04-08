<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <a href="{{route('bpn.publik.bulan-ini')}}" class="text-white">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">BPHTB (Bulan Ini)</span>
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
        <a href="{{route('bpn.publik.semua')}}" class="text-white">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">BPHTB (Semua)</span>
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
        <a href="{{route('bpn.publik.eksport')}}" class="text-white" data-toggle="modal" data-target="#filterExportModal">
            <div class="info-box bg-indigo">
                <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Eksport Data BPHTB</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Export Data
                    </span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <a href="{{ route('contactAdmin') }}" class="text-white">
            <div class="info-box bg-indigo">
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


<!-- // Modal Export -->
<div class="modal fade" id="filterExportModal" tabindex="-1" aria-labelledby="filterExportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('bpn.publik.eksport') }}" method="GET">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterExportModalLabel">Filter Export</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                    $hari_ini = date("Y-m-d");
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