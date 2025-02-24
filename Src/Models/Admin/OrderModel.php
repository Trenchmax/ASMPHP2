<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;
use Throwable;
use Exception;

class OrderModel extends BaseModel
{
    protected $table = 'orders';
    protected $id = 'id';

    public function createOrder($data)
    {
        return $this->create($data);
    }


    public function getOneOrder($id)
    {
        return $this->getOne($id);
    }
    public function updateOrder($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getAllActiveOrders()
    {
        return $this->getAllByStatus();
    }

    public function deleteOrder($id)
    {
        return $this->delete($id);
    }
    public function getOneOrderByOrderId($orderId)
    {
        try {
            $sql = "SELECT o.id AS order_id, 
                        o.total_price, 
                        o.status AS order_status,
                        ca.phone, 
                        ca.address, 
                        u.name AS user_name,
                        u.email,
                        p.name AS product_name, 
                        p.thumbnail AS image_name, 
                        p.price, 
                        od.quantity
                    FROM orders o
                    JOIN checkout_addresses ca ON o.address_id = ca.id
                    JOIN users u ON o.user_id = u.id
                    JOIN order_details od ON o.id = od.order_id
                    JOIN products p ON od.product_id = p.id
                    WHERE o.id = ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            if (!$stmt) throw new Exception("Failed to prepare statement: " . $conn->error);

            $stmt->bind_param('i', $orderId);
            $stmt->execute();
            $result = $stmt->get_result();

            $orders = $result->fetch_all(MYSQLI_ASSOC);
            if (empty($orders)) return [];

            $orderInfo = [
                'order_id'    => $orders[0]['order_id'],
                'total_price' => $orders[0]['total_price'],
                'order_status' => $orders[0]['order_status'],
                'phone'       => $orders[0]['phone'],
                'address'     => $orders[0]['address'],
                'user_name'   => $orders[0]['user_name'],
                'email'       => $orders[0]['email'],
            ];

            $products = [];
            foreach ($orders as $row) {
                $products[] = [
                    'product_name' => $row['product_name'],
                    'image_name'   => $row['image_name'],
                    'price'        => $row['price'],
                    'quantity'     => $row['quantity'],
                ];
            }

            return [
                'order'    => $orderInfo,
                'products' => $products
            ];
        } catch (Throwable $e) {
            error_log('Error fetching order data: ' . $e->getMessage());
            return false;
        }
    }


    public function getAllOrders()
    {
        try {
            $sql = "SELECT 
                        o.id AS order_id, o.total_price, o.status, 
                        u.name AS user_name, u.phone AS user_phone, 
                        ca.address,
                        p.name AS product_name, 
                        p.image AS image_name, 
                        od.quantity
                    FROM orders o
                    JOIN users u ON o.user_id = u.id
                    JOIN checkout_addresses ca ON o.address_id = ca.id
                    JOIN order_details od ON o.id = od.order_id
                    JOIN products p ON od.product_id = p.id
                    ORDER BY o.id DESC";

            $conn = $this->_conn->MySQLi();
            $result = $conn->query($sql);

            return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        } catch (Throwable $e) {
            error_log('Error fetching orders: ' . $e->getMessage());
            return false;
        }
    }
}
