<!-- slider_area_start -->
<div class="slider_area ">
    <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-6 col-md-6">
                    <div class="illastrator_png">
                        <img src="home/img/banner/edu_ilastration.png" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="slider_info">
                        <h3>Belajar Agama <br>
                            Bersama Keluarga <br>
                            Dimanapun dan Kapanpun</h3>
                        @if (! auth()->check())
                        <a style="margin-top: 30px;" href="/register" class="boxed_btn">@lang('Daftar Gratis')</a>
                        @else
                        <a style="margin-top: 30px;" href="/register" class="boxed_btn">@lang('Mulai Belajar')</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->