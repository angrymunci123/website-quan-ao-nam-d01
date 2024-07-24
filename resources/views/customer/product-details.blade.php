@extends('customer.layout')
@section('content')
<!-- Shop Details Section Begin -->
<section class="shop-details">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product__details__breadcrumb">
                    <a href="/ktcstore">Trang chủ</a>
                    <a href="/ktcstore/shop">Cửa hàng</a>
                    @foreach($product_details as $product_detail)
                        <span>{{$product_detail->product_name}}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @foreach($product_details as $product_detail)
        <div class="product__details__content">
            <div class="container">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                <table align="center" style="width: 100%">
                    <tr>
                        <td>
                            <div class="rowdy">
                                <div class="border">
                                    <img src="/image/{{$product_detail->image}}"
                                        style="width: 500px; height: 600px; object-fit: cover">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="ml-5">
                                <h2><b>{{$product_detail->product_name}}</b></h2>
                                <br>
                                @if ($product_detail->sale_price > 0)
                                    <del>{{number_format($product_detail->price)}}đ</del>
                                    <h3>{{number_format($product_detail->sale_price)}}đ</h3>
                                @else
                                    <h3>{{number_format($product_detail->price)}}đ</h3>
                                @endif
                                <br>
                                <div class="product__details__option">
                                    @if(session()->exists('user_id') && session('role') == 'Khách Hàng')
                                        <form action="/ktcstore/add_to_cart" method="post">
                                            @csrf
                                            <input type="hidden" name="product_detail_id" value="{{$product_detail->product_detail_id}}" />
                                            <input type="hidden" name="product_id" value="{{$product_detail->product_id}}" />
                                            <table>
                                                <th>
                                                    <div>
                                                        <label for="size"><b>Kích Cỡ</b></label>
                                                        <br>
                                                        <select name="size" id="size" class="form-control">
                                                            @foreach($product_size as $display_size)
                                                                <option name="size" value="{{$display_size->size}}">
                                                                    {{$display_size->size}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                <th>

                                                <th>
                                                    <div>
                                                        <label><b>Màu Sắc: </b></label>
                                                        <br>
                                                        <select name="color" id="color" class="form-control">
                                                            @foreach($product_colors as $color)
                                                                <option name="color" value="{{$color->color}}">{{$color->color}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                <th>
                                            </table>
                                            <br>
                                            <div class="quantity">
                                                <label><b>Số Lượng:</b></label>
                                                <div class="product__details__cart__option">
                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input id="quantity_input" type="number" name="quantity" value="1"
                                                                min="1" max="{{$product_detail->quantity}}">
                                                        </div>
                                                    </div>
                                                    <button type="submit" id="add_to_cart_message" class="primary-btn">Thêm Vào
                                                        Giỏ Hàng</button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                    @if(session('role') == 'Chủ Cửa Hàng' && session('role') == 'Nhân Viên')
                                        <table>
                                            <th>
                                                <div>
                                                    <label for="size"><b>Kích Cỡ</b></label>
                                                    <br>
                                                    <select name="size" id="size" class="form-control">
                                                        @foreach($product_size as $display_size)
                                                            <option name="size" value="{{$display_size->size}}">
                                                                {{$display_size->size}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            <th>

                                            <th>
                                                <div>
                                                    <label><b>Màu Sắc: </b></label>
                                                    <br>
                                                    <select name="color" id="color" class="form-control">
                                                        @foreach($product_colors as $color)
                                                            <option name="color" value="{{$color->color}}">{{$color->color}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            <th>
                                        </table>
                                        <br>
                                        <div class="quantity">
                                            <label><b>Số Lượng:</b></label>
                                            <div class="product__details__cart__option">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input id="quantity_input" type="number" name="quantity" value="1"
                                                            min="1" max="{{$product_detail->quantity}}">
                                                    </div>
                                                </div>
                                                <a type="submit" class="primary-btn" style="color:white"
                                                    onclick="return confirm('Xin chào {{session('fullname')}} (không phải là tài khoản khách hàng? Vui lòng đăng xuất và đăng nhập vào tài khoản khách hàng của bạn)')">
                                                    Mua Ngay
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    @if(!session('user_id'))
                                    <table>
                                            <th>
                                                <div>
                                                    <label for="size"><b>Kích Cỡ</b></label>
                                                    <br>
                                                    <select name="size" id="size" class="form-control">
                                                        @foreach($product_size as $display_size)
                                                            <option name="size" value="{{$display_size->size}}">
                                                                {{$display_size->size}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            <th>

                                            <th>
                                                <div>
                                                    <label><b>Màu Sắc: </b></label>
                                                    <br>
                                                    <select name="color" id="color" class="form-control">
                                                        @foreach($product_colors as $color)
                                                            <option name="color" value="{{$color->color}}">{{$color->color}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            <th>
                                        </table>
                                        <br>
                                        <div class="quantity">
                                            <label><b>Số Lượng:</b></label>
                                            <div class="product__details__cart__option">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input id="quantity_input" type="number" name="quantity" value="1"
                                                            min="1" max="{{$product_detail->quantity}}">
                                                    </div>
                                                </div>
                                                <a type="submit" href="/login" class="primary-btn" style="color:white">
                                                    Mua Ngay
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Mô Tả Sản
                                        Phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Đánh Giá</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Thông Tin Sản Phẩm</h5>
                                            <p>{{$product_detail->description}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content container"
                                        style="background-color:#ccc;padding: 12px; border-radius: 10px;">
                                        <div class="product__details__tab__content__item">
                                            <h5 style="color:black;">Đánh Giá</h5>
                                            @foreach($customer_review as $review)
                                                <div class="review-item"
                                                    style="padding-left:20px; padding-right:20px; padding-bottom: 20px; background-color: white">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h5 style="padding-top: 12px;">{{$review->fullname}}</h5>
                                                            <p class="review-date mb-1">{{$review->created_at}}</p>
                                                            @for($i = 0; $i < $review->rating; $i++)
                                                                <i class="fas fa-star checked"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <p class="mb-1" style="padding-top: 10px; text-align:justify">{{$review->content}}</p>
                                                    @if ($review->image)
                                                        <img src="/image/{{$review->image}}" style="width: 150px">
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
</section>
<!-- Shop Details Section End -->
<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Sản phẩm khác</h3>
            </div>
        </div>
        <div class="row">
        <div class="home-product">
                    <div class="grid__row">
                        <!-- Foreach từ đây -->
                        @foreach($other_products as $other_product)
                        <div class="grid__column-2-4">
                            <div class="home-product-item">
                            @if ($other_product->sale_price == 0)
                                <div class="product-card">
                                    <div class="home-product-item_img">
                                        <a href="/ktcstore/product/{{$other_product->product_name}}">
                                            <img src="/image/{{$other_product->image}}">
                                        </a>
                                    </div>
                                    <a href="/ktcstore/product/{{$other_product->product_name}}">
                                        <h6 class="home-product-name"><b>{{$other_product->product_name}}</b></h6>
                                    </a>
                                    <div class="home-product_price">
                                        <span style="font-size: 12px">
                                            <b style="font-size: 16px; color: red">{{number_format($other_product->price)}}đ</b>
                                        </span>

                                    </div>
                                </div>
                            @endif
                            @if ($other_product->sale_price > 0)
                                <div class="product-card">
                                    <div class="home-product-item_img">
                                        <a href="/ktcstore/product/{{$other_product->product_name}}">
                                            <img src="/image/{{$other_product->image}}">
                                        </a>
                                    </div>
                                    <a href="/ktcstore/product/{{$other_product->product_name}}">
                                        <h6 class="home-product-name"><b>{{$other_product->product_name}}</b></h6>
                                    </a>
                                    <div class="home-product_price">
                                        <span style="font-size: 12px">
                                            <del>{{number_format($other_product->price)}}đ</del>
                                            <b style="font-size: 16px; color: red; margin-left:2px">{{number_format($other_product->sale_price)}}đ</b>
                                        </span>
                                    </div>
                                    <div class='sale_off' class='sale_off_percent' style="margin-bottom:-20px; color:red">
                                        <span>
                                            <b>
                                                <?php
                                                $discount_percentage = (1 - ($other_product->sale_price / $other_product->price)) * 100;
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
    </div>
</section>
<!-- Related Section End -->
@endsection
<script>
    document.getElementById('add_to_cart_message').addEventListener('click', function (event) {
        var quantityInput = document.getElementById('quantity_input');
        if (parseInt(quantityInput.value) === 1) {
            event.preventDefault();
            alert('Số lượng phải lớn hơn 0');
        }
    });
</script>