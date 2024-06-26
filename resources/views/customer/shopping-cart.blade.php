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

@if(session()->has('shopping_cart_' . auth()->id()))
    @php
        $total_in_cart = 0;
    @endphp
    <section class="shopping-cart spad">
        <div style="width: 1300px; margin:auto">
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

                                    <th>Sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Kích Cỡ</th>
                                    <th class="text-center">Màu Sắc</th>
                                    <th class="text-center">Thành tiền</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session('shopping_cart_' . auth()->id()) as $product_id => $details)
                                                        @php
                                                            if ($details['sale_price'] > 0 && $details['sale_price'] < $details['price']) {
                                                                $total = $details['sale_price'] * $details['quantity'];
                                                                $total_in_cart += $total;
                                                            } else {
                                                                $total = $details['price'] * $details['quantity'];
                                                                $total_in_cart += $total;
                                                            }
                                                        @endphp
                                                        <tr data-id="{{$product_id}}">
                                                            <td class="product__cart__item"  style="width: 330px; padding-right: 10px">
                                                                <div class="product__cart__item__pic">
                                                                    <img src="/image/{{$details['image']}}" alt="blank" style="width:85px">
                                                                </div>
                                                                <div class="product__cart__item__text">
                                                                    <h5><a href="/ktcstore/product/{{$details['product_name']}}"
                                                                            style="color:black">{{$details['product_name']}}</a></h5>
                                                                    @if ($details['sale_price'] > 0 && $details['sale_price'] < $details['price'])
                                                                        <h6>{{number_format($details['sale_price'])}}đ</h6>

                                                                    @else
                                                                        <h6>{{number_format($details['price'])}}đ</h6>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="float-left">
                                                                    @if($details['quantity'] == 1)
                                                                        <form method="GET"
                                                                            action="{{ url('/ktcstore/shopping-cart/minus_cart/product_id=' . $details['product_id'] . '&product_detail_id=' . $details['product_detail_id']) }}">
                                                                            <button type="submit" class="btn btn-danger btn-sm" disabled>-</button>
                                                                        </form>
                                                                    @else
                                                                        <form method="GET"
                                                                            action="{{ url('/ktcstore/shopping-cart/minus_cart/product_id=' . $details['product_id'] . '&product_detail_id=' . $details['product_detail_id']) }}">
                                                                            <button type="submit" class="btn btn-danger btn-sm">-</button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                                {{ $details['quantity'] }}
                                                                <div class="float-right">
                                                                    @if($details['quantity'] == $details['total_quantity'])
                                                                        <form method="GET"
                                                                            action="{{ url('/ktcstore/shopping-cart/plus_cart/product_id=' . $details['product_id'] . '&product_detail_id=' . $details['product_detail_id']) }}">
                                                                            <button type="submit" class="btn btn-danger btn-sm" disabled>+</button>
                                                                        </form>
                                                                    @else
                                                                        <form method="GET"
                                                                            action="{{ url('/ktcstore/shopping-cart/plus_cart/product_id=' . $details['product_id'] . '&product_detail_id=' . $details['product_detail_id']) }}">
                                                                            <button type="submit" class="btn btn-danger btn-sm">+</button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="size__item text-center">
                                                                <div class="size">
                                                                    <div>
                                                                        <h5>{{$details['size']}}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="color__item text-center">
                                                                <div class="color">
                                                                    <div style="text-align: center">
                                                                        <h5>{{$details['color']}}</h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="cart__price text-center">{{number_format($total)}}đ</td>
                                                            <td class="cart__close">
                                                                <form method="GET" action="{{ url('/ktcstore/shopping-cart/remove_from_cart') }}">
                                                                    <input type="hidden" name="product_id" value="{{ $details['product_id'] }}">
                                                                    <input type="hidden" name="product_detail_id"
                                                                        value="{{ $details['product_detail_id'] }}">
                                                                    <button type="submit" style="border: solid white; background-color:white"><i
                                                                            class="fa fa-close"></i></button>
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
                    <div class="cart__total" >
                        <h6> Tổng tiền </h6>
                        <ul>
                            <li>Tổng tiền<span>{{ number_format($total_in_cart) }}đ</span></li>
                        </ul>
                        <a href="/ktcstore/checkout" class="primary-btn">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@if(!session()->has('shopping_cart_' . auth()->id()))
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" style="height:300px; margin:auto">
                    <img src="{{asset('/image/empty_cart.png')}}"
                        style="width:50%; display:block; margin-left:auto; margin-right:auto">
                    <br><br>
                    <h5 style="text-align:center">Không có sản phẩm nào trong giỏ hàng</h5>
                    <br>
                    <a href="/ktcstore/shop" class="primary-btn"
                        style="width:275px; display: block; margin: 0 auto; text-align: center;">Tiếp Tục Mua Hàng</a>
                </div>
            </div>
        </div>
    </section>
@endif
@endsection