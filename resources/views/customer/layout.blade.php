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
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!--bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset ('temp_assets/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('temp_assets/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('temp_assets/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('temp_assets/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('temp_assets/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('temp_assets/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('temp_assets/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('temp_assets/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset ('temp_assets/css/product-card.css')}}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Đăng nhập</a>
                <a href="#">Đăng ký</a>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a>
            <a href="#"><img src="{{ asset ('temp_assets/img/icon/heart.png')}}" alt=""></a>
            <a href="#"><img src="{{ asset ('temp_assets/img/icon/cart.png')}}" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
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
                                <a href="/register">Đăng ký</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./"><img src="{{ asset ('temp_assets/img/logo.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="./">Trang chủ</a></li>
                            <li><a href="/mainpage/shop">Cửa hàng</a></li>
                            <li><a href="/mainpage/blog">Tin tức</a></li>
                            <li><a href="/mainpage/contact">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><div class="price">Tìm kiếm</div><img class="ml-1" src="{{ asset ('temp_assets/img/icon/search.png')}}" alt=""></a>
                        <a class="ml-2" href="/mainpage/shopping-cart"><div class="price">Giỏ hàng</div> <img src="{{ asset ('temp_assets/img/icon/cart.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
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
                            <a href="#"><img src="{{ asset ('temp_assets/img/footer-logo.png')}}" alt=""></a>
                        </div>
                        {{-- slogan --}}
                        <p>Khách hàng không bao giờ đúng</p>
                        <a href="#"><img src="{{ asset ('temp_assets/img/payment.png')}}" alt=""></a>
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
                       <p>Sản phẩm này không phải là thuốc, không có tác dụng thay thế thuốc chữa bệnh.</p>
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
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ asset ('temp_assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset ('temp_assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset ('temp_assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset ('temp_assets/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{ asset ('temp_assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset ('temp_assets/js/jquery.countdown.min.js')}}"></script>
    <script src="{{ asset ('temp_assets/js/jquery.slicknav.js')}}"></script>
    <script src="{{ asset ('temp_assets/js/mixitup.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset ('temp_assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset ('temp_assets/js/main.js')}}"></script>
</body>

</html>
