<div class="section animated-row" data-section="slide06">
    <div class="section-inner">
        <div class="row justify-content-center">
            <div class="col-md-8 wide-col-laptop">
                <div class="title-block animate" data-animate="fadeInUp">
                    <span>Bank</span>
                    <h2>Kanal Pembayaran</h2>
                </div>
                <div class="gallery-section">
                    <div class="gallery-list owl-carousel">
                        @foreach ($dataKanal as $Kanal)
                        <div class="item animate" data-animate="fadeInUp">
                            <div class="portfolio-item">
                                <div class="thumb">
                                    <img src="{{ $Kanal->file_kanal }}" alt="">
                                </div>
                                <div class="thumb-inner animate" data-animate="fadeInUp">
                                    <h4>{{ $Kanal->nama_regulasi }}</h4>
                                    <p>{{ $Kanal->uraian_regulasi }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>