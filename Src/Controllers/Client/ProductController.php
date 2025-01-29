<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;

class ProductController extends BaseController {

    public function show() {
        echo $this->view->render('Client/Product/ProductList', );
    }
    public function detail(){
        echo $this->view->render('Client/Product/ProductDetail');
    }
}