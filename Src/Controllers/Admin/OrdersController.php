<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\OrderModel;

class OrdersController extends BaseController
{
    public function show()
    {
        $OrderModel = new OrderModel();
        $orders = $OrderModel->getAllOrders();

        $groupedOrders = [];
        foreach ($orders as $order) {
            $orderId = $order['order_id'];
            if (!isset($groupedOrders[$orderId])) {
                $groupedOrders[$orderId] = [
                    'id' => $orderId,
                    'user_name' => $order['user_name'],
                    'user_phone' => $order['user_phone'],
                    'address' => $order['address'],
                    'total_price' => $order['total_price'],
                    'status' => $order['status'],
                    'products' => []
                ];
            }
            $groupedOrders[$orderId]['products'][] = [
                'product_name' => $order['product_name'],
                'image_name' => $order['image_name'],
                'quantity' => $order['quantity']
            ];
        }

        echo $this->view->render('Admin/Pages/Orders/OrdersList', ['orders' => $groupedOrders]);
    }


    public function updateStatus()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Phương thức không hợp lệ!']);
            exit;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['order_id']) || !isset($data['status'])) {
            echo json_encode(['status' => 'error', 'message' => 'Thiếu dữ liệu!']);
            exit;
        }

        $orderId = (int)$data['order_id'];
        $status = (int)$data['status'];

        $OrderModel = new OrderModel();
        $updated = $OrderModel->updateOrderStatus($orderId, $status);

        if ($updated) {
            echo json_encode(['status' => 'success', 'message' => 'Cập nhật trạng thái thành công!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Cập nhật trạng thái thất bại!']);
        }
        exit;
    }



    public function detail($orderId)
    {
        $orderId = $orderId['id'];
        $orderId = (int) $orderId;
        $OrderModel = new OrderModel();
        $orderData = $OrderModel->getOneOrderByOrderId($orderId);

        if (!$orderData) {
            die('Không tìm thấy đơn hàng!');
        }

        echo $this->view->render('Admin/Pages/Orders/OrderDetail', [
            'orderData'    => $orderData['order'],
            'products' => $orderData['products']
        ]);
    }
}
