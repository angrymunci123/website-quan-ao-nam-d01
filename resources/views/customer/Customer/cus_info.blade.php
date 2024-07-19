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
                            style="float: left; border: solid white">
                            <div>
                                <p> <b>Họ và tên: </b> {{$user->fullname}}</p>
                                <p> <b>Địa chỉ Email: </b>{{$user->email}}</p>
                                <p> <b>Số điện thoại: </b>{{$user->phone_number}}</p>
                            </div>
                        </td>
                        <td class="font-weight-bolder" style="float:right; border: solid white">
                            <div>
                                <p> <b>Địa chỉ: </b>{{$user->address}}</p>
                                <p> <b>Mật khẩu: </b><input type="text" style="width:200px" value="{{$user->password}}" readonly>
                                    <a href="/ktcstore/change_password">Thay đổi</a></p>
                            </div>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <br>
            <div style="text-align:center">
                <form action="/ktcstore/personal_info/edit_info" method="GET">
                    <button type="submit" class="btn btn-info" style="width:100px; color:white">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection