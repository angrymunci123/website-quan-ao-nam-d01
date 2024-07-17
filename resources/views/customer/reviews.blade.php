@extends('customer.layout')
@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4 style="color: white">Giỏ hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="/ktcstore" style="color: white">Trang chủ</a>
                        <a href="/ktcstore/shop" style="color: white">Cửa hàng</a>
                        <span style="color: white">Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<div class="container" style="background-color: #F3F2EE">
    <table class="table" style="background-color: #F3F2EE; padding-left: 15px; padding-right: 15px; border-style: none">
        <tr>
            <div style="width:1500px; margin:auto">
            <br>
            <h4>Đánh giá sản phẩm</h4>
                <div class="row">
                    <div class="col-lg-8">
                    <hr>
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            @if(Session::has('fail'))
                                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                            @endif
                            @foreach($product_info as $product)
                            <table>
                                <tr>
                                    <th>
                                        <div class="product__cart__item__pic">
                                            <img src="/image/{{$product['image']}}" alt="blank" style="width:85px">
                                        </div>
                                    </th>
                                    <th>&nbsp;</th>
                                    <th>
                                    <div class="product__cart__item__text">
                                        <h5><a href="/ktcstore/product/{{$product['product_name']}}" style="color:black">{{$product['product_name']}}</a></h5>
                                        @if ($product['sale_price'] > 0 && $product['sale_price'] < $product['price'])
                                        <h6>{{number_format($product['sale_price'])}}đ</h6>
                                        @else
                                        <h6>{{number_format($product['price'])}}đ</h6>
                                        @endif
                                    </div>
                                    </th>
                                </tr> 
                            </table>
                            <hr>
                            @endforeach
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
                                <button type="submit" class="btn btn-success" style="width: 110px; color:white">Quay lại</button>
                            </form>
                    </div>
                </div>
            </div>
        </tr>
    </table>
    </div>
<br>
@endsection
