

<?php $this->layout('Client/Components/Layout');?>


<?php $this->start('main_content') ?>
<!-- Insert nội dung vào đây -->
<?php
$this->insert('Client/Home/CategoryShop');

$this->insert('Client/Home/ProductNew');
$this->insert('Client/Home/HotDeal');
$this->insert('Client/Home/TopSellingHigh');
$this->insert('Client/Home/TopSellingLow');
?>

<?php $this->stop() ?>
