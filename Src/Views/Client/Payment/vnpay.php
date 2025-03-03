<?php $this->layout('Client/Components/Layout'); ?>

<?php $this->start('main_content'); ?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class="title">Thanh toán qua VNPay</h3>
                <p>Vui lòng quét mã QR để thanh toán đơn hàng.</p>
                
                <div id="qrcode"></div>
                
                <p><strong>Số tiền: </strong> <?= number_format($_GET['total_price'] ?? 0, 2) ?> VND</p>
                <a href="<?= htmlspecialchars($_GET['vnp_Url'] ?? '#') ?>" class="btn btn-primary">Mở VNPay</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script>
    const qr = new QRious({
        element: document.getElementById('qrcode'),
        value: "<?= htmlspecialchars($_GET['vnp_Url'] ?? '') ?>",
        size: 250
    });
</script>

<?php $this->stop(); ?>
