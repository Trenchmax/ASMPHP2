<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\OrderModel;
use Src\Notifications\Notification;

class OrderController extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        parent::__construct();
        $this->orderModel = new OrderModel();
    }

    public function show($orderId)
    {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: /loginForm");
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $orders = $this->orderModel->getAllOrderByUser($userId);

        if (!$orders) {
            header("Location: /Account");
            exit;
        }

        $groupedOrders = [];
        foreach ($orders as $order) {
            $groupedOrders[$order['id']][] = $order;
        }

        echo $this->view->render('Client/Pages/UserOrder', [
            'groupedOrders' => $groupedOrders
        ]);
    }
    public function cancel($params)
    {
        $id = isset($params['id']) ? (int)$params['id'] : null;

        if (!isset($_SESSION['user']['id'])) {
            header("Location: /loginForm");
            exit;
        }

        $userId = $_SESSION['user']['id'];

        $order = $this->orderModel->getAllOrderByUserAndOrderId($id, $userId);
        if (!$order) {
            $_SESSION['error'] = "Đơn hàng không tồn tại hoặc không thuộc về bạn.";
            var_dump($order);
            // header("Location: /Account");
            exit;
        }

        $isCanceled = $this->orderModel->cancelOrder($id);

        if ($isCanceled) {
            $_SESSION['success'] = "Đơn hàng đã được hủy thành công.";
        } else {
            $_SESSION['error'] = "Không thể hủy đơn hàng, vui lòng thử lại.";
        }

        header("Location: /Account");
        exit;
    }
}
