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
        <div class="container">
            <table class="table align-items-center"
                style="padding-left: 15px; padding-right: 15px;">
                <tbody>
                    <tr style="width:100%">
                        <td class="font-weight-bolder"
                            style="float: left; border: solid white">
                            <div>
                                <p> <b>Họ và tên: </b> Nguyen Xuan Cong</p>
                                <p> <b>Địa chỉ Email: </b>xuancong2003@gmail.com</p>
                                <p> <b>Số điện thoại: </b>0123456789</p>
                            </div>
                        </td>
                        <td class="font-weight-bolder" style="float:right; border: solid white">
                            <div>
                                <p> <b>Địa chỉ: </b>Hà Nội</p>
                                <p><b>Mật khẩu: </b><input type="text" placeholder="**********" style="width:200px" readonly>
                                    <a href="/ktcstore/change_password">Thay đổi</a></p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
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