<?php

namespace Src\Controllers\Client;


use Src\Controllers\BaseController;
use Src\Models\Client\CategoryModel;
use Src\Models\Client\ProductModel;

class ProductController extends BaseController
{

    public function show()
    {
        $ProductModel   = new ProductModel();
        $CategoryModel = new CategoryModel;
        $categories = $CategoryModel->getAllCategory();
        $products = $ProductModel->getAllProduct();
        $ranProduct = $ProductModel->getAllRamProduct();
        $ramProduct = $ProductModel->getAllRamProduct4();
        echo $this->view->render('Client/Product/ProductList', ['products' => $products, 'ranProduct' => $ranProduct, 'ramProduct' => $ramProduct, 'categories' => $categories]);
    }
    public function detail($params)
    {
        $id = $params['id'];
        $ProductModel   = new ProductModel();
        $product = $ProductModel->getOneNormal($id);
        echo $this->view->render('Client/Product/ProductDetail', ['product' => $product]);
    }
    public function showByCategory($params)
    {
        $id = isset($params['id']) ? (int)$params['id'] : null;


        if (!$id) {
            var_dump($id);
            // header("Location: /productList");  
            exit;
        }

        $ProductModel = new ProductModel();
        $CategoryModel = new CategoryModel();

        $categories = $CategoryModel->getAllCategory();
        $products = $ProductModel->getAllProductByCategory($id);
       
        $ranProduct = $ProductModel->getAllRamProduct();
        $ramProduct = $ProductModel->getAllRamProduct4();

        echo $this->view->render('Client/Product/ProductCategory', [
            'products' => $products,
            'ranProduct' => $ranProduct,
            'ramProduct' => $ramProduct,
            'categories' => $categories
        ]);
    }
}
