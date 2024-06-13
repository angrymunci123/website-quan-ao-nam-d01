@extends('customer.layout')
@section('content')
<!-- Shop Details Section Begin -->
<section class="shop-details">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="/ktcstore">Home</a>
                            <a href="/ktcstore/shop">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($product_details as $product_detail)
        <div class="product__details__content">
            <div class="container">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                <table align="center" style="width: 100%">
                    <tr>
                        <td>
                            <div class="rowdy">
                                <div class="border">
                                <img src="/image/{{$product_detail->image}}" style="width: 500px; height: 600px; object-fit: cover">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="ml-5">
                        <h2><b>{{$product_detail->product_name}}</b></h2>
                        <br>
                        @if ($product_detail->sale_price > 0)
                            <del>{{number_format($product_detail->price)}}đ</del>
                            <h3>{{number_format($product_detail->sale_price)}}đ</h3>
                        @else
                            <h3>{{number_format($product_detail->price)}}đ</h3>
                        @endif
                            <br>
                            <div class="product__details__option">
                                @if(session()->exists('user_id'))
                                    <form action="/ktcstore/product/add_to_cart" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="product_detail_id" value="{{$product_detail->product_detail_id}}"/>
                                        <input type="hidden" name="product_id" value="{{$product_detail->product_id}}"/>
                                        <table>
                                            <tr>
                                                <th>
                                                    <label>Kích Cỡ</label>
                                                    <br>
                                                    <select name="size" class="form-control" style="width: 150px;">
                                                        @foreach($product_size as $display_size)
                                                            <option name="size" value="{{$display_size->size}}">{{$display_size->size}}</option>
                                                        @endforeach
                                                    </select>
                                                </th>
                                                <th>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </th>
                                                <th>
                                                    <label>Màu Sắc</label>
                                                    <br>
                                                    <select name="color" class="form-control" style="width: 150px;">
                                                        @foreach($product_colors as $color)
                                                            <option name="color" value="{{ $color->color }}">{{ $color->color }}</option>
                                                        @endforeach
                                                    </select>
                                                </th>
                                            </tr>
                                        </table>
                                        <br>
                                        <div class="quantity">
                                            <label>Số Lượng:</label>
                                            <div class="product__details__cart__option">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input  type="number" name="quantity" value="1" min="1" max="100">
                                                    </div>
                                                </div>
                                                <button type="submit" id="add_to_cart_message" class="primary-btn">Thêm Vào Giỏ Hàng</button>
                                            </div>
                                        </div>
                                        
                                    </form>
                                @endif
                                @if(!session('user_id'))
                                <form action="/login" method="get" enctype="multipart/form-data">
                                <table>
                                    <tr>
                                        <th>
                                            <label>Kích Cỡ</label>
                                            <br>
                                            <select name="size" class="form-control" style="width: 150px;">
                                            @foreach($product_size as $display_size)
                                                <option value="{{$display_size->size}}">{{$display_size->size}}</option>
                                            @endforeach
                                            </select>
                                        </th>
                                        <th>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </th>
                                        <th>
                                            <label>Màu Sắc</label>
                                            <br>
                                            @foreach($product_colors as $color)
                                            <label for="color-{{ $color->index }}">{{ $color->color }}
                                                <input type="radio" id="color-{{ $color->index }}" name="color" value="{{ $color->color }}">
                                            </label>
                                            @endforeach
                                        </th>
                                    </tr>
                                </table>
                                <br>
                                <div class="quantity">
                                    <label>Số Lượng:</label>
                                    <div class="product__details__cart__option">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>                           
                                        <button type="submit" class="primary-btn">Mua Ngay</button>
                                    </div>
                                </div>
                                </form>
                                @endif
                            </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="{{ asset ('temp_assets/img/shop-details/details-payment.png')}}" alt="">
                                <ul>
                                    <li><span>SKU:</span> 3812912</li>
                                    <li><span>Categories:</span> Clothes</li>
                                    <li><span>Tag:</span> Clothes, Skin, Body</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Mô Tả Sản Phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Đánh Giá</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Thông Tin Khác</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Thông Tin Sản Phẩm</h5>
                                            <p>{{$product_detail->description}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                        pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-1.jpg')}}">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Piqué Biker Jacket</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$67.24</h5>
                            <div class="product__color__select">
                                <label for="pc-1">
                                    <input type="radio" id="pc-1">
                                </label>
                                <label class="active black" for="pc-2">
                                    <input type="radio" id="pc-2">
                                </label>
                                <label class="grey" for="pc-3">
                                    <input type="radio" id="pc-3">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-2.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Piqué Biker Jacket</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$67.24</h5>
                            <div class="product__color__select">
                                <label for="pc-4">
                                    <input type="radio" id="pc-4">
                                </label>
                                <label class="active black" for="pc-5">
                                    <input type="radio" id="pc-5">
                                </label>
                                <label class="grey" for="pc-6">
                                    <input type="radio" id="pc-6">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item sale">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-3.jpg')}}">
                            <span class="label">Sale</span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Multi-pocket Chest Bag</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$43.48</h5>
                            <div class="product__color__select">
                                <label for="pc-7">
                                    <input type="radio" id="pc-7">
                                </label>
                                <label class="active black" for="pc-8">
                                    <input type="radio" id="pc-8">
                                </label>
                                <label class="grey" for="pc-9">
                                    <input type="radio" id="pc-9">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset ('temp_assets/img/product/product-4.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>Diagonal Textured Cap</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>$60.9</h5>
                            <div class="product__color__select">
                                <label for="pc-10">
                                    <input type="radio" id="pc-10">
                                </label>
                                <label class="active black" for="pc-11">
                                    <input type="radio" id="pc-11">
                                </label>
                                <label class="grey" for="pc-12">
                                    <input type="radio" id="pc-12">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related Section End -->
@endsection
<script>
    add_filter( 'add_to_cart_message', function( $message, $products, $show_qty ) 
    {
        $message = __( 'Product added, yay!', 'my-text-domain' );
        return $message;
    }, 10, 3 );
</script>
