<div class="section animated-row" data-section="slide04">
    <div class="section-inner">
        <div class="row justify-content-center">
            <div class="col-md-7 wide-col-laptop">
                <div class="title-block animate" data-animate="fadeInUp">
                    <span>Regulasi</span>
                    <h2>Peraturan</h2>
                </div>
                <div class="skills-row animate" data-animate="fadeInDown">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            @foreach ($dataRegulasi as $Regulasi)
                            <div class="skill-item">
                                <h6><a href="{{ $Regulasi->file_regulasi }}" target="_blank">
                                        {{ $Regulasi->nama_regulasi }}</a></h6>
                                <div class="skill-bar">
                                    <span><i class="fa fa-file-pdf-o"></i></span>
                                    <div class="filled-bar-2"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>