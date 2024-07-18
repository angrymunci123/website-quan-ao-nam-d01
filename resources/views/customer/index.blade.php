@extends('customer.layout')
@section('content')
  <!-- Hero Section Begin -->
  <section class="hero">
        <div class="hero__slider owl-carousel">
            {{-- hero slider 1 --}}
            <div class="hero__items set-bg" data-setbg="{{ asset ('temp_assets/img/hero/hero-1.jpg')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Bộ sưu tập mùa hè</h6>
                                <h2>Bộ sưu tập mùa hè 2024</h2>
                                <p></p>
                                <a href="#" class="primary-btn">Xem ngay<span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- hero slider 2 --}}
            <div class="hero__items set-bg" data-setbg="{{ asset ('temp_assets/img/hero/hero-2.jpg')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Bộ sưu tập mùa Đông</h6>
                                <h2>Bộ sưu tập Thu-Đông 2024</h2>
                                <p></p>
                                <a href="#" class="primary-btn">Xem ngay<span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="{{ asset ('temp_assets/img/banner/banner-1.jpg')}}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Quần đùi</h2>
                            <a href="#">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="{{ asset ('temp_assets/img/banner/banner-2.jpg')}}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Áo ba lỗ</h2>
                            <a href="#">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="{{ asset ('temp_assets/img/banner/banner-3.jpg')}}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Dép tổ ong</h2>
                            <a href="#">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="grid">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">Sản phẩm bán chạy</li>
                        <li data-filter=".new-arrivals">Sản phẩm mới</li>
                        <li data-filter=".hot-sales">Sản phẩm khuyến mãi</li>
                    </ul>
                </div>
            </div> 
            <div class="row product__filter">
            <div class="grid__row hot-sales">
                        <!-- Foreach từ đây -->
                        @foreach($hot_sales as $product)
                        <div class="grid__column-2-4">
                            <div class="home-product-item">
                            @if ($product->sale_price == 0)
                                <div class="product-card">
                                    <div class="home-product-item_img">
                                        <a href="/ktcstore/product/{{$product->product_name}}">
                                            <img src="/image/{{$product->image}}">
                                        </a>
                                    </div>
                                    <h6 class="home-product-name"><b>{{$product->product_name}}</b></h6>
                                    <div class="home-product_price">
                                        <span style="font-size: 12px">
                                            <b style="font-size: 16px; color: red">{{number_format($product->price)}}đ</b>
                                        </span>

                                    </div>
                                </div>
                            @endif
                            @if ($product->sale_price > 0)
                                <div class="product-card">
                                    <div class="home-product-item_img">
                                        <a href="/ktcstore/product/{{$product->product_name}}">
                                            <img src="/image/{{$product->image}}">
                                        </a>
                                    </div>
                                    <h6 class="home-product-name"><b>{{$product->product_name}}</b></h6>
                                    <div class="home-product_price">
                                        <span style="font-size: 12px">
                                            <del>{{number_format($product->price)}}đ</del>
                                            <b style="font-size: 16px; color: red; margin-left:2px">{{number_format($product->sale_price)}}đ</b>
                                        </span>
                                    </div>
                                    <div class='sale_off'>
                                        <span class='sale_off_percent'>
                                            <b>
                                                <?php
                                                $discount_percentage = (1 - ($product->sale_price / $product->price)) * 100;
                                                echo number_format($discount_percentage) . '%';
                                                ?>
                                            </b>
                                        </span>
                                        <span class='sale_off_label'><b>Giảm</b></span>
                                    </div>
                                </div>
                            @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>TIN TỨC MỚI</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/blog/blog-1.jpg')}}"></div>
                        <div class="blog__item__text">
                            <span><img src="{{ asset ('temp_assets/img/icon/calendar.png')}}" alt="">29 Tháng 2 2024</span>
                            <h5>Giảm giá 75% cho những khách hàng lần đầu đặt hàng</h5>
                            <a href="#">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/blog/blog-2.jpg')}}"></div>
                        <div class="blog__item__text">
                            <span><img src="{{ asset ('temp_assets/img/icon/calendar.png')}}" alt=""> 31 Tháng 4 2024</span>
                            <h5>Giảm giá tới 50% toàn bộ cửa hàng</h5>
                            <a href="#">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/blog/blog-3.jpg')}}"></div>
                        <div class="blog__item__text">
                            <span><img src="{{ asset ('temp_assets/img/icon/calendar.png')}}" alt=""> 30 Tháng 5 2024</span>
                            <h5>Deal cực sốc</h5>
                            <a href="#">Đọc thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
@endsection
