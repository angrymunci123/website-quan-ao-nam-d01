@extends('customer.layout')
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container" style="background-image: url('temp_assets/img/banner.png')">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4 style="color: white">Cửa hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="/ktcstore" style="color: white">Trang chủ</a>
                            <span style="color: white">Cửa hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
     <br>
    <!-- Shop Section Begin -->
    <div class="app__container">
        <div class="grid">
            <div class="grid__row">
            <div class="grid__colunm-2">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Thể loại</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul>
                                                    <li><a href="/ktcstore/shop/category=Áo-thun">Áo Thun</a></li>
                                                    <li><a href="/ktcstore/shop/category=Áo-sơmi">Áo Sơmi</a></li>
                                                    <li><a href="/ktcstore/shop/category=Áo-nỉ">Áo Nỉ</a></li>
                                                    <li><a href="/ktcstore/shop/category=Áo-khoác">Áo Khoác</a></li>
                                                    <li><a href="/ktcstore/shop/category=Quần-âu">Quần Âu</a></li>
                                                    <li><a href="/ktcstore/shop/category=Quần-jogger">Quần Jogger</a></li>
                                                    <li><a href="/ktcstore/shop/category=Quần-jean">Quần Jeans</a></li>
                                                    <li><a href="/ktcstore/shop/category=Quần-short">Quần Short</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Hãng sản xuất</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    <li><a href="/ktcstore/shop/brand=Adam">Adam</a></li>
                                                    <li><a href="/ktcstore/shop/brand=Atino">Atino</a></li>
                                                    <li><a href="/ktcstore/shop/brand=Adidas">Adidas</a></li>
                                                    <li><a href="/ktcstore/shop/brand=Nike">Nike</a></li>
                                                    <li><a href="/ktcstore/shop/brand=Puma">Puma</a></li>
                                                    <li><a href="/ktcstore/shop/brand=H&M">H&M</a></li>
                                                    <li><a href="/ktcstore/shop/brand=MLB">MLB</a></li>
                                                    <li><a href="/ktcstore/shop/brand=Calvin-Klein">Calvin Klein</a></li>
                                                    <li><a href="/ktcstore/shop/brand=Valentino">Valentino</a></li>
                                                    <li><a href="/ktcstore/shop/brand=Levis">Levi's</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Lọc theo giá</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><a href="/ktcstore/shop/price=below-200">Dưới {{number_format(200000)}}đ</a></li>
                                                    <li><a href="/ktcstore/shop/price=200-500">{{number_format(200000)}}đ - {{number_format(500000)}}đ</a></li>
                                                    <li><a href="/ktcstore/shop/price=500-800">{{number_format(500000)}}đ - {{number_format(800000)}}đ</a></li>
                                                    <li><a href="/ktcstore/shop/price=800-1000">{{number_format(800000)}}đ - {{number_format(1000000)}}đ</a></li>
                                                    <li><a href="/ktcstore/shop/price=1000-1500">{{number_format(1000000)}}đ - {{number_format(1500000)}}đ</a></li>
                                                    <li><a href="/ktcstore/shop/price=1500-2000">{{number_format(1500000)}}đ - {{number_format(2000000)}}đ</a></li>
                                                    <li><a href="/ktcstore/shop/price=above-2000">Trên {{number_format(2000000)}}đ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="grid__column-10">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="shop__product__option__right">
                                        <p>Sắp xếp theo giá</p>
                                        <select id="sort_options">
                                            <option value="/ktcstore/shop">Thấp tới cao</option>
                                            <option value="/ktcstore/shop">Cao tới thấp</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="home-product">
                    <div class="grid__row">
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
                <div class="product__pagination">
                    @if ($products->lastPage() > 1)
                        <a class="active" href="{{ $products->previousPageUrl() }}">«</a>
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <a class="{{ $i === $products->currentPage() ? 'active' : '' }}" href="{{ $products->url($i) }}">{{ $i }}</a>
                        @endfor
                        <a class="active" href="{{ $products->nextPageUrl() }}">»</a>
                    @endif
                </div>
                <br>
            </div>
        </div>
        </div>
    </div>
    <br>
    <style>
        .product-card {
            box-shadow: none;
            transition: box-shadow 0.3s ease;
            border: 1px solid #ececec;
        }

        .product-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
