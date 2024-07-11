@extends('admin.admin_layout')
@section('content')
<!-- End Navbar -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <table style="width: 100%">
                        <th style="font-size: 26px;" class="text-center">Chi tiết đơn hàng</th>
                    </table>
                </div>
                <div class="card-body">
                    @if(Session::has('notification'))
                        <div class="alert alert-success" style="color:white">
                            {{Session::get('notification')}}
                        </div>
                    @endif
                </div>
                @php
                    $total_price_order = 0;
                @endphp
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0"
                            style="padding-left: 15px; padding-right: 15px; border-style: none">
                            <tbody>
                                <tr style="width:100%">
                                    @foreach ($order_details as $order_detail)  @endforeach
                                    <td class="font-weight-bolder opacity-7" style="float: left; width: 50%">
                                        <div>
                                            <p><b>Họ tên người nhận: </b>{{$order_detail->consignee}}</p>
                                            <p><b>SDT:</b> {{$order_detail->phone_number}}</p>
                                            <p><b>Địa chỉ:</b> {{$order_detail->address}}</p>
                                            <p><b>Ngày đặt:</b> {{$order_detail->created_at->format('d/m/Y') }}</p>
                                        </div>
                                    </td>
                                    <td class="font-weight-bolder opacity-7" style="width: 50%">
                                        <div style="float:right">
                                            <p><b>ID đơn hàng:</b> {{$order_detail->order_id}}</p>
                                            <p><b>Tình trạng đơn hàng:</b> {{$order_detail->status}}</p>
                                            <p><b>Phương thức thanh toán:</b> {{$order_detail->payment_method}}</p>
                                            @if($order_detail->updated_at)
                                                <p><b>Ngày xác nhận đơn hàng:</b>
                                                    {{$order_detail->updated_at->format('d/m/Y') }}</p>
                                            @else
                                                <p><b>Ngày xác nhận đơn hàng:</b></p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table align-items-center table-bordered"
                            style="padding: 20px; width:95%; margin:auto; background-color:#F3F2EE">
                            <thead style="background-color:white">
                                <tr style="width:100%; text-align: center">
                                    <th><b>Sản phẩm</b></th>
                                    <th><b>Size</b></th>
                                    <th><b>Số lượng</b></th>
                                    <th><b>Kích cỡ</b></th>
                                    <th><b>Đơn giá</b></th>
                                    <th><b>Thành tiền</b></th>
                                </tr>
                            </thead>

                            <tbody style="background-color:white">
                                @foreach($product_order as $product)
                                                                @php
                                                                    $total = 0;
                                                                    $total += $product->price * $product->quantity;
                                                                    $total_price_order += $total;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{$product->product_name}}</td>
                                                                    <td class="text-center">{{$product->quantity}}</td>
                                                                    <td class="text-center">{{$product->size}}</td>
                                                                    <td class="text-center">{{number_format($product->price)}}đ</td>
                                                                    <td class="text-center">{{number_format($total)}}đ</td>
                                                                    <td class="text-center" style="width:50px">{{$product->size}}</td>
                                                                    <td class="text-center" style="width:50px">{{$product->quantity}}</td>
                                                                    <td class="text-center" style="width:50px">{{number_format($product->price)}}đ</td>
                                                                    <td class="text-center" style="width:50px">{{number_format($total)}}đ</td>
                                                                </tr>
                                @endforeach
                                <tr>
                                    <td class="text-center"><b>Tổng tiền</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><b>{{number_format($total_price_order)}}đ</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <form action="/admin/order" method="GET" style="padding-right: 20px; float: right">
                            <button type="submit" class="btn btn-secondary" style="width: 110px; color:white">Quay
                                lại<i></i></button>
                        </form>
                        @if ($order_detail->status == 'Đã xác nhận' || $order_detail->status == 'Đang giao hàng')
                            <form id="updateStatusForm" action="/admin/order/confirm/order_id={{$order_detail->order_id}}"
                                method="GET" style="padding-right:20px; float:right">
                                <button type="button" class="btn btn-warning" style="width: 200px; color:white"
                                    data-toggle="modal" data-target="#updateStatusModal">Cập nhật
                                    trạng thái<i></i></button>
                            </form>
                            <!-- Popup form cập nhật trạng thái đơn hàng -->
                            <div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog"
                                aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateStatusModalLabel">Cập nhật trạng thái đơn hàng
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn chắc chắn muốn cập nhật trạng thái đơn hàng này không? Điều này không thể
                                            hoàn tác lại.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                            <button type="button" class="btn btn-warning" id="confirmUpdate">Cập nhật
                                                trạng
                                                thái</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif

                        @if ($order_detail->status == 'Đang chờ xác nhận')
                            <form id="confirmOrderForm" action="/admin/order/confirm/order_id={{$order_detail->order_id}}"
                                method="GET" style="padding-right: 20px; float: right">
                                <button type="button" class="btn btn-success" style="width: 180px; color:white"
                                    data-toggle="modal" data-target="#confirmOrderModal">Xác
                                    nhận đơn hàng<i></i></button>
                            </form>
                            <!-- Popup form xác nhận đơn hàng -->
                            <div class="modal fade" id="confirmOrderModal" tabindex="-1" role="dialog"
                                aria-labelledby="confirmOrderModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmOrderModalLabel">Xác nhận đơn hàng</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn chắc chắn muốn xác nhận đơn hàng này không? Điều này không thể hoàn tác lại.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                            <button type="button" class="btn btn-success" id="confirmOrder">Xác nhận</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form id="cancelOrderForm" action="/admin/order/cancel/order_id={{$order_detail->order_id}}"
                                method="POST" style="padding-right: 20px; float: right">
                                @csrf
                                <button type="button" class="btn btn-danger" style="width: 150px; color:white"
                                    data-toggle="modal" data-target="#cancelOrderModal">Hủy
                                    đơn hàng<i></i></button>
                            </form>
                            <div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog"
                                aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cancelOrderModalLabel">Xác nhận hủy đơn hàng</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn chắc chắn muốn hủy đơn hàng này không? Điều này không thể hoàn tác lại.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                            <button type="button" class="btn btn-danger" id="confirmCancel">Hủy đơn
                                                hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<script>
    document.getElementById('confirmCancel').addEventListener('click', function () {
        document.getElementById('cancelOrderForm').submit();
    });
    document.getElementById('confirmOrder').addEventListener('click', function () {
        document.getElementById('confirmOrderForm').submit();
    });
    document.getElementById('confirmUpdate').addEventListener('click', function () {
        document.getElementById('updateStatusForm').submit();
    });
</script>
@endsection
