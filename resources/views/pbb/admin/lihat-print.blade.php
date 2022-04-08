<div class="modal-header">
    <div class="justify-content-between">
        Pajak Bumi dan Bangunan
    </div>
</div>
<div class="modal-body">
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link" id="custom-tabs-three-home-tab" data-toggle="pill" href="#tab-for-pbb" role="tab" aria-controls="tab-for-pbb" aria-selected="false">PBB</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-for-stts-tab" data-toggle="pill" href="#tab-for-stts" role="tab" aria-controls="tab-for-stts" aria-selected="false">STTS</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade active show" id="tab-for-pbb" role="tabpanel" aria-labelledby="tab-for-pbb-tab">
                    <div class="d-flex justify-content-between align-items-center">
                        <div> SURAT PAJAK BUMI DAN BANGUNAN (PBB)</div>
                        <button data-url="{{route('pbb.print',[$pbb->id,'pbb'])}}" class="btn  btn-success" id="print-pbb">Print</button>
                    </div>
                    <center>
                        @include("pbb.admin.make_pdf-pbb")
                    </center>
                </div>
                <div class="tab-pane fade" id="tab-for-stts" role="tabpanel" aria-labelledby="tab-for-stts-tab" style="overflow: hidden;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div> SURAT TANDA TERIMA SETORAN</div>
                        <div>
                            <button data-url="{{route('pbb.print',[$pbb->id,'stts'])}}" class="btn  btn-success" id="print-stts">Print</button>
                        </div>
                    </div>
                    <center>
                        @include("pbb.admin.make_pdf_stts")
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>

<script>
    $(document).ready(function() {
        $("#print-stts").on("click", function(e) {
            openWin($(this).data('url'))
        })
        $("#print-pbb").on("click", function(e) {
            openWin($(this).data('url'))
        })

        function openWin(url) {
            var myWindow = window.open(url);
            myWindow.document.close();
            myWindow.focus();
            myWindow.print();
            // myWindow.close();
        }
    })
</script>
