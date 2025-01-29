<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài liệu</title>
    <?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Styles/main.css">
</head>

<body>
    <header class="w-100 text-center">
        <!DOCTYPE html>
        <html lang="vi">

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Electro - Mẫu Ecommerce HTML</title>
            <!-- Google font -->
            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
            <!-- Bootstrap -->
            <link type="text/css" rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/css/bootstrap.min.css" />
            <!-- Slick -->
            <link type="text/css" rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/css/slick.css" />
            <link type="text/css" rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/css/slick-theme.css" />
            <!-- nouislider -->
            <link type="text/css" rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/css/nouislider.min.css" />
            <!-- Font Awesome Icon -->
            <link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/css/font-awesome.min.css">
            <!-- Stylesheet tùy chỉnh -->
            <link type="text/css" rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/css/style.css" />
            <link type="text/css" rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/css/About.css" />

            <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

            <link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/css/style.css">

        </head>

        <body>
            <!-- HEADER -->
            <header>
                <!-- TOP HEADER -->

                <!-- /TOP HEADER -->

                <!-- MAIN HEADER -->
                <div id="header">
                    <!-- container -->
                    <div class="container">
                        <!-- row -->
                        <div class="row">
                            <!-- LOGO -->
                            <div class="col-md-3">
                                <div class="header-logo">
                                    <a href="/" class="logo">
                                        <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/MaxStore (3) (1).png" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- /LOGO -->

                            <!-- SEARCH BAR -->
                            <div class="col-md-6">
                                <div class="header-search">
                                    <form>
                                        <select class="input-select">
                                            <option value="0">Các danh mục</option>
                                            <option value="1">Danh mục 01</option>
                                            <option value="1">Danh mục 02</option>
                                        </select>
                                        <input class="input" placeholder="Tìm kiếm ở đây">
                                        <button class="search-btn">Tìm kiếm</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /SEARCH BAR -->

                            <!-- ACCOUNT -->
                            <div class="col-md-3 clearfix">
                                <div class="header-ctn">
                                    <!-- Wishlist -->
                                    <div>
                                        <a href="#">
                                        <i class="fa fa-wrench"></i>

                                            <span>Xây dựng PC</span>
                                            <div class="qty">2</div>
                                        </a>
                                    </div>
                                    <!-- /Wishlist -->

                                    <!-- Cart -->
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>Giỏ hàng</span>
                                            <div class="qty">3</div>
                                        </a>
                                        <div class="cart-dropdown">
                                            <div class="cart-list">
                                                <div class="product-widget">
                                                    <div class="product-img">
                                                        <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product01.png" alt="">
                                                    </div>
                                                    <div class="product-body">
                                                        <h3 class="product-name"><a href="#">Tên sản phẩm ở đây</a></h3>
                                                        <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                                    </div>
                                                    <button class="delete"><i class="fa fa-close"></i></button>
                                                </div>

                                                <div class="product-widget">
                                                    <div class="product-img">
                                                        <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product02.png" alt="">
                                                    </div>
                                                    <div class="product-body">
                                                        <h3 class="product-name"><a href="#">Tên sản phẩm ở đây</a></h3>
                                                        <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                                    </div>
                                                    <button class="delete"><i class="fa fa-close"></i></button>
                                                </div>
                                            </div>
                                            <div class="cart-summary">
                                                <small>3 sản phẩm đã chọn</small>
                                                <h5>TỔNG CỘNG: $2940.00</h5>
                                            </div>
                                            <div class="cart-btns">
                                                <a href="#">Xem giỏ hàng</a>
                                                <a href="/checkout">Thanh toán <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Cart -->

                                    <!-- Menu Toogle -->
                                    <div class="menu-toggle">
                                        <a href="#">
                                            <i class="fa fa-bars"></i>
                                            <span>Menu</span>
                                        </a>
                                    </div>
                                    <!-- /Menu Toogle -->
                                </div>
                            </div>
                            <!-- /ACCOUNT -->
                        </div>
                        <!-- row -->
                    </div>
                    <!-- container -->
                </div>
                <!-- /MAIN HEADER -->
            </header>
            <!-- /HEADER -->
    </header>
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="/">Trang chủ</a></li>
                    <li><a href="/productList">Sản phẩm</a></li>
                    <li><a href="/contact">Liên hệ</a></li>
                    <li><a href="/about">Giới thiệu</a></li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <div>
        <?= $this->section('main_content') ?>
    </div>
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Về chúng tôi</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Danh mục</h3>
                            <ul class="footer-links">
                                <li><a href="#">Khuyến mãi nóng</a></li>
                                <li><a href="#">Máy tính xách tay</a></li>
                                <li><a href="#">Điện thoại thông minh</a></li>
                                <li><a href="#">Máy ảnh</a></li>
                                <li><a href="#">Phụ kiện</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Thông tin</h3>
                            <ul class="footer-links">
                                <li><a href="#">Về chúng tôi</a></li>
                                <li><a href="#">Liên hệ chúng tôi</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <li><a href="#">Đặt hàng và trả lại</a></li>
                                <li><a href="#">Điều khoản và Điều kiện</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Dịch vụ</h3>
                            <ul class="footer-links">
                                <li><a href="#">Tài khoản của tôi</a></li>
                                <li><a href="#">Xem giỏ hàng</a></li>
                                <li><a href="#">Danh sách yêu thích</a></li>
                                <li><a href="#">Theo dõi đơn hàng</a></li>
                                <li><a href="#">Giúp đỡ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> by <a href="https://colorlib.com" target="_blank">HaoDuong</a>
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/jquery.min.js"></script>
    <script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/bootstrap.min.js"></script>
    <script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/slick.min.js"></script>
    <script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/nouislider.min.js"></script>
    <script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/jquery.zoom.min.js"></script>
    <script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/main.js"></script>

    <?= $this->section('scripts') ?>
</body>

</html>
