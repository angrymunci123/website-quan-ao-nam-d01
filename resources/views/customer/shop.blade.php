@extends ('customer.layout')
@section('content')
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
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="/ktcstore/shop/search" method="GET" enctype='multipart/form-data'>
                            <input type="text" name="keywords" placeholder="Tìm kiếm...">
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
                                                <li><a href="/ktcstore/shop/price=below-200">Dưới
                                                        {{ number_format(200000) }}đ</a></li>
                                                <li><a href="/ktcstore/shop/price=200-500">{{ number_format(200000) }}đ
                                                        - {{ number_format(500000) }}đ</a></li>
                                                <li><a href="/ktcstore/shop/price=500-800">{{ number_format(500000) }}đ
                                                        - {{ number_format(800000) }}đ</a></li>
                                                <li><a href="/ktcstore/shop/price=800-1000">{{ number_format(800000) }}đ
                                                        - {{ number_format(1000000) }}đ</a></li>
                                                <li><a href="/ktcstore/shop/price=1000-1500">{{ number_format(1000000) }}đ
                                                        - {{ number_format(1500000) }}đ</a></li>
                                                <li><a href="/ktcstore/shop/price=1500-2000">{{ number_format(1500000) }}đ
                                                        - {{ number_format(2000000) }}đ</a></li>
                                                <li><a href="/ktcstore/shop/price=above-2000">Trên
                                                        {{ number_format(2000000) }}đ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Lọc theo thứ tự giá</a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="/ktcstore/shop/price-asc">Giá tăng dần</a></li>
                                                <li><a href="/ktcstore/shop/price-desc">Giá giảm dần</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="home-product">
                    <div class="grid__row">
                        @if ($products->isEmpty())
                            <div class="col-lg-12">
                                <p style="text-align: center; font-size: 18px; color: #333;">Không có sản phẩm nào để hiển
                                    thị.</p>
                            </div>
                        @else
                                        @foreach ($products as $product)
                                                        <div class="grid__column-2-4">
                                                            <div class="home-product-item">
                                                                @if ($product->sale_price == 0)
                                                                    <div class="product-card">
                                                                        <div class="home-product-item_img">
                                                                            <a href="/ktcstore/product/{{$product->product_name}}">
                                                                                <img src="/image/{{ $product->image }}">
                                                                            </a>
                                                                        </div>
                                                                        <a href="/ktcstore/product/{{$product->product_name}}">
                                                                            <h6 class="home-product-name"><b>{{ $product->product_name }}</b></h6>
                                                                        </a>
                                                                        <div class="home-product_price">
                                                                            <span style="font-size: 12px">
                                                                                <b
                                                                                    style="font-size: 16px; color: red">{{ number_format($product->price) }}đ</b>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if ($product->sale_price > 0)
                                                                                        <div class="product-card">
                                                                                            <div class="home-product-item_img">
                                                                                                <a href="/ktcstore/product/{{$product->product_name}}">
                                                                                                    <img src="/image/{{ $product->image }}">
                                                                                                </a>
                                                                                            </div>
                                                                                            <a href="/ktcstore/product/{{$product->product_name}}">
                                                                                                <h6 class="home-product-name"><b>{{ $product->product_name }}</b></h6>
                                                                                            </a>
                                                                                            <div class="home-product_price">
                                                                                                <span style="font-size: 12px">
                                                                                                    <del>{{ number_format($product->price) }}đ</del>
                                                                                                    <b
                                                                                                        style="font-size: 16px; color: red; margin-left:2px">{{ number_format($product->sale_price) }}đ</b>
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
                        @endif
                    </div>
                </div>
                <div class="product__pagination">
                    @if ($products->lastPage() > 1)
                        <a class="active" href="{{ $products->previousPageUrl() }}">«</a>
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <a class="{{ $i === $products->currentPage() ? 'active' : '' }}"
                                href="{{ $products->url($i) }}">{{ $i }}</a>
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
</section>
@endsection