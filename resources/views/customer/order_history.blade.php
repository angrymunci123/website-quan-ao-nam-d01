@extends ('customer.layout')
@section('content')
<section class="breadcrumb-option">
    <div class="container" style="background-image: url('temp_assets/img/banner.png')">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4 style="color: white">Cửa hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="/ktcstore" style="color: white">Trang chủ</a>
                        <span style="color: white">Cửa hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__accordion" style="padding-top: 20px">
                        <div class="accordion" id="accordionExample">
                            <div class="shop__sidebar__search">
                                <form action="/ktcstore/order_history/search_order" method="POST"
                                    enctype='multipart/form-data'>
                                    @csrf
                                    <input type="number" name="order_id" placeholder="Nhập mã đơn hàng..." min="1">
                                    <button type="submit"><span class="icon_search"></span></button>
                                </form>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Tình Trạng Đơn Hàng</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <li><a href="/ktcstore/order_history/pending">Chờ xác nhận</a></li>
                                                <li><a href="/ktcstore/order_history/confirmed">Đã xác nhận</a></li>
                                                <li><a href="/ktcstore/order_history/delivering">Đang vận chuyển</a>
                                                </li>
                                                <li><a href="/ktcstore/order_history/delivered">Đã Giao</a></li>
                                                <li><a href="/ktcstore/order_history/canceled">Đã Hủy</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="shop__product__option">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    <br>
                    @if ($orders->isEmpty())
                        <div class="col-lg-12">
                            <p style="text-align: center; font-size: 18px; color: #333;">Không có đơn hàng nào để hiển
                                thị.</p>
                        </div>
                    @else
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
                                        <button type="submit" class="btn btn-info" style="width:90px; color:white"><b>Chi
                                                tiết</b></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    @endif
                </div>
                <div class="product__pagination">
                    @if ($orders->lastPage() > 1)
                        <a class="active" href="{{ $orders->previousPageUrl() }}">«</a>
                        @for ($i = 1; $i <= $orders->lastPage(); $i++)
                            <a class="{{ $i === $orders->currentPage() ? 'active' : '' }}"
                                href="{{ $orders->url($i) }}">{{ $i }}</a>
                        @endfor
                        <a class="active" href="{{ $orders->nextPageUrl() }}">»</a>
                    @endif
                </div>
                <br>
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
    </div>
</section>
@endsection