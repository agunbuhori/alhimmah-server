<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <base href="{{ url('/') }}/"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edumark</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="home/site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="home/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="home/css/bootstrap.min.css">
    <link rel="stylesheet" href="home/css/owl.carousel.min.css">
    <link rel="stylesheet" href="home/css/font-awesome.min.css">
    <link rel="stylesheet" href="home/css/themify-icons.css">
    <!-- <link rel="stylesheet" href="home/css/nice-select.css"> -->
    <link rel="stylesheet" href="home/css/flaticon.css">
    <link rel="stylesheet" href="home/css/gijgo.css">
    <link rel="stylesheet" href="home/css/animate.css">
    <link rel="stylesheet" href="home/css/slicknav.css">
    <link rel="stylesheet" href="home/css/style.css">
    <link rel="stylesheet" href="home/css/custom.css">
    <!-- <link rel="stylesheet" href="home/css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="home/https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    @component('components.home.navbar')
    @endcomponent

    @yield('content')

    @component('components.home.footer')
    @endcomponent

    <!-- JS here -->
    <script src="home/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="home/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="home/js/popper.min.js"></script>
    <script src="home/js/bootstrap.min.js"></script>
    <script src="home/js/jquery.slicknav.min.js"></script>
    <script src="home/js/owl.carousel.min.js"></script>
    
    <script src="home/js/main.js"></script>
</body>

</html>