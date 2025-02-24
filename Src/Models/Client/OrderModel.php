<?php

namespace Src\Models\Client;

use Src\Models\BaseModel;
use Throwable;
use Exception;

class OrderModel extends BaseModel
{
    protected $table = 'orders';
    protected $id = 'id';

    public function createOrderReturnId($data)
    {
        return $this->createReturnId($data);
    }

    public function getAllOrderByUser($userId)
    {
        try {
            $sql = "SELECT o.*, 
                        p.name AS product_name, 
                        p.image AS image_name, 
                        o.total_price AS order_price, 
                        od.quantity,
                        ca.phone,
                        ca.address,
                        o.status AS order_status, 
                        c.name AS category_name
                    FROM orders o
                    JOIN checkout_addresses ca ON o.address_id = ca.id
                    JOIN order_details od ON o.id = od.order_id
                    JOIN products p ON od.product_id = p.id
                    JOIN categories c ON p.category_id = c.id
                    WHERE o.user_id = ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
        } catch (Throwable $e) {
            error_log('Error fetching order data for user ' . $userId . ': ' . $e->getMessage());
            return false;
        }
    }

    public function getAllOrderByUserAndOrderId($orderId, $userId)
    {
        try {
            $sql = "SELECT o.id, o.total_price, o.status AS order_status, o.created_at,
                           ca.phone, ca.address,
                           GROUP_CONCAT(p.name SEPARATOR ', ') AS product_names,
                           GROUP_CONCAT(p.thumbnail SEPARATOR ', ') AS image_names,
                           GROUP_CONCAT(od.quantity SEPARATOR ', ') AS quantities,
                           GROUP_CONCAT(c.name SEPARATOR ', ') AS category_names
                    FROM orders o
                    JOIN checkout_addresses ca ON o.address_id = ca.id
                    JOIN order_details od ON o.id = od.order_id
                    JOIN products p ON od.product_id = p.id
                    JOIN categories c ON p.category_id = c.id
                    WHERE o.user_id = ? AND o.id = ?
                    GROUP BY o.id";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            if (!$stmt) throw new Exception("Failed to prepare statement: " . $conn->error);

            $stmt->bind_param('ii', $userId, $orderId);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->num_rows > 0 ? $result->fetch_assoc() : [];
        } catch (Throwable $e) {
            error_log('Error fetching order data for user ' . $userId . ': ' . $e->getMessage());
            return false;
        }
    }


    public function getOneOrderByOrderId($orderId)
    {
        try {
            $sql = "SELECT o.*, 
                        o.id AS order_id,
                        p.name AS product_name, 
                        p.thumbnail AS image_name, 
                        o.total_price AS order_price, 
                        od.quantity,
                        ca.phone,
                        ca.address,
                        o.status AS order_status, 
                        c.name AS category_name
                FROM orders o
                JOIN checkout_addresses ca ON o.address_id = ca.id
                JOIN order_details od ON o.id = od.order_id
                JOIN products p ON od.product_id = p.id
                JOIN product_categories pc ON p.id = pc.product_id
                JOIN category_values cv ON pc.category_values_id = cv.id
                JOIN categories c ON cv.category_id = c.id
                WHERE o.id = ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            if (!$stmt) throw new Exception("Failed to prepare statement: " . $conn->error);

            $stmt->bind_param('i', $orderId);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->num_rows > 0 ? $result->fetch_assoc() : [];
        } catch (Throwable $e) {
            error_log('Error fetching order data: ' . $e->getMessage());
            return false;
        }
    }

    public function cancelOrder($id)
    {
        try {
            $conn = $this->_conn->MySQLi();
            $conn->begin_transaction();

            $sqlUpdateOrder = "UPDATE $this->table SET status = 6 WHERE id = ?";
            $stmtUpdateOrder = $conn->prepare($sqlUpdateOrder);
            $stmtUpdateOrder->bind_param('i', $id);
            $stmtUpdateOrder->execute();

            if ($stmtUpdateOrder->affected_rows === 0) {
                throw new Exception("Không tìm thấy đơn hàng hoặc không thể cập nhật trạng thái.");
            }

            $conn->commit();
            return true;
        } catch (Throwable $th) {
            if (isset($conn)) {
                $conn->rollback();
            }
            error_log('Lỗi khi hủy đơn hàng: ' . $th->getMessage());
            return false;
        }
    }

    public function getOneOrder($id)
    {
        return $this->getOne($id);
    }

    public function updateOrder($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteOrder($id)
    {
        return parent::delete($id);
    }

    public function getOrdersByAddressId($addressId)
    {
        try {
            $sql = "SELECT * FROM orders WHERE address_id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            if (!$stmt) throw new Exception("Lỗi chuẩn bị câu lệnh: " . $conn->error);

            $stmt->bind_param("i", $addressId);
            if (!$stmt->execute()) throw new Exception("Lỗi thực thi câu lệnh: " . $stmt->error);

            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Throwable $e) {
            error_log("Lỗi khi lấy đơn hàng theo địa chỉ: " . $e->getMessage());
            return [];
        }
    }
}
