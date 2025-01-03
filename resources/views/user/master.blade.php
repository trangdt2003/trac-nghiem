<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>FITA TEST</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('/public/asset_home') }}/img/fita.png" rel="icon">
    <link href="{{ asset('/public/asset_home') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('/public/asset_home') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/public/asset_home') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('/public/asset_home') }}/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('/public/asset_home') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('/public/asset_home') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Main CSS File -->
    <link href="{{ asset('/public/asset_home') }}/css/main.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    {{-- header --}}
    @include('user.layouts.header')

     {{-- main menu --}}
     @yield('main-content')

  {{--footer  --}}
<footer id="footer" class="footer position-relative">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="" class="logo d-flex align-items-center">
                    <span class="sitename">FITA TEST</span>
                </a>

                <div class="social-links d-flex mt-4">
                    <a href="https://x.com/FitaTest2024" target="_blank"><i class="bi bi-twitter-x"></i></a>
                    <a href="https://www.facebook.com/fitatest" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.linkedin.com/in/fitatest" target="_blank"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Địa chỉ</h4>
                <ul>
                    <li><p>Học viện Nông nghiệp Việt Nam, Trâu Quỳ, Gia Lâm </p></li>
                    <li><p>Hà Nội, Việt Nam</p></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Phone</h4>
                <ul>
                    <li><span>+84 384 869 xxx</span></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Email</h4>
                <ul>
                    <li><span>fitatest2024@gmail.com</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">FITA TEST</strong><span>All Rights Reserved</span></p>
        <div class="credits">
            Designed by <a href="https://www.facebook.com/fitatest" target="_blank" >FITA TEST</a>
        </div>
    </div>

</footer>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<script src="{{ asset('/public/asset_home') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/public/asset_home') }}/vendor/aos/aos.js"></script>
<script src="{{ asset('/public/asset_home') }}/vendor/glightbox/js/glightbox.min.js"></script>
<script src="{{ asset('/public/asset_home') }}/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="{{ asset('/public/asset_home') }}/js/main.js"></script>
</body>

</html>
