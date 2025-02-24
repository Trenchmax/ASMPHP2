<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;
use Src\Models\Client\ProductModel;
class HomeController extends BaseController {

    public function show() {
        $ProductModel = new ProductModel;
    
        $ramProduct = $ProductModel->getAllRamProduct();
        echo $this->view->render('Client/Home', ['ramProduct' => $ramProduct]);
    }
}