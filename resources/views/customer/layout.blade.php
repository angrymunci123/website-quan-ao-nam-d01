<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KTC</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!--bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('temp_assets/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('temp_assets/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('temp_assets/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('temp_assets/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('temp_assets/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('temp_assets/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('temp_assets/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/grid.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('temp_assets/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('temp_assets/css/product-card.css')}}" type="text/css">
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Header Section Begin -->
    @if(!session('user_id'))
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <a href="/login">Đăng nhập</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3" style="height:90px">
                    <div class="header__logo">
                        <a href="/ktcstore"><img src="{{ asset('/temp_assets/KTC_Store.png')}}" style="width:90px; margin-top:-30px"></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="/ktcstore">Trang chủ</a></li>
                            <li><a href="/ktcstore/shop">Cửa hàng</a></li>
                            <li><a href="/ktcstore/blog">Tin tức</a></li>
                            <li><a href="/ktcstore/contact">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch">
                            <div class="price">Tìm kiếm</div><img class="ml-1" src="{{ asset('temp_assets/img/icon/search.png')}}" alt="">
                        </a>
                        <a class="ml-2" href="/ktcstore/shopping-cart">
                            <div class="price">Giỏ hàng</div> <img src="{{ asset('temp_assets/img/icon/cart.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    @endif

    @if(session('user_id'))
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                @if (session('role') == 'Chủ Cửa Hàng' || session('role') == 'Nhân Viên')
                                <div class="nav-item dropdown">
                                    <a href="/admin" style="color: white" style="margin:left">Quay về trang Admin</a>
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color: white">
                                        <span class="d-none d-lg-inline-flex">{{session('fullname')}}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                        <a class="dropdown-item" onclick="return confirm('Xin chào {{session('fullname')}}, hãy quay về trang Admin để xem thông tin cá nhân')">Thông
                                            tin cá nhân</a>
                                        <a class="dropdown-item" onclick="return confirm('Xin chào {{session('fullname')}}, (không phải là tài khoản khách hàng? Vui lòng đăng xuất và đăng nhập vào tài khoản khách hàng của bạn)')">Lịch
                                            sử đơn hàng</a>
                                        <form id="logout-form" action="/ktcstore/logout" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); if(confirm('Bạn có muốn đăng xuát không?')) { document.getElementById('logout-form').submit(); }">
                                            Đăng xuất
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @if (session('role') == 'Khách Hàng')
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color: white">
                                        <span class="d-none d-lg-inline-flex">{{session('fullname')}}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                                        <a href="/ktcstore/personal_info" class="dropdown-item">Thông tin cá nhân</a>
                                        <a href="/ktcstore/order_history" class="dropdown-item">Lịch sử đơn hàng</a>
                                        <form id="logout-form" action="/ktcstore/logout" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirmLogoutModal">
                                            Đăng xuất
                                        </a>
                                    </div>
                                </div>
                                <!-- Confirm Logout Modal -->
                                <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
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
                                                <a href="/login" class="btn btn-primary" style="height: 37px">Đăng xuất</a>
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
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3" style="height:90px">
                    <div class="header__logo">
                        <a href="/ktcstore"><img src="{{ asset('/temp_assets/KTC_Store.png')}}" style="width:90px; margin-top:-30px"></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="/ktcstore">Trang chủ</a></li>
                            <li><a href="/ktcstore/shop">Cửa hàng</a></li>
                            <li><a href="/ktcstore/blog">Tin tức</a></li>
                            <li><a href="/ktcstore/contact">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch">
                            <div class="price">Tìm kiếm</div><img class="ml-1" src="{{ asset('temp_assets/img/icon/search.png')}}" alt="">
                        </a>
                        <a class="ml-2" href="/ktcstore/shopping-cart">
                            <div class="price">Giỏ hàng</div> <img src="{{ asset('temp_assets/img/icon/cart.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    @endif
    <!-- Header Section End -->
    @yield('content')
    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            {{-- logo --}}
                            <a href="#"><img src="{{ asset('temp_assets/KTC_Store.png')}}" alt="" style="width: 150px"></a>
                        </div>
                        {{-- slogan --}}
                        <p>Nhà tài trợ</p>
                        <a href="#"><img src="{{ asset('temp_assets/vnpay.jpg')}}" alt="" style="width: 100px"></a>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Mua sắm</h6>
                        <ul>
                            <li><a href="#">Cửa hàng</a></li>
                            <li><a href="#">Best Sellers</a></li>
                            <li><a href="#">Sales</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Thắc mắc</h6>
                        <ul>
                            <li><a href="#">Liên hệ</a></li>
                            <li><a href="#">Phương thức thanh toán</a></li>
                            <li><a href="#">Phương thức giao hàng</a></li>
                            <li><a href="#">Trả hàng và đổi mới</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <p>KTC Store</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <!-- <form class="search-model-form" method="get" action="/ktcstore/search_product?keyword={">
                <input type="search" id="search-input" name="keyword" placeholder="Tìm kiếm sản phẩm">
            </form> -->
            <form class="search-model-form" action="/ktcstore/search_product" method="GET">
                <input type="search" name="keywords" id="search-input" placeholder="Tìm kiếm sản phẩm" />
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ asset('temp_assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('temp_assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('temp_assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset('temp_assets/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{ asset('temp_assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('temp_assets/js/jquery.countdown.min.js')}}"></script>
    <script src="{{ asset('temp_assets/js/jquery.slicknav.js')}}"></script>
    <script src="{{ asset('temp_assets/js/mixitup.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('temp_assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('temp_assets/js/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>