<!-- header-start -->
<header>
    <div class="header-area ">
        <div id="{{ ! request()->is('/') ? '' : 'sticky-header' }}" class="main-header-area{{ request()->is('/') ? '' : ' sticky' }}">
            <div class="container-fluid p-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="/">
                                <img src="home/img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a {!! request()->is('/') ? 'class="active"' : '' !!} href="/">Beranda</a></li>
                                    <li><a {!! request()->is('kelas') ? 'class="active"' : '' !!} href="/kelas">Kelas</a></li>
                                    <li><a {!! request()->is('diskusi') ? 'class="active"' : '' !!} href="home/Courses.html">Ruang Diksusi</a></li>
                                    <!-- <li><a href="home/#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="home/course_details.html">course details</a></li>
                                                <li><a href="home/elements.html">elements</a></li>
                                            </ul>
                                        </li>
                                         -->
                                    <li><a href="home/contact.html">Kontak Kami</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                        <div class="log_chat_area d-flex align-items-center">
                            @if (! auth()->check())
                            <a href="/login" class="login">
                                <i class="fa fa-user"></i>
                                <span>@lang('Masuk')</span>
                            </a>
                            <div class="live_chat_btn">
                                <a class="boxed_btn_orange" href="/register">
                                    <span>@lang('Daftar Gratis')</span>
                                </a>
                            </div>
                            @else
                            <a href="/profile" class="login">
                                <i class="fa fa-user"></i>
                                <span>{{ auth()->user()->member_profile->name }}</span>
                            </a>

                            <a href="/logout" class="login">
                                <i class="fa fa-sign-out"></i>
                                <span>@lang('Keluar')</span>
                            </a>

                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-end -->