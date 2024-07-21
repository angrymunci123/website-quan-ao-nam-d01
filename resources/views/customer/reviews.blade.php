@extends('customer.layout')
@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4 style="color: white">Giỏ hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="/ktcstore" style="color: white">Trang chủ</a>
                        <a href="/ktcstore/shop" style="color: white">Cửa hàng</a>
                        <span style="color: white">Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<div class="container" style="background-color: #F3F2EE">
    <table class="table" style="background-color: #F3F2EE; padding-left: 15px; padding-right: 15px; border-style: none">
        <tr>
            <div style="width:1500px; margin:auto">
                <br>
                <h4>Đánh giá sản phẩm</h4>
                <div class="row">
                    <div class="col-lg-8">
                        <hr>
                        @if(Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @foreach($product_info as $product)
                            <table>
                                <tr>
                                    <th>
                                        <div class="product__cart__item__pic">
                                            <img src="/image/{{$product['image']}}" alt="blank" style="width:85px">
                                        </div>
                                    </th>
                                    <th>&nbsp;</th>
                                    <th>
                                        <div class="product__cart__item__text">
                                            <h5><a href="/ktcstore/product/{{$product['product_name']}}"
                                                    style="color:black">{{$product['product_name']}}</a></h5>
                                            @if ($product['sale_price'] > 0 && $product['sale_price'] < $product['price'])
                                                <h6>{{number_format($product['sale_price'])}}đ</h6>
                                            @else
                                                <h6>{{number_format($product['price'])}}đ</h6>
                                            @endif
                                        </div>
                                    </th>
                                </tr>
                            </table>
                            <hr>
                            <div class="feedback">
                                Cám ơn bạn đã mua sản phẩm tại cửa hàng của chúng tôi. Vui lòng đánh giá trải nghiệm sản
                                phẩm của bạn ở dưới
                                <hr>
                                <label>Đánh giá về chất lượng sản phẩm:</label>
                                <br>
                                <form method="POST" action="/ktcstore/reviews/send_reviews" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="_token" value="<?php    echo csrf_token()?>" />
                                    <input hidden type="number" name="product_id" value="{{$product['product_id']}}">
                                    <input hidden type="text" name="product_name" value="{{$product['product_name']}}">
                                    <span class="star-rating">
                                        <input type="radio" name="rating" value="1"><i></i>
                                        <input type="radio" name="rating" value="2"><i></i>
                                        <input type="radio" name="rating" value="3"><i></i>
                                        <input type="radio" name="rating" value="4"><i></i>
                                        <input type="radio" name="rating" value="5"><i></i>
                                    </span>
                                    <br><br>
                                    <div class="clear"></div>
                                    <label>Nội dung đánh giá:</label><br>
                                    <textarea cols="75" name="content" rows="5" style="width:100%" required></textarea>
                                    <br><br>
                                    <div class="clear"></div>
                                    <label>Hình ảnh (Nếu có):</label><br>
                                    <input type="file" name="image" id="image" class="form-control-ls">
                                    <hr>
                                    <div class="grid">
                                        <button type="submit" class="btn btn-warning" style="width: 140px; color:white">Gửi
                                            đánh giá</button>
                                </form>
                            </div>
                        @endforeach
                        <br>
                        @foreach($product_order as $order)
                            <form action="/ktcstore/order_detail/order_id={{$order->order_id}}" method="GET">
                                <button type="submit" class="btn btn-success" style="width: 110px; color:white">Quay
                                    lại</button>
                            </form>
                        @endforeach
                        <br>
                    </div>
                </div>
            </div>
</div>
</tr>
</table>
</div>
<br>
@endsection