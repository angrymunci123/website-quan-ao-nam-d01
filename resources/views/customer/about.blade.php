@extends('customer.layout')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Về chúng tôi</h4>
                        <div class="breadcrumb__links">
                            <a href="/mainpage">Trang chủ</a>
                            <span>Về chúng tôi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__pic">
                        <img src="{{ asset ('temp_assets/img/about/about-us.jpg')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Chúng tôi là ai?</h4>
                        <p>Là nhóm vài thằng học ở BKACAD</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Chúng tôi làm gì?</h4>
                        <p>Làm đồ án tốt nghiệp</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Tại sao chọn chúng tôi?</h4>
                        <p>Tôi đéo nghĩ ra lý do gì nhưng hãy chọn chúng tôi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="testimonial__text">
                        <span class="icon_quotations"></span>
                        <p>“C6 Dori is the best Electro On-fielder”
                        </p>
                        <div class="testimonial__author">
                            <div class="testimonial__author__pic">
                                <img src="{{ asset ('temp_assets/img/about/testimonial-author.jpg')}}" alt="">
                            </div>
                            <div class="testimonial__author__text">
                                <h5>UnizZng</h5>
                                <p>Not a Genshin theorycrafter</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="testimonial__pic set-bg" data-setbg="{{ asset ('temp_assets/img/about/testimonial-pic.jpg')}}"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Team Section Begin -->
    <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Nhóm của chúng tôi</span>
                        <h2>Gặp gỡ các thành viên</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset ('temp_assets/img/about/team-1.jpg')}}" alt="">
                        <h4>Nguyễn Xuân Công</h4>
                        <span>lmao xd</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset ('temp_assets/img/about/team-2.jpg')}}" alt="">
                        <h4>Đặng Quốc KHánh</h4>
                        <span>C.E.O</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset ('temp_assets/img/about/team-3.jpg')}}" alt="">
                        <h4>Nguyễn Trung Thành</h4>
                        <span>Manager</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset ('temp_assets/img/about/team-4.jpg')}}" alt="">
                        <h4>John Cena</h4>
                        <span>Bingchilling</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->



@endsection
