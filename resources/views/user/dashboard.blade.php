@extends('user.master')
{{-- main content --}}
@section('main-content')
    <!-- Hero Section -->
    <section  class="hero section">
        <div class="hero-bg">
            <img src="{{ asset('/public/asset_home') }}/img/hero-bg-light.webp" alt="">
        </div>
        <div class="container text-center">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h1 data-aos="fade-up" class="">Welcome to <span>FITA TEST</span></h1>
                <p data-aos="fade-up" data-aos-delay="100" class="">Website thi trắc nghiệm online<br></p>
                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="/user/exam" class="btn-get-started">Vào thi!</a>
                    <a href="https://www.youtube.com/watch?v=CNf-t45XUZg" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Xem video</span></a>
                </div>
                <img src="{{ asset('/public/asset_home') }}/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section  class="featured-services section">

        <div class="container">

            <div class="row gy-4">

                <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-briefcase"></i></div>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">Nhận lại</a></h4>
                            <p class="description">Sử dụng FITA TEST giúp các bạn nhận được nhiều đề thi thử</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Item -->

                <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-card-checklist"></i></div>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">Hoàn thành</a></h4>
                            <p class="description">Hoàn thành mọi đề thi</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item d-flex">
                        <div class="icon flex-shrink-0"><i class="bi bi-bar-chart"></i></div>
                        <div>
                            <h4 class="title"><a href="#" class="stretched-link">Nâng cao</a></h4>
                            <p class="description">Nâng cao được điểm số sau từng đề thi</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section><!-- /Featured Services Section -->

    <!-- About Section -->
    <section  class="about section">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <p class="who-we-are">Chúng tôi là ai?</p>
                    <h3>Nhóm Fita Test</h3>
                    <p class="fst-italic">
                        Chúng tôi nỗ lực để tạo cho bạn trải nghiệm tốt nhất qua từng đề thi. Giúp các bạn nâng cao điểm số sau mỗi ngày ôn luyện!
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> <span>Tiện lợi.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Nhanh chóng.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Trải nghiệm.</span></li>
                    </ul>
                </div>

                <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <img src="{{ asset('/public/asset_home') }}/img/about-company-1.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6">
                            <div class="row gy-4">
                                <div class="col-lg-12">
                                    <img src="{{ asset('/public/asset_home') }}/img/about-company-2.jpg" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-12">
                                    <img src="{{ asset('/public/asset_home') }}/img/about-company-3.jpg" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section><!-- /About Section -->

    <!-- Clients Section -->
    <section  class="clients section">

        <div class="container" data-aos="fade-up">

            <div class="row gy-4">


                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="{{ asset('/public/asset_home') }}/img/logophp.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="{{ asset('/public/asset_home') }}/img/mysql.1.jpg" class="img-fluid" style="background-color: #ffffff" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="{{ asset('/public/asset_home') }}/img/logolrv.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="{{ asset('/public/asset_home') }}/img/favicon.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="{{ asset('/public/asset_home') }}/img/jquerry.jpg" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="{{ asset('/public/asset_home') }}/img/SSL.jpg" class="img-fluid" alt="">
                </div><!-- End Client Item -->

            </div>

        </div>

    </section><!-- /Clients Section -->

    <!-- Features Section -->
    <section  class="features section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2 class="">Đặc trưng</h2>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5 d-flex align-items-center">
                    <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                                <i class="bi bi-binoculars"></i>
                                <div>
                                    <h4 class="d-none d-lg-block">Tìm kiếm</h4>
                                    <p>
                                        Website hỗ trợ tìm kiếm các đề thi tài liệu, hỗ trợ các bạn sinh viên trong việc học tập
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                                <i class="bi bi-box-seam"></i>
                                <div>
                                    <h4 class="d-none d-lg-block">Tính tiện lợi</h4>
                                    <p>
                                        Chúng tôi nỗ lực để đưa tới sự tiện lợi tới cho các bạn, có thể thi thử, tìm tài liệu môn học mọi lúc mọi nơi, trong mọi hoàn cảnh
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                                <i class="bi bi-brightness-high"></i>
                                <div>
                                    <h4 class="d-none d-lg-block">Cập nhật</h4>
                                    <p>
                                        Chúng tôi sẽ thay các bạn cập nhật thường xuyên dữ liệu câu hỏi, tài liệu.
                                    </p>
                                </div>
                            </a>
                        </li>
                    </ul><!-- End Tab Nav -->

                </div>

                <div class="col-lg-6">

                    <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                        <div class="tab-pane fade active show" id="features-tab-1">
                            <img src="{{ asset('/public/asset_home') }}/img/tabs-1.jpg" alt="" class="img-fluid">
                        </div><!-- End Tab Content Item -->

                        <div class="tab-pane fade" id="features-tab-2">
                            <img src="{{ asset('/public/asset_home') }}/img/tabs-2.jpg" alt="" class="img-fluid">
                        </div><!-- End Tab Content Item -->

                        <div class="tab-pane fade" id="features-tab-3">
                            <img src="{{ asset('/public/asset_home') }}/img/tabs-3.jpg" alt="" class="img-fluid">
                        </div><!-- End Tab Content Item -->
                    </div>

                </div>

            </div>

        </div>

    </section><!-- /Features Section -->

    <!-- Services Section -->
    <section  class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Chức năng</h2>
            <p></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row g-5">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item item-cyan position-relative">
                        <i class="bi bi-activity icon"></i>
                        <div>
                            <h3>Tìm kiếm</h3>
                            <p>Tìm kiếm đề thi theo yêu cầu người dùng.</p>

                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item item-orange position-relative">
                        <i class="bi bi-broadcast icon"></i>
                        <div>
                            <h3>Lưu kết quả</h3>
                            <p>Lưu kết quả dự thi cho người dùng.</p>

                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item item-teal position-relative">
                        <i class="bi bi-easel icon"></i>
                        <div>
                            <h3>Tài liệu</h3>
                            <p>Lưu trữ tài liệu của các môn học.</p>

                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item item-red position-relative">
                        <i class="bi bi-bounding-box-circles icon"></i>
                        <div>
                            <h3>Đề thi</h3>
                            <p>Thường xuyên cập nhật các đề thi mới theo từng môn.</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item item-indigo position-relative">
                        <i class="bi bi-calendar4-week icon"></i>
                        <div>
                            <h3>Câu hỏi.</h3>
                            <p>Thường xuyên cập nhật các câu hỏi.</p>

                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-item item-pink position-relative">
                        <i class="bi bi-chat-square-text icon"></i>
                        <div>
                            <h3>Thông báo</h3>
                            <p>Nhận thông báo.</p>

                        </div>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section><!-- /Services Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Đánh giá</h2>
            <p>Đánh giá của một số cá nhân góp phần xây dựng thành công website FITA TEST</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper">
                <script type="application/json" class="swiper-config">
                    {
                      "loop": true,
                      "speed": 600,
                      "autoplay": {
                        "delay": 5000
                      },
                      "slidesPerView": "auto",
                      "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                      },
                      "breakpoints": {
                        "320": {
                          "slidesPerView": 1,
                          "spaceBetween": 40
                        },
                        "1200": {
                          "slidesPerView": 3,
                          "spaceBetween": 1
                        }
                      }
                    }
                </script>
                <style>
                    .testimonial-img {
                        border-radius: 70%; /* Làm cho hình ảnh trở thành hình tròn */
                        object-fit: cover; /* Đảm bảo hình ảnh luôn vừa vặn với khung, không quan tâm đến tỷ lệ */
                        width: 110px; /* Đặt chiều rộng của hình ảnh */
                        height: 100px; /* Đặt chiều cao của hình ảnh */
                    }
                </style>
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Website thi trắc nghiệm đã giúp đỡ chúng em rất nhiều trong việc ôn tập trước khi thi cử, chúc website ngày càng phát triển trong tương lai!</p>
                            <div class="profile mt-auto">
                                <img src="{{ asset('/public/asset_home') }}/img/testimonials/huy.jpg" class="testimonial-img" alt="">
                                <h3>Tuấn Huy</h3>
                                <h4>Sinh viên</h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Website không chỉ giúp chúng em làm những bài test mà còn giúp chúng em có những tài liệu cần thiết để chúng em có thể tham khảo, cảm ơn Website rất nhiều ạ!                </p>
                            <div class="profile mt-auto">
                                <img src="{{ asset('/public/asset_home') }}/img/testimonials/trang.jpg" class="testimonial-img" alt="">
                                <h3>Hà Trang</h3>
                                <h4>Sinh viên</h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Cảm ơn FITA TEST đã giúp đỡ chúng em trong thời gian ôn thi vừa qua, chúc cho website hoạt động được thật lâu dài!</p>
                            <div class="profile mt-auto">
                                <img src="{{ asset('/public/asset_home') }}/img/testimonials/thanh.jpg" class="testimonial-img" alt="">
                                <h3>Dương Thanh</h3>
                                <h4>Sinh viên</h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Cảm ơn FITA TEST đã giúp em vượt qua các kì thi khi học tại Học viện Nông nghiệp Việt Nam!</p>
                            <div class="profile mt-circle">
                                <img src="{{ asset('/public/asset_home') }}/img/testimonials/minh.jpg" class="testimonial-img" alt="">
                                <h3>Ngọc Minh</h3>
                                <h4>Sinh viên</h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                Cảm ơn website thi trắc nghiệm đã giúp tôi có thể kiếm tra cũng như hỗ trợ sinh viên,... trong việc ôn tập trước kì thi!</p>
                            <div class="profile mt-auto">
                                <img src="{{ asset('/public/asset_home') }}/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                                <h3>Văn Hoàng</h3>
                                <h4>Giảng viên</h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Testimonials Section -->

    <!-- Contact Section -->
    <section  class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Liên hệ</h2>
            <p></p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt"></i>
                        <h3>Địa chỉ</h3>
                        <p>Học viện Nông nghiệp Việt Nam, Trâu Quỳ, Gia Lâm, Hà Nội, Việt Nam</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-telephone"></i>
                        <h3>Gọi cho chúng tôi</h3>
                        <p>+84 384 869 xxx</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-envelope"></i>
                        <h3>Liên hệ cho chúng tôi qua Email</h3>
                        <p>fitatest2024@gmail.com</p>
                    </div>
                </div><!-- End Info Item -->

            </div>

            <div class="row gy-4 mt-1">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.698794566447!2d105.93063776870893!3d21.004707731964118!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a94c1f882977%3A0x6d016e6656923f46!2zSOG7jWMgdmnhu4duIE7DtG5nIE5naGnhu4dwIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1714930938980!5m2!1svi!2s" frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div><!-- End Google Maps -->

                <div class="col-lg-6">
                    <img src="{{ asset('/public/asset_home') }}/img/hero-bg-light.webp" alt="ảnh" style="width:636px;height:400px;">
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->
@endsection
