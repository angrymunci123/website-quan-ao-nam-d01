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
<div class="container">
    <div class="grid">
        <div class="grid__row">
            <div class="grid__column-4-2">
                <h6>Họ và tên:</h6>
                <h6>Email:</h6>
                <h6>Số điện thoại:</h6>
                <h6>Địa chỉ:</h6>
                <h6>Mật khẩu:</h6>
                <h6>Chức vụ:</h6>
            </div>
            <div class="grid__column-4">
                <h6>Nguyen Xuan Cong</h6>
                <h6>xuancong2003@gmail.com</h6>
                <h6>0912345678</h6>
                <h6>Số 1 Hà Nội</h6>
                <div>
                    <input type="text" placeholder="**********" style="width:300px">
                    <a href="/admin/user_info/change_password">Thay đổi</a>
                </div>
                <h6 style="padding-top: 3px;">Admin</h6>
            </div>
        </div>
    </div>
</div>
@endsection