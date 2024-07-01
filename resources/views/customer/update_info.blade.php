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
                        <h6 style="padding-top:5px">Họ và tên:</h6>
                        <h6 style="padding-top:10px">Email:</h6>
                        <h6 style="padding-top:12px">Số điện thoại:</h6>
                        <h6 style="padding-top:9px">Địa chỉ:</h6>
                    </div>
                    <div class="grid__column-4">
                        <input type="text" placeholder="Họ và tên" style="width:300px">
                        <input type="text" placeholder="Email" style="width:300px">
                        <input type="text" placeholder="SĐT" style="width:300px">
                        <input type="text" placeholder="Địa chỉ" style="width:300px">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div style="text-align:center">
            <form action="" method="GET">
                <button type="submit" class="btn btn-info" style="width:100px; color:white">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection