@extends('customer.layout')
@section('content')
 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4 style="color: white">Thanh toán</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html" style="color: white">Trang chủ</a>
                            <a href="./shop.html" style="color: white">Cửa hàng</a>
                            <span>Thanh toán</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
@if(session()->has('shopping_cart_' . auth()->id()))
    @php
    $total_in_cart = 0;
    @endphp
    <section class="checkout spad">
        <div style="width:100%; max-width:1300px; margin:auto">
            <div class="checkout__form">
                <form action="/ktcstore/purchase" method="POST" enctype='multipart/form-data'>
                @csrf
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <h6 class="checkout__title">Thông tin thanh toán</h6>
                            <div class="row">
                                    <div class="checkout__input">
                                        <p>Họ và tên người nhận<span>*</span></p>
                                        <input type="text" name="consignee" value="{{ $customer->fullname }}" style="color:black" required maxlength="255">
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" name="address" placeholder="Địa chỉ nhận hàng" class="checkout__input__add" style="color:black" value="{{ $customer->address }}" style="color:black" required maxlength="255">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text" name="phone_number" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ $customer->phone_number }}" style="color:black" required minlength="10" maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span> (Nếu có)</span></p>
                                <input type="text" name="notes" placeholder="Ghi chú về đơn hàng" style="color:black">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Đơn hàng</h4>
                                <table class="table">
                                    <tr>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Màu sắc</th>
                                        <th scope="col">Đơn giá</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                    @foreach ($shopping_cart as $cart => $details)
                                    @php
                                        if ($details['sale_price'] > 0 && $details['sale_price'] < $details['price'])
                                        {
                                            $total = $details['sale_price'] * $details['quantity'];
                                            $total_in_cart += $total;
                                        }
                                        else
                                        {
                                            $total = $details['price'] * $details['quantity'];
                                            $total_in_cart += $total;
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-center"><a href="/ktcstore/product/{{$details['product_name']}}" style="color:black">{{$details['product_name']}}</a></td>
                                        <td class="text-center">{{$details['quantity']}}</td>
                                        <td class="text-center">{{$details['size']}}</td>
                                        <td class="text-center">{{$details['color']}}</td>
                                        @if ($details['sale_price'] > 0 && $details['sale_price'] < $details['price'])
                                        <td class="text-center">{{number_format($details['sale_price'])}}đ</td>

                                        @else
                                        <td class="text-center">{{number_format($details['price'])}}đ</td>
                                        @endif
                                        <td class="text-center">{{number_format($total)}}đ</td>
                                    </tr>
                                    @endforeach
                                </table>
                                <ul class="checkout__total__all">
                                    <li>Tổng tiền <span>{{number_format($total_in_cart)}}đ</span></li>
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Phương thức thanh toán</li>
                                    <div class="checkout__input__checkbox">
                                        <label for="payment">
                                            Thanh toán khi nhận hàng
                                            <input name="payment_method" type="radio" id="payment" value="Thanh toán khi nhận hàng">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="paypal">
                                            Chuyển khoản
                                            <input name="payment_method" type="radio" id="paypal" value="Chuyển khoản">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </ul>
                                <input type="hidden" name="total_price" value="{{$total_in_cart}}">
                                <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @endif
@endsection
