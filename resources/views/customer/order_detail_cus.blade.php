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
    <div class="card-body">
        @if(Session::has('notification'))
            <div class="alert alert-success" style="color:white">
                {{Session::get('notification')}}
            </div>
        @endif
    </div>
    <div class="checkout__order">
        @php
            $total_price_order = 0;
        @endphp
        <h4 class="order__title">Đơn hàng</h4>
        <div>
            @foreach($order_details as $order_detail)  @endforeach
            <table class="table align-items-center mb-0"
                style="background-color: #F3F2EE; padding-left: 15px; padding-right: 15px; border-style: none">
                <tbody>
                    <tr style="width:100%">
                        <td class="font-weight-bolder opacity-7"
                            style="background-color: #F3F2EE; float: left; width: 50%">
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
                <th scope="col" >Sản phẩm</th>
                <th scope="col" class="text-center">Số lượng</th>
                <th scope="col" class="text-center">Đơn giá</th>
                <th scope="col" class="text-center">Thành tiền</th>
                @if ($order_detail->status == 'Đã giao hàng')
                <th></th>
                @endif  
            </tr>
            @foreach($product_order as $product)
                        @php
                            $total = 0;
                            $total += $product->price * $product->quantity;
                            $total_price_order += $total;
                        @endphp
                        <tr>
                            <td><a href="/ktcstore/product/{{$product->product_name}}"
                                    style="color:black">{{$product->product_name}}</a></td>
                            <td class="text-center">{{$product->quantity}}</td>
                            <td class="text-center">{{number_format($product->price)}}đ</td>
                            <td class="text-center">{{number_format($total)}}đ</td>
                            @if ($order_detail->status == 'Đã giao hàng')
                            <td class="text-center">
                                <form method="get" action="/ktcstore/reviews/{{$product->product_name}}" enctype='multipart/form-data'>
                                    <input type="number" hidden name="order_id" value="{{$product->order_id}}"/>
                                    <input type="number" hidden name="product_detail_id" value="{{$product->product_detail_id}}"/>
                                    <input hidden type="text" name="product_name" value="{{$product->product_name}}"/>
                                    <button type="submit" class="btn btn-success btn-sm" style="width: 150px; color:white">Đánh giá sản phẩm</button>
                                </form>
                            </td>
                            @endif
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
                @if ($order_detail->status == 'Đang chờ xác nhận')
                    <td>
                        <form id="cancelOrderForm" action="/ktcstore/order_history/cancel_order/order_id={{ $order_detail->order_id }}"
                            method="POST" style="padding-right: 20px; float: right">
                            @csrf
                            <button  type="button" class="btn btn-danger"
                                style="width: 150px; color:white" onclick="showCancelOrderModal()">Hủy Đơn Hàng</button>
                        </form>
                    </td>
                @endif
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
                                <button type="button" id="cancel-cancelOrder" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                                <form action="/ktcstore/order_history/cancel_order/order_id={{$order_detail->order_id}}" method="GET"
                                    style="padding-right: 20px; float: right">
                                    <button type="button" class="btn btn-danger" id="confirmCancelOrder">Hủy Đơn
                                        Hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
        </table>
        <td style="width:100%">
                @if ($order_detail->status == 'Đã giao hàng')
                    <div class="feedback">
                        Cám ơn bạn đã mua sản phẩm tại cửa hàng của chúng tôi. Vui lòng đánh giá trải nghiệm sản phẩm của bạn ở dưới
                        <hr>
                        <label for="m_3189847521540640526commentText">Đánh giá về chất lượng sản phẩm:</label>
                        <br>
                        <form>
                            <span class="star-rating">
                                <input type="radio" name="rating1" value="1"><i></i>
                                <input type="radio" name="rating1" value="2"><i></i>
                                <input type="radio" name="rating1" value="3"><i></i>
                                <input type="radio" name="rating1" value="4"><i></i>
                                <input type="radio" name="rating1" value="5"><i></i>
                            </span>
                            <hr>
                            <div class="clear"></div> 
                            <hr class="survey-hr"> 
                            <label for="m_3189847521540640526commentText">Nội dung đánh giá:</label><br/><br/>
                            <textarea cols="75" name="commentText" rows="5" style="width:100%"></textarea><br>
                            <br>
                            <div class="clear"></div> 
                            <button type="submit" class="btn btn-warning" style="width: 140px; color:white">Gửi đánh giá</button>
                        </form>
                    </div>
                    <br>
                    <form action="/ktcstore/order_history" method="GET">
                        <button type="submit" class="btn btn-success" style="width: 110px; color:white">Quay
                            lại</button>
                    </form>
                @endif
                </td>
    </div>
</div>
<br>
<script>

    function showCancelOrderModal() {
        $('#cancelOrderModal').modal('show');
    }

    document.getElementById('confirmCancelOrder').addEventListener('click', function () {
        document.getElementById('cancelOrderForm').submit();
    });


    document.getElementById('cancel-cancelOrder').addEventListener('click', function() {
        $('#cancelOrderModal').modal('hide'); 
    });

</script>
@endsection