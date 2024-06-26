@extends('customer.layout')
@section('content')
 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4 style="color: white">Lịch sử đơn hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html" style="color: white">Trang chủ</a>
                            <a href="./shop.html" style="color: white">Cửa hàng</a>
                            <span>Lịch sử đơn hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
     <div class="app__container">
        <div class="grid">
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
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                <div class="shop__product__option">
                    <h4 style="padding-top: 8px;"><b>Danh sách đơn hàng</b></h4>
                    <br>
                    <table style="width: 100%; text-align: center" class="table table-border">
                        <tr>
                            <th>Đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái</th>
                            <th>Tổng</th>
                            <th></th>
                        </tr>
                        @foreach($orders as $order)
                        @php
                            $details = App\Models\Order_Detail::where('order_id', '=', $order->order_id)->get();
                            $total = 0;
                        @endphp
                        @foreach($details as $detail)
                        @php($total += $detail->price * $detail->quantity)
                        @endforeach
                        <tr>
                            <td>{{$order->order_id}}</td>
                            <td>{{$order->created_at->format('d/m/Y')}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{number_format($total)}}đ</td>
                            <td>
                                <form action="/ktcstore/order_detail/order_id={{$order->order_id}}" method="GET">
                                    <button type="submit" class="btn btn-info" style="width:90px; color:white"><b>Chi tiết</b></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            </div>
        </div>
        <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="confirmLogoutModalLabel">Xác nhận đăng xuất</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Bạn có chắc chắn muốn đăng xuất không?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <a href="/admin/logout" class="btn btn-primary">Đăng xuất</a>
                  </div>
                </div>
              </div>
            </div>
@endsection
