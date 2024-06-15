@extends('customer.layout')
@section('content')
<!-- Breadcrumb Section Begin -->
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
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
@if(session()->exists('shopping_cart'))
@php 
$total_in_cart = 0; 
@endphp
<section class="shopping-cart spad">
    <div style="width:1500px; margin:auto">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    <table >
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Kích Cỡ</th>
                                <th>Màu Săc</th>
                                <th>Thành tiền</th>
                                <th></th>
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
                                <!-- <td class="quantity__item">
                                    <div class="quantity">
                                        <div class="pro-qty-2" data-id="Quantity">
                                            <input type="text" class="quantity cart_update" value="{{$details['quantity']}}" min="1">
                                        </div>
                                    </div>
                                </td> -->
                                <td class="text-center">
                                    <div class="float-left">
                                        @if($details['quantity'] == 1)
                                            <form method="GET" action="{{ url('/ktcstore/shopping-cart/minus_cart/product_id='.$details['product_id']) }}">
                                                <button type="submit" class="btn btn-danger btn-sm" disabled>-</button>
                                            </form>
                                        @else
                                            <form method="GET" action="{{ url('/ktcstore/shopping-cart/minus_cart/product_id='.$details['product_id']) }}">
                                                <button type="submit" class="btn btn-danger btn-sm">-</button>
                                            </form>
                                        @endif
                                    </div>
                                    {{ $details['quantity'] }}
                                    <div class="float-right">
                                        @if($details['quantity'] == $details['total_quantity'])
                                            <form method="GET" action="{{ url('/ktcstore/shopping-cart/plus_cart/product_id='.$details['product_id']) }}">
                                                <button type="submit" class="btn btn-danger btn-sm" disabled>+</button>
                                            </form>
                                        @else
                                            <form method="GET" action="{{ url('/ktcstore/shopping-cart/plus_cart/product_id='.$details['product_id']) }}">
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
                                        <div>
                                            <h5>{{$details['color']}}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price">{{number_format($total)}}đ</td>
                                <td class="cart__close">
                                    <!-- <i class="fa fa-close">
                                        <a href="{{ url('/ktcstore/shopping-cart/remove_cart/product_id='.$details['product_id']) }}"></a>
                                    </i> -->
                                    <a class="btn btn-danger mx-2"
                                        href="{{ url('/ktcstore/shopping-cart/remove_cart/product_id='.$details['product_id']) }}">Remove</a>
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
<!-- Shopping Cart Section End -->
@endsection
<!-- @section('scripts')
    <script type="text/javascript">

        $(".cart_update").change(function (e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '/storeIndex/cart/update_cart',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("td").find(".quantity").val()
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $(".cart_remove").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Bạn có thực sự muốn xóa sản phẩm này khỏi giỏ hàng không??")) {
                $.ajax({
                    url: '/ktcstore/shopping-cart/remove/{product_id}',
                    method: "POST",
                    data: {
                        _token: '{{csrf_token()}}',
                        product_id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                })
            }
        });
    </script>
@endsection -->