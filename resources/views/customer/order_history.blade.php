@extends('customer.layout')
@section('content')
 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4 style="color: white">Lịch Sử Đơn Hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html" style="color: white">Trang chủ</a>
                            <a href="./shop.html" style="color: white">Cửa hàng</a>
                            <span>Lịch Sử Đơn Hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
     <div class="app__container">
        <div class="grid" > 
        <div class="grid__row">
        <div class="grid__colunm-2">
                <div class="shop__sidebar">
                        <div class="shop__sidebar__accordion" style="padding-top: 20px">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Tình Trạng Đơn Hàng</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <li><a href="#">Chờ xác nhận</a></li>
                                                    <li><a href="#">Đã xác nhận</a></li>
                                                    <li><a href="#">Đang vận chuyển</a></li>
                                                    <li><a href="#">Đã Giao</a></li>
                                                    <li><a href="#">Đã Hủy</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="grid__column-10">
                <div class="shop__product__option">
                    
                </div>
            </div>
            </div>
        </div>
@endsection
