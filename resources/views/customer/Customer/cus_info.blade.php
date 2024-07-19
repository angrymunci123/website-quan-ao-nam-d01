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
            <table class="table align-items-center"
                style="padding-left: 15px; padding-right: 15px;">
                <tbody>
                    <tr style="width:100%">
                        @foreach($user_info as $user)
                        <td class="font-weight-bolder"
                            style="border: solid white">
                            <div>
                                <p> <b>Họ và tên: </b> {{$user->fullname}}</p>
                                <p> <b>Địa chỉ Email: </b>{{$user->email}}</p>
                            </div>
                        </td>
                        <td class="font-weight-bolder" style="border: solid white">
                            <div>
                                <p> <b>Số điện thoại: </b>{{$user->phone_number}}</p>
                                <p> <b>Địa chỉ: </b>{{$user->address}}</p>
                            </div>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <br>
            <div class="row text-center">
                <div class="col">
                    <form action="/ktcstore/personal_info/edit_info" method="GET">
                        <button type="submit" class="btn btn-info" style="width:100%; color:white">Cập nhật</button>
                    </form>
                </div>
                <div class="col">
                    <form action="/ktcstore/personal_info/change_password" method="GET">
                        <button type="submit" class="btn btn-info" style="width:100%; color:white">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection
