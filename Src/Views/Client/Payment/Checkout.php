<?php $this->layout('Client/Components/Layout'); ?>

<?php $this->start('main_content') ?>
<!-- Insert nội dung vào đây -->

<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Thanh toán</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active">Thanh toán</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-7">
                <!-- Chi tiết thanh toán -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Địa chỉ thanh toán</h3>
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="first-name" placeholder="Họ">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="last-name" placeholder="Tên">
                    </div>
                    <div class="form-group">
                        <input class="input" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="address" placeholder="Địa chỉ">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="city" placeholder="Thành phố">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="country" placeholder="Quốc gia">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="zip-code" placeholder="Mã bưu chính">
                    </div>
                    <div class="form-group">
                        <input class="input" type="tel" name="tel" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <div class="input-checkbox">
                            <input type="checkbox" id="create-account">
                            <label for="create-account">
                                <span></span>
                                Tạo tài khoản?
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                                <input class="input" type="password" name="password" placeholder="Nhập mật khẩu của bạn">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Chi tiết thanh toán -->

                <!-- Chi tiết giao hàng -->
                <div class="shiping-details">
                    <div class="section-title">
                        <h3 class="title">Địa chỉ giao hàng</h3>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="shiping-address">
                        <label for="shiping-address">
                            <span></span>
                            Gửi đến địa chỉ khác?
                        </label>
                        <div class="caption">
                            <div class="form-group">
                                <input class="input" type="text" name="first-name" placeholder="Họ">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="last-name" placeholder="Tên">
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="address" placeholder="Địa chỉ">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="city" placeholder="Thành phố">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="country" placeholder="Quốc gia">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="zip-code" placeholder="Mã bưu chính">
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" name="tel" placeholder="Số điện thoại">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Chi tiết giao hàng -->

                <!-- Ghi chú đơn hàng -->
                <div class="order-notes">
                    <textarea class="input" placeholder="Ghi chú cho đơn hàng"></textarea>
                </div>
                <!-- /Ghi chú đơn hàng -->
            </div>

            <!-- Chi tiết đơn hàng -->
            <div class="col-md-5 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Đơn hàng của bạn</h3>
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <div><strong>SẢN PHẨM</strong></div>
                        <div><strong>TỔNG CỘNG</strong></div>
                    </div>
                    <div class="order-products">
                        <div class="order-col">
                            <div>1x Tên sản phẩm</div>
                            <div>$980.00</div>
                        </div>
                        <div class="order-col">
                            <div>2x Tên sản phẩm</div>
                            <div>$980.00</div>
                        </div>
                    </div>
                    <div class="order-col">
                        <div>Vận chuyển</div>
                        <div><strong>MIỄN PHÍ</strong></div>
                    </div>
                    <div class="order-col">
                        <div><strong>TỔNG CỘNG</strong></div>
                        <div><strong class="order-total">$2940.00</strong></div>
                    </div>
                </div>
                <div class="payment-method">
                    <div class="input-radio">
                        <input type="radio" name="payment" id="payment-1">
                        <label for="payment-1">
                            <span></span>
                            Chuyển khoản ngân hàng trực tiếp
                        </label>
                        <div class="caption">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="input-radio">
                        <input type="radio" name="payment" id="payment-2">
                        <label for="payment-2">
                            <span></span>
                            Thanh toán qua séc
                        </label>
                        <div class="caption">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="input-radio">
                        <input type="radio" name="payment" id="payment-3">
                        <label for="payment-3">
                            <span></span>
                            Hệ thống Paypal
                        </label>
                        <div class="caption">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="input-checkbox">
                    <input type="checkbox" id="terms">
                    <label for="terms">
                        <span></span>
                        Tôi đã đọc và chấp nhận <a href="#">các điều khoản & điều kiện</a>
                    </label>
                </div>
                <a href="#" class="primary-btn order-submit">Đặt hàng</a>
            </div>
            <!-- /Chi tiết đơn hàng -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

<?php $this->stop() ?>
