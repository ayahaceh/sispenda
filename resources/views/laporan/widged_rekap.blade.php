@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-md-12">

        <!-- solid sales graph -->
        <div class="card bg-light">
            <div class="card-header border-0">
                <h3 class="card-title text-indigo">
                    <i class="fas fa-chart-bar mr-1"></i>
                    Pendapatan BPHTB Tahun Ini
                </h3>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card-body">
                        <canvas class="chart" id="lineChart" style="min-height: 250px; height: 250px; max-height: 500px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td><span class="badge bg-indigo">Pengajuan</span></td>
                                    <td><span class="badge badge-success">Penerimaan</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Banyak</td>
                                    <td id="countPengajuan"></td>
                                    <td id="countPenerimaan"></td>
                                </tr>
                                <tr>
                                    <td>Total nominal</td>
                                    <td id="sumPengajuan"></td>
                                    <td id="sumPenerimaan"></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div><!-- /.row -->
        </div>
    </div>

</div><!-- /.row -->


@endSection

@section('script')
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->
<script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
<script>

    $(document).ready(function() {
        init();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var ctxL = document.getElementById("lineChart").getContext('2d');

    function init(){
        $.ajax({
            url: "{{ route('ringkasan.bphtb.getLaporanRingkasan') }}",
            type: "GET",
            
            dataType: "JSON",
            success: function(data) {
                
                let labels = [];
                let data1 = [];
                let data2 = [];

                $.each(data.labels, function(key,value){
                    labels.push(value);
                }); 

                $.each(data.data1, function(key,value){
                    data1.push(value.total_setor);
                });

                $.each(data.data2, function(key,value){
                    data2.push(value.total_setor);
                });

                var myLineChart = new Chart(ctxL, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: "Jumlah Penerimaan BPHTB",
                                data: data1,
                                backgroundColor: [
                                    'rgba(105, 0, 132, .2)',
                                ],
                                borderColor: [
                                    'rgba(200, 99, 132, .7)',
                                ],
                                borderWidth: 2
                            },
                            {
                                label: "Jumlah Pengajuan BPHTB",
                                data: data2,
                                backgroundColor: [
                                    'rgba(0, 137, 132, .2)',
                                ],
                                borderColor: [
                                    'rgba(0, 10, 130, .7)',
                                ],
                                borderWidth: 2
                            }
                        ]
                    },
                    options: {
                        responsive: true
                    }
                });
                
                $("#countPengajuan").html(data.countPengajuan);
                $("#countPenerimaan").html(data.countPenerimaan);
                $("#sumPengajuan").html(data.sumPengajuan);
                $("#sumPenerimaan").html(data.sumPenerimaan);
            }
        });
    }

</script>
@endSection