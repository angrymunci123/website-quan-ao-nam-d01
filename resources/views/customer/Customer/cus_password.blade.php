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
    <div class="card-body">
        @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
    </div>
    <div class="card-body px-0 pt-0 pb-2">
    <form action="/ktcstore/personal_info/change_password_process" method="POST">
        @csrf
        <div class="container">
            <div class="grid">
                <div class="grid__row">
                    <div class="grid__column-4-2">
                        <h6 style="padding-top:5px">Mật khẩu hiện tại:</h6>
                        <h6 style="padding-top:8px">Mật khẩu mới:</h6>
                        <h6 style="padding-top:5px">Xác nhận mật khẩu mới:</h6>
                    </div>
                    <div class="grid__column-4">
                        <div>
                            <input type="text" name="current_password" placeholder="" style="width:300px" required minlength="8" maxlength="20">
                        </div>
                        <div>
                            <input type="text" name="new_password" placeholder="" style="width:300px" required minlength="8" maxlength="20">
                        </div>
                        <div>
                            <input type="text" name="confirm_new_password" placeholder="" style="width:300px" required minlength="8" maxlength="20">
                        </div>
                    </div>
                </div>
            </div>
            <br>
                <button type="submit" class="btn btn-info" style="width:75px; color:white">Lưu</button>
            </form>
        </div>
    </div>
</div>
@endsection
