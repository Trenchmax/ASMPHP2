<?php
namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\AnalyticModel;

class DashboardController extends BaseController {
    private $analyticModel;

    public function __construct() {
        parent::__construct();
        $this->analyticModel = new AnalyticModel();
    }

    public function show() {
        $data = [
            'total_users' => $this->analyticModel->getTotalUsers(),
            'total_orders' => $this->analyticModel->getTotalOrders(),
            'total_comments' => $this->analyticModel->getTotalBrands(),
            'total_product_category' => $this->analyticModel->getProductCategories(),
            'comment_by_product' => $this->analyticModel->getTopCommentedProducts()
        ];

        echo $this->view->render('Admin/Pages/Dashboard/Dashboard', compact('data'));
    }
}
