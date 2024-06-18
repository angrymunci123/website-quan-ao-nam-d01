@extends('customer.layout')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4 style="color: white">Chi tiết đơn hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html" style="color: white">Trang chủ</a>
                            <span>Chi tiết đơn hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
     <br>
<div class="container">
<div class="checkout__order">
                                <h4 class="order__title">Đơn hàng</h4>
                                <div >
                                <table class="table align-items-center mb-0" style="background-color: #F3F2EE; padding-left: 15px; padding-right: 15px; border-style: none">
                                    <tbody>
                                    <tr style="width:100%">
                                    <td class="font-weight-bolder opacity-7" style="background-color: #F3F2EE; float: left; width: 50%">
                                        <div>
                                            <p><b>Họ tên người nhận: </b></p>
                                            <p><b>SDT:</b></p>
                                            <p><b>Địa chỉ:</b></p>
                                            <p><b>Ngày đặt:</b></p>
                                        </div>
                                    </td>
                                    <td class="font-weight-bolder opacity-7" style=" background-color: #F3F2EE; width: 50%">
                                        <div style="float:right">
                                            <p><b>ID đơn hàng:</b></p>
                                            <p><b>Tình trạng đơn hàng:</b></p>
                                            <p><b>Phương thức thanh toán:</b></p>
                                        </div>
                                    </td>                      
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                                <table class="table">
                                    <tr>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Đơn giá</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                
                                    <tr>
                                        <td><a href="/ktcstore/product/" style="color:black"></a></td>
                                        <td></td>
                                        <td>đ</td>
                                        <td>đ</td>
                                    </tr>

                                </table>
                                <ul class="checkout__total__all">
                                    <li>Tổng tiền <span>đ</span></li>
                                </ul>
    
                                <button type="submit" class="site-btn">Quay lại</button>
                            </div>
                            </div>
                            <br>
@endsection