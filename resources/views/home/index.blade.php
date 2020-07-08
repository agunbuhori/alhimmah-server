@extends('layouts.app')

@section('content')
@component('components.home.slider')
@endcomponent
<!-- testimonial_area_start -->
<div class="testimonial_area testimonial_bg_1 overlay">
    <div class="testmonial_active owl-carousel">
        <div class="single_testmoial">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="testmonial_text text-center">
                            <div class="author_img">
                                <img src="home/img/testmonial/author_img.png" alt="">
                            </div>
                            <p>
                                "Alhamdulillah kini belajar agama tidak sulit
                                dengan adanya madinah.id ana bisa belajar agama di rumah apalagi di masa pandemi seperti ini.

                            </p>
                            <span>- Albantany</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="single_testmoial">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="testmonial_text text-center">
                            <div class="author_img">
                                <img src="home/img/testmonial/author_img.png" alt="">
                            </div>
                            <p>
                                "Working in conjunction with humanitarian aid <br> agencies we have supported
                                programmes to <br>
                                alleviate.
                                human suffering.

                            </p>
                            <span>- Jquileen</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!-- testimonial_area_end -->

<!-- courses -->
<div class="courses">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center">
                    <h3>Belajar di madinah.id</h3>
                    <p>Berikut adalah beberapa keuntungan yang akan antum dapatkan <br>
                        jika belajar di madinah.id
                    </p>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-3 col-md-6 col-lg-6">
                <div class="feature text-center">
                    <div class="icon">
                        <i class="flaticon-art-and-design"></i>
                    </div>
                    <h3>GRATIS</h3>
                    <p>
                        Peserta bisa mengikuti pembelajaran secara gratis tanpa dipungut biaya.
                    </p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-6">
                <div class="feature text-center">
                    <div class="icon blue">
                        <i class="flaticon-business-and-finance"></i>
                    </div>
                    <h3>BERTAHAP</h3>
                    <p>
                        Materi disiapkan oleh tim kurikulum agar pembelajaran lebih bertahap dan berjenjang.
                    </p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-6">
                <div class="feature text-center">
                    <div class="icon">
                        <i class="flaticon-premium"></i>
                    </div>
                    <h3>EVALUASI</h3>
                    <p>
                        Akan ada ujian harian, mingguan, dan bulanan sebagai muroja'ah hasil belajar.
                    </p>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-6">
                <div class="feature text-center">
                    <div class="icon gradient">
                        <i class="flaticon-crown"></i>
                    </div>
                    <h3>SYAHADAH</h3>
                    <p>
                        Menyelesaikan pembelajaran peserta akan diberikan syahadah dengan transkrip nilai.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.courses -->
@endsection