<div class="section animated-row" data-section="slide07">
    <div class="section-inner">
        <div class="row justify-content-center">
            <div class="col-md-7 wide-col-laptop">
                <div class="title-block animate" data-animate="fadeInUp">
                    <span>Contact Us</span>
                    <h2>Hubungi Kami!</h2>
                </div>
                <div class="contact-section">
                    <div class="row">
                        <div class="col-md-6 animate" data-animate="fadeInUp">
                            <div class="contact-box">
                                <div class="contact-row">
                                    <i class="fa fa-map-marker"></i>
                                    {{ session()->get('datasatker')->nama_satker }}
                                    <br /> {{ session()->get('datasatker')->alamat_satker }}.
                                    {{ session()->get('datasatker')->kota_satker }}
                                    - {{ session()->get('datasatker')->prov_satker }}
                                </div>
                                <div class="contact-row">
                                    <i class="fa fa-phone"></i>
                                    {{ session()->get('datasatker')->telp_satker }}
                                </div>
                                <div class="contact-row">
                                    <i class="fa fa-envelope"></i>
                                    {{ session()->get('datasatker')->email_satker }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 animate" data-animate="fadeInUp">
                            <figure class="about-img animate" data-animate="fadeInUp"><img src="{{ $dataAssets->file_gambar }}" class="rounded" style="box-shadow: none;" alt="">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>