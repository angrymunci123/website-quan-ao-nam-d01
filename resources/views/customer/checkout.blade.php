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
    @if(session()->exists('shopping_cart'))
    @php
    $total_in_cart = 0;
    @endphp
    <section class="checkout spad">
        <div style="width:100%; max-width:1500px; margin:auto">
            <div class="checkout__form">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <h6 class="checkout__title">Thông tin thanh toán</h6>
                            <div class="row">
                                    <div class="checkout__input">
                                        <p>Họ và tên người nhận<span>*</span></p>
                                        <input type="text" value="{{ $customer->fullname }}" style="color:black">
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Địa chỉ" class="checkout__input__add" style="color:black" value="{{ $customer->address }}" style="color:black">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="number" value="{{ $customer->phone_number }}" style="color:black">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span> (Nếu có)</span></p>
                                <input type="text" name="order_notes"
                                placeholder="Ghi chú về đơn hàng" style="color:black">
                            </div>
                        </div>
                        {{-- đơn hàng --}}
                        <div class="col-lg-7 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Đơn hàng</h4>
                                <table class="table">
                                    <tr>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Đơn giá</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                    @foreach ($shopping_cart as $cart => $details)
                                    @php
                                        $total = $details['price'] * $details['quantity'];
                                        $total_in_cart += $total;
                                    @endphp
                                    <tr>
                                        <td><a href="/ktcstore/product/{{$details['product_name']}}" style="color:black">{{$details['product_name']}}</a></td>
                                        <td>{{$details['quantity']}}</td>
                                        <td>{{number_format($details['price'])}}đ</td>
                                        <td>{{number_format($total)}}đ</td>
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
                                            <input type="checkbox" id="payment">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="paypal">
                                            Chuyển khoản
                                            <input type="checkbox" id="paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </ul>

                                <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @endif
    <!-- Checkout Section End -->
@endsection
