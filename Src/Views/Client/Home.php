

<?php $this->layout('Client/Components/Layout',['categories' => $categories]);?>


<?php $this->start('main_content') ?>
<!-- Insert nội dung vào đây -->
<?php

$this->insert('Client/Home/CategoryShop');

$this->insert('Client/Home/ProductNew',['ramProduct' => $ramProduct]);
$this->insert('Client/Home/HotDeal');
$this->insert('Client/Home/TopSellingHigh',['ramProduct' => $ramProduct]);
$this->insert('Client/Home/TopSellingLow',['ramProduct' => $ramProduct]);
?>

<?php $this->stop() ?>
