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
        <h4>Thông tin cá nhân</h4>
        <br>
    </div>
    <div class="card-body">
        @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
    </div>
    <div class="card-body">
        <div class="container">
            <table class="table align-items-center" style="padding-left: 15px; padding-right: 15px;">
                <tbody>
                    <tr style="width:100%">
                        @foreach($user_info as $user)
                            <td class="font-weight-bolder" style="float: left; border: solid white">
                                <div>
                                    <p> <b>Họ và tên: </b> {{$user->fullname}}</p>
                                    <p> <b>Địa chỉ Email: </b>{{$user->email}}</p>
                                    <p> <b>Số điện thoại: </b>{{$user->phone_number}}</p>
                                </div>
                            </td>
                            <td class="font-weight-bolder" style="float:right; border: solid white">
                                <div>
                                    <p> <b>Địa chỉ: </b>{{$user->address}}</p>
                                    <div class="input-container">
                                        <p><b>Mật khẩu: </b>
                                            <input type="password" value='{{ $user->password }}' id="password1"
                                                placeholder="" style="width:300px">
                                            <i class="fas fa-eye" onclick="togglePasswordVisibility('password1', this)"></i>
                                    </div>
                                    </p>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <br>
            <div style="text-align:center" class="grid">
                <form action="/ktcstore/personal_info/edit_info" method="GET">
                    <button type="submit" class="btn btn-info" style="width:100px; color:white">Cập nhật</button>
                </form>
                <form action="/ktcstore/personal_info/change_password" method="GET" style="padding-left: 10px">
                    <button type="submit" class="btn btn-secondary" style="width:150px; color:white">Đổi mật khẩu</button>
                </form>
            </div>
            <br>
        </div>
    </div>
</div>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    function togglePasswordVisibility(inputId, icon) {
        var input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
@endsection
