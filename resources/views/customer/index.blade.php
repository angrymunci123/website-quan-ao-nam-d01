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
                        <li class="active" data-filter="*">Best Sellers</li>
                        <li data-filter=".new-arrivals">New Arrivals</li>
                        <li data-filter=".hot-sales">Hot Sales</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-1.jpg')}}">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Piqué Biker Jacket</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$67.24</h5>
                            <div class="product__color__select">
                                <label for="pc-1">
                                    <input type="radio" id="pc-1">
                                </label>
                                <label class="active black" for="pc-2">
                                    <input type="radio" id="pc-2">
                                </label>
                                <label class="grey" for="pc-3">
                                    <input type="radio" id="pc-3">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-2.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Piqué Biker Jacket</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$67.24</h5>
                            <div class="product__color__select">
                                <label for="pc-4">
                                    <input type="radio" id="pc-4">
                                </label>
                                <label class="active black" for="pc-5">
                                    <input type="radio" id="pc-5">
                                </label>
                                <label class="grey" for="pc-6">
                                    <input type="radio" id="pc-6">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item sale">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-3.jpg')}}">
                            <span class="label">Sale</span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Multi-pocket Chest Bag</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$43.48</h5>
                            <div class="product__color__select">
                                <label for="pc-7">
                                    <input type="radio" id="pc-7">
                                </label>
                                <label class="active black" for="pc-8">
                                    <input type="radio" id="pc-8">
                                </label>
                                <label class="grey" for="pc-9">
                                    <input type="radio" id="pc-9">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-4.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Diagonal Textured Cap</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$60.9</h5>
                            <div class="product__color__select">
                                <label for="pc-10">
                                    <input type="radio" id="pc-10">
                                </label>
                                <label class="active black" for="pc-11">
                                    <input type="radio" id="pc-11">
                                </label>
                                <label class="grey" for="pc-12">
                                    <input type="radio" id="pc-12">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-5.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Lether Backpack</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$31.37</h5>
                            <div class="product__color__select">
                                <label for="pc-13">
                                    <input type="radio" id="pc-13">
                                </label>
                                <label class="active black" for="pc-14">
                                    <input type="radio" id="pc-14">
                                </label>
                                <label class="grey" for="pc-15">
                                    <input type="radio" id="pc-15">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                    <div class="product__item sale">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-6.jpg')}}">
                            <span class="label">Sale</span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Ankle Boots</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$98.49</h5>
                            <div class="product__color__select">
                                <label for="pc-16">
                                    <input type="radio" id="pc-16">
                                </label>
                                <label class="active black" for="pc-17">
                                    <input type="radio" id="pc-17">
                                </label>
                                <label class="grey" for="pc-18">
                                    <input type="radio" id="pc-18">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-7.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>T-shirt Contrast Pocket</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$49.66</h5>
                            <div class="product__color__select">
                                <label for="pc-19">
                                    <input type="radio" id="pc-19">
                                </label>
                                <label class="active black" for="pc-20">
                                    <input type="radio" id="pc-20">
                                </label>
                                <label class="grey" for="pc-21">
                                    <input type="radio" id="pc-21">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-8.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Basic Flowing Scarf</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$26.28</h5>
                            <div class="product__color__select">
                                <label for="pc-22">
                                    <input type="radio" id="pc-22">
                                </label>
                                <label class="active black" for="pc-23">
                                    <input type="radio" id="pc-23">
                                </label>
                                <label class="grey" for="pc-24">
                                    <input type="radio" id="pc-24">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->



    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset ('temp_assets/img/instagram/instagram-1.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset ('temp_assets/img/instagram/instagram-2.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset ('temp_assets/img/instagram/instagram-3.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset ('temp_assets/img/instagram/instagram-4.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset ('temp_assets/img/instagram/instagram-5.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset ('temp_assets/img/instagram/instagram-6.jpg')}}"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram Reels</h2>
                        <p>Nơi các chiến thần bàn phím combat mõm</p>
                        <h3>#socialmediain2024</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Tin tức mới nhất</span>
                        <h2>Các mặt hàng giảm giá</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/blog/blog-1.jpg')}}"></div>
                        <div class="blog__item__text">
                            <span><img src="{{ asset ('temp_assets/img/icon/calendar.png')}}" alt=""> 29 Tháng 2 2024</span>
                            <h5>Giảm giá 75% toàn bộ mặt hàng quần què</h5>
                            <a href="#">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/blog/blog-2.jpg')}}"></div>
                        <div class="blog__item__text">
                            <span><img src="{{ asset ('temp_assets/img/icon/calendar.png')}}" alt=""> 31 Tháng 4 2024</span>
                            <h5>Giảm giá 50% toàn bộ cửa hàng</h5>
                            <a href="#">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/blog/blog-3.jpg')}}"></div>
                        <div class="blog__item__text">
                            <span><img src="{{ asset ('temp_assets/img/icon/calendar.png')}}" alt=""> 30 Tháng 5 2024</span>
                            <h5>Sale cực sốc không mặt hàng nào cả</h5>
                            <a href="#">Đọc thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
@endsection
