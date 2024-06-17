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

@if(session()->exists('shopping_cart'))
@php
$total_in_cart = 0;
@endphp
<section class="shopping-cart spad">
    <div style="width: 1500px; margin:auto">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 50%">Sản phẩm</th>
                                <th style="width: 17%">Số lượng</th>
                                <th style="width: 10%">Kích Cỡ</th>
                                <th style="width: 17%">Màu Săc</th>
                                <th style="width: 17%">Thành tiền</th>
                                <th style="width: 17%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('shopping_cart') as $product_id => $details)
                            @php
                            $total = $details['price'] * $details['quantity'];
                            $total_in_cart += $total;
                            @endphp
                            <tr data-id="{{$product_id}}">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="/image/{{$details['image']}}" alt="blank" style="width:85px">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{$details['product_name']}}</h6>
                                        <h5>{{number_format($details['price'])}}đ</h5>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="float-left">
                                        @if($details['quantity'] == 1)
                                            <form method="GET" action="{{ url('/ktcstore/shopping-cart/minus_cart/product_id='.$details['product_id'].'&product_detail_id='.$details['product_detail_id']) }}">
                                                <button type="submit" class="btn btn-danger btn-sm" disabled>-</button>
                                            </form>
                                        @else
                                            <form method="GET" action="{{ url('/ktcstore/shopping-cart/minus_cart/product_id='.$details['product_id'].'&product_detail_id='.$details['product_detail_id']) }}">
                                                <button type="submit" class="btn btn-danger btn-sm">-</button>
                                            </form>
                                        @endif
                                    </div>
                                    {{ $details['quantity'] }}
                                    <div class="float-right">
                                        @if($details['quantity'] == $details['total_quantity'])
                                            <form method="GET" action="{{ url('/ktcstore/shopping-cart/plus_cart/product_id='.$details['product_id'].'&product_detail_id='.$details['product_detail_id']) }}">
                                                <button type="submit" class="btn btn-danger btn-sm" disabled>+</button>
                                            </form>
                                        @else
                                            <form method="GET" action="{{ url('/ktcstore/shopping-cart/plus_cart/product_id='.$details['product_id'].'&product_detail_id='.$details['product_detail_id']) }}">
                                                <button type="submit" class="btn btn-danger btn-sm">+</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                                <td class="size__item">
                                    <div class="size">
                                        <div>
                                        <h5>{{$details['size']}}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="color__item">
                                    <div class="color">
                                        <div style="text-align: center">
                                            <h5>{{$details['color']}}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price">{{number_format($total)}}đ</td>
                                <td class="cart__close">
                                   <form method="GET" action="{{ url('/ktcstore/shopping-cart/remove_from_cart/product_id='.$details['product_id'].'&product_detail_id='.$details['product_detail_id']) }}">
                                    <button type="submit" ><i class="fa fa-close"></i></button>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="/ktcstore/shop">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6> Tổng tiền </h6>
                    <ul>
                        <li>Tổng tiền<span>{{ number_format($total_in_cart) }}đ</span></li>
                    </ul>
                    <a href="#" class="primary-btn">Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@if(!session()->exists('shopping_cart'))
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" style="height:300px; margin:auto">
                <img src="{{asset('/image/empty_cart.png')}}" style="width:50%; display:block; margin-left:auto; margin-right:auto">
                <br><br>
                <h5 style="text-align:center">Không có sản phẩm nào trong giỏ hàng</h5>
                <br>
                <a href="/ktcstore/shop" class="primary-btn" style="width:275px; display: block; margin: 0 auto; text-align: center;">Tiếp Tục Mua Hàng</a>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

