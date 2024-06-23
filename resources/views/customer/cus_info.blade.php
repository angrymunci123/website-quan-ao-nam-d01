@extends('customer.layout')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4 style="color: white">Thông tin cá nhân</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html" style="color: white">Trang chủ</a>
                        <a href="./shop.html" style="color: white">Cửa hàng</a>
                        <span>Thông tin cá nhân</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<div class="card mb-4">
    <div class="card-header pb-0">
        <h4>Thông tin cá nhân:</h4>
        <p>Quản lý thông tin tài khoản</p>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="container">
            <div class="grid">
                <div class="grid__row">
                    <div class="grid__column-4-2">
                        <h6>Họ và tên:</h6>
                        <h6>Email:</h6>
                        <h6 style="padding-top:12px">Số điện thoại:</h6>
                        <h6 style="padding-top:12px">Địa chỉ:</h6>
                        <h6 style="padding-top:12px">Mật khẩu:</h6>
                    </div>
                    <div class="grid__column-4">
                        <h6>Nguyen Xuan Cong</h6>
                        <h6>xuancong2003@gmail.com</h6>
                        <div>
                            <input type="text" placeholder="SĐT" style="width:300px">
                        </div>
                        <div>
                            <input type="text" placeholder="Địa chỉ" style="width:300px">
                        </div>
                        <div>
                            <input type="text" placeholder="**********" style="width:300px">
                            <a href="/ktcstore/change_password">Thay đổi</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div style="text-align:center">
                <form action="" method="GET">
                    <button type="submit" class="btn btn-info" style="width:75px; color:white">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection