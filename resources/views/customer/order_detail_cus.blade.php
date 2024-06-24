@extends('customer.layout')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4 style="color: white">Chi tiết đơn hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html" style="color: white">Trang chủ</a>
                            <span>Chi tiết đơn hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
     <br>
<div class="container">
<div class="checkout__order">
    @php
        $total_price_order = 0;
    @endphp
    <h4 class="order__title">Đơn hàng</h4>
        <div>
        @foreach($order_details as $order_detail)  @endforeach
            <table class="table align-items-center mb-0" style="background-color: #F3F2EE; padding-left: 15px; padding-right: 15px; border-style: none">
                 <tbody>
                    <tr style="width:100%">
                        <td class="font-weight-bolder opacity-7" style="background-color: #F3F2EE; float: left; width: 50%">
                            <div>
                                <p><b>Họ tên người nhận: {{$order_detail->consignee}}</b></p>
                                <p><b>SDT: {{$order_detail->phone_number}}</b></p>
                                <p><b>Địa chỉ: {{$order_detail->address}}</b></p>
                                <p><b>Ngày đặt: {{$order_detail->created_at->format('d/m/Y') }}</b></p>
                            </div>
                        </td>
                        <td class="font-weight-bolder opacity-7" style=" background-color: #F3F2EE; width: 50%">
                            <div style="float:right">
                                <p><b>ID đơn hàng: {{$order_detail->order_id}}</b></p>
                                <p><b>Tình trạng đơn hàng: {{$order_detail->status}}</b></p>
                                 <p><b>Phương thức thanh toán: {{$order_detail->payment_method}}</b></p>
                            </div>
                        </td>
                    </tr>
                </tbody>
             </table>
        </div>
        <table class="table">
            <tr>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Thành tiền</th>
            </tr>
            @foreach($product_order as $product)
                @php
                $total = 0;
                $total += $product->price * $product->quantity;
                $total_price_order += $total;
                @endphp
            <tr>
                <td><a href="/ktcstore/product/{{$product->product_name}}" style="color:black">{{$product->product_name}}</a></td>
                <td>{{$product->quantity}}</td>
                <td>{{number_format($product->price)}}đ</td>
                <td>{{number_format($total)}}đ</td>
                </tr>
            @endforeach
        </table>
        <ul class="checkout__total__all">
            <li>Tổng tiền <span>{{number_format($total_price_order)}}đ</span></li>
        </ul>
        <table>
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <form action="/ktcstore/order_history/cancel_order/order_id={{ $order_detail->order_id }}" method="POST" id="deleteForm-{{ $order_detail->order_id }}"
                     style="padding-right: 20px; float: right">
                     @csrf
                        <button type="submit" class="btn btn-danger" style="width: 150px; color:white" onclick="openPopup('{{ $order_detail->order_id }}')">Hủy Đơn Hàng</button>
                    </form>
                </td>
                <td>
                    <form action="/ktcstore/order_history" method="GET" style="padding-right: 20px; float: right">
                        <button type="submit" class="btn btn-success" style="width: 110px; color:white">Quay lại</button>
                    </form>
                </td>
                <div class="popup" id="confirmPopup-{{ $order_detail->order_id }}">
                    <div class="popup-content">
                        <p>Bạn có chắc chắn muốn hủy đơn hàng này không? {{ $order_detail->order_id }}</p>
                        <form action="/admin/brand/delete_brand/brand_id={{ $order_detail->order_id }}" method="POST">
                            @csrf
                            <button type="submit" id="confirmDeleteButton-{{ $order_detail->order_id }}" class="btn btn-danger">Xác nhận</button>
                        </form>
                        <button id="cancelDeleteButton-{{ $order_detail->order_id }}" class="btn btn-secondary">Hủy bỏ</button>
                    </div>
                </div>
            </tr>
        </table>
    </div>
</div>
<br>
<script>
    function openPopup(order_id) {
      let confirmPopup = document.getElementById("confirmPopup-" + order_id);
      confirmPopup.classList.add("open-popup");

      let deleteForm = document.getElementById("deleteForm-" + order_id);

      document.getElementById('confirmDeleteButton-' + order_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
        deleteForm.submit(); // Thực hiện submit form để xóa
      });

      document.getElementById('cancelDeleteButton-' + order_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
      });
    }
  </script>
@endsection
