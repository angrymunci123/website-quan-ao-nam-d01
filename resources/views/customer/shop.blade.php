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
                                                <ul class="nice-scroll">
                                                @foreach($products as $product)
                                                    <li><a href="#">{{$product->category}}</a></li>
                                                @endforeach
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
                                                @foreach($products as $product)
                                                    <li><a href="#">{{$product->brands}}</a></li>
                                                @endforeach
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
                                                    <li><a href="#">$0.00 - $50.00</a></li>
                                                    <li><a href="#">$50.00 - $100.00</a></li>
                                                    <li><a href="#">$100.00 - $150.00</a></li>
                                                    <li><a href="#">$150.00 - $200.00</a></li>
                                                    <li><a href="#">$200.00 - $250.00</a></li>
                                                    <li><a href="#">250.00+</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Kích cỡ</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                <label for="sm">s
                                                    <input type="radio" id="sm">
                                                </label>
                                                <label for="md">m
                                                    <input type="radio" id="md">
                                                </label>
                                                <label for="xl">xl
                                                    <input type="radio" id="xl">
                                                </label>
                                                <label for="2xl">2xl
                                                    <input type="radio" id="2xl">
                                                </label>
                                                <label for="xxl">xxl
                                                    <input type="radio" id="xxl">
                                                </label>
                                                <label for="3xl">3xl
                                                    <input type="radio" id="3xl">
                                                </label>
                                                <label for="4xl">4xl
                                                    <input type="radio" id="4xl">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFive">Màu sắc</a>
                                    </div>
                                    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__color">
                                                <label class="c-1" for="sp-1">
                                                    <input type="radio" id="sp-1">
                                                </label>
                                                <label class="c-2" for="sp-2">
                                                    <input type="radio" id="sp-2">
                                                </label>
                                                <label class="c-3" for="sp-3">
                                                    <input type="radio" id="sp-3">
                                                </label>
                                                <label class="c-4" for="sp-4">
                                                    <input type="radio" id="sp-4">
                                                </label>
                                                <label class="c-5" for="sp-5">
                                                    <input type="radio" id="sp-5">
                                                </label>
                                                <label class="c-6" for="sp-6">
                                                    <input type="radio" id="sp-6">
                                                </label>
                                                <label class="c-7" for="sp-7">
                                                    <input type="radio" id="sp-7">
                                                </label>
                                                <label class="c-8" for="sp-8">
                                                    <input type="radio" id="sp-8">
                                                </label>
                                                <label class="c-9" for="sp-9">
                                                    <input type="radio" id="sp-9">
                                                </label>
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
                                    <div class="shop__product__option__left">
                                        <p>Hiển thị 1-12 của 200 kết quả</p>
                                    </div>
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