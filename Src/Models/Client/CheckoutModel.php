<?php

namespace Src\Models\Client;

use Exception;
use Src\Models\BaseModel;

class CheckoutModel extends BaseModel
{
    protected $table = 'Orders';
    protected $id = 'id';

    public function createOrder($user_id, $cartItems, $total_price, $shipping_address = null, $payment_method = 'cod')
{
    try {
        $conn = $this->_conn->MySQLi();
        $conn->begin_transaction();

        // Lấy ID của shipping_address nếu có
        $address_id = isset($shipping_address['id']) ? $shipping_address['id'] : null;

        // Tạo đơn hàng
        $sql = "INSERT INTO Orders (user_id, total_price, status, address_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Gán giá trị của address_id vào một biến tạm để truyền vào bind_param
        $status = 'pending'; // Giá trị mặc định cho status
        $stmt->bind_param("idsi", $user_id, $total_price, $status, $address_id);
        $stmt->execute();
        $order_id = $stmt->insert_id;
        $stmt->close();

        // Lưu danh sách sản phẩm vào order_details
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        foreach ($cartItems as $item) {
            $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['product_price']);
            $stmt->execute();
        }
        $stmt->close();

        $conn->commit(); // Commit transaction nếu mọi thứ thành công
        return $order_id;
    } catch (Exception $e) {
        $conn->rollback(); // Rollback nếu có lỗi xảy ra
        error_log('Lỗi khi tạo đơn hàng: ' . $e->getMessage());
        return false;
    }
}

    



    public function getOrderById($order_id)
    {
        try {
            return $this->getOne($order_id);
        } catch (Exception $e) {
            error_log('Lỗi khi lấy đơn hàng: ' . $e->getMessage());
            return false;
        }
    }

    public function updateOrderStatus($order_id, $status)
    {
        try {
            return $this->update($order_id, ['status' => $status]);
        } catch (Exception $e) {
            error_log('Lỗi khi cập nhật trạng thái đơn hàng: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteOrder($order_id)
    {
        try {
            return $this->delete($order_id);
        } catch (Exception $e) {
            error_log('Lỗi khi xóa đơn hàng: ' . $e->getMessage());
            return false;
        }
    }
}
