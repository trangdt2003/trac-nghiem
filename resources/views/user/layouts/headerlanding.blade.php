{{-- BACK 1 --}}
<section>

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('/public/asset_home') }}/img/fita.png" alt="">
                <h1 class="sitename">FITA TEST</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="">Trang chủ</a></li>
                    <li><a href="/login">Tài liệu</a></li>
                    <li><a href="/login">Đề thi</a></li>
                    <li>
                        <a href="/login">
                            <i class="bi bi-bell-fill"></i>
                        </a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            @if (Auth::check())
                <a class="btn-getstarted" href="">{{ Auth::user()->name }}</a>
            @else
                <a class="btn-getstarted" href="/login">Đăng nhập</a>
            @endif


        </div>
    </header>

</section>

