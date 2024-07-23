@extends('customer.layout')
@section('content')
<!-- Hero Section Begin -->
<section>
    <div class="banner_main">
        <div class="banner_main-content">
            <h1 style="color: white"><b>KTC STORE</b></h1>
            <p style="color: white">Thương hiệu quần áo nam hàng đầu Việt Nam</p>
            <a href="/shop" class="banner_main-button">Mua Ngay</a>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section>
    <div class="app_container" style="padding-top: 20px; padding-bottom: 20px">
        <div class="section-title">
            <h2>THỂ LOẠI</h2>
        </div>
        <div class="grid">
            <div class="category_card">
                <a href="/ktcstore/shop/category=Áo-sơmi">
                    <img src="{{asset('/temp_assets/somi.png')}}" alt="Category Image"
                    class="category_image">
                </a>
                <a href="/ktcstore/shop/category=Áo-sơmi" class="category_text">Áo Sơmi</a>
            </div>
            <div class="category_card">
                <a href="/ktcstore/shop/category=Quần-âu">
                    <img src="{{asset('/temp_assets/quan_au.png')}}" alt="Category Image"
                    class="category_image">
                </a>
                <a href="/ktcstore/shop/category=Quần-âu" class="category_text">Quần Âu</a>
            </div>
            <div class="category_card">
                <a href="/ktcstore/shop/category=Áo-nỉ">
                <img src="{{asset('/temp_assets/jogger.png')}}" alt="Category Image"
                    class="category_image">
                </a>
                <a href="/ktcstore/shop/category=Áo-nỉ" class="category_text">Áo Nỉ</a>
            </div>
            <div class="category_card">
                <a href="/ktcstore/shop/category=Áo-thun">
                    <img src="{{asset('/temp_assets/thun.png')}}" alt="Category Image"
                    class="category_image">
                </a>
                <a href="/ktcstore/shop/category=Áo-thun" class="category_text">Áo Thun</a>
            </div>
        </div>
        <div class="grid" style="padding-top: 20px;">
        <div class="category_card">
                <a href="/ktcstore/shop/category=Quần-jean">
                    <img src="{{asset('/temp_assets/jean.png')}}" alt="Category Image"
                    class="category_image">
                </a>
                <a href="/ktcstore/shop/category=Quần-jean" class="category_text">Quần Jean</a>
            </div>
            <div class="category_card">
                <a href="/ktcstore/shop/category=Áo-nỉ">
                    <img src="{{asset('/temp_assets/ao_ni.png')}}" alt="Category Image"
                    class="category_image">
                </a>
                <a href="/ktcstore/shop/category=Áo-nỉ" class="category_text">Áo Nỉ</a>
            </div>
            <div class="category_card">
                <a href="/ktcstore/shop/category=Áo-khoác">
                    <img src="{{asset('/temp_assets/ao_khoac.png')}}" alt="Category Image"
                    class="category_image">
                </a>
                <a href="/ktcstore/shop/category=Áo-khoác" class="category_text">Áo Khoác</a>
            </div>
            <div class="category_card">
                <a href="/ktcstore/shop/category=Quần-short">
                    <img src="{{asset('/temp_assets/quan_dai.png')}}" alt="Category Image"
                    class="category_image" style="height: 266px">
                </a>
                <a href="/ktcstore/shop/category=Quần-short" class="category_text">Quần Short</a>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->
<br><br><br><br><br>
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="col-lg-12">
                <div class="section-title">
                    <h2>SẢN PHẨM BÁN CHẠY</h2>
                </div>
            </div>
        <div class="row product__filter">
            <div class="grid__row hot-sales">
                <!-- Foreach từ đây -->
                @foreach($products as $product)
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
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('temp_assets/img/blog/blog-1.jpg')}}">
                    </div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('temp_assets/img/icon/calendar.png')}}" alt="">29 Tháng 2 2024</span>
                        <h5>Giảm giá 75% cho những khách hàng lần đầu đặt hàng</h5>
                        <a href="#">Đọc thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('temp_assets/img/blog/blog-2.jpg')}}">
                    </div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('temp_assets/img/icon/calendar.png')}}" alt=""> 31 Tháng 4 2024</span>
                        <h5>Giảm giá tới 50% toàn bộ cửa hàng</h5>
                        <a href="#">Đọc thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('temp_assets/img/blog/blog-3.jpg')}}">
                    </div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('temp_assets/img/icon/calendar.png')}}" alt=""> 30 Tháng 5 2024</span>
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