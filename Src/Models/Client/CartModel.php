<?php

namespace Src\Models\Client;

use Exception;
use Src\Models\BaseModel;

class CartModel extends BaseModel
{
    protected $table = 'Carts';
    protected $id = 'id';

    public function getAllCart()
    {
        try {
            return $this->getAll();
        } catch (Exception $e) {
            error_log('Lỗi khi lấy tất cả giỏ hàng: ' . $e->getMessage());
            return false;
        }
    }

    public function getCartByUser($user_id)
    {
        try {
            $sql = "SELECT 
                        Carts.id AS cart_id, 
                        Products.id AS product_id,
                        Products.name AS product_name, 
                        Products.description AS product_description, 
                        Products.short_description AS short_description, 
                        Users.email AS user_email, 
                        Products.price AS product_price, 
                        Products.image AS product_images, 
                        Carts.quantity AS quantity, 
                        CAST((Products.price - (Products.price * Products.discount / 100)) AS DECIMAL(10,2)) AS discounted_price, 
                        CAST(((Products.price - (Products.price * Products.discount / 100)) * Carts.quantity) AS DECIMAL(10,2)) AS total_price 
                    FROM Carts 
                    JOIN Users ON Carts.user_id = Users.id 
                    JOIN Products ON Carts.product_id = Products.id
                    WHERE Carts.user_id = ?";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi lấy giỏ hàng: ' . $th->getMessage());
            return false;
        }
    }

    public function createOrUpdateCart($user_id, $product_id, $quantity)
    {
        try {
            error_log("Đang thêm/cập nhật sản phẩm vào giỏ hàng: user_id = $user_id, product_id = $product_id, quantity = $quantity");

            $sql = "INSERT INTO Carts (user_id, product_id, quantity) 
                    VALUES (?, ?, ?) 
                    ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";

            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $user_id, $product_id, $quantity);
            $result = $stmt->execute();

            if (!$result) {
                error_log("Lỗi MySQL: " . $stmt->error);
            } else {
                error_log("Thêm/cập nhật giỏ hàng thành công!");
            }

            $stmt->close();
            return $result;
        } catch (Exception $e) {
            error_log('Lỗi khi thêm/cập nhật giỏ hàng: ' . $e->getMessage());
            return false;
        }
    }


    public function updateCart($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCart($id)
    {
        return $this->delete($id);
    }

    public function deleteAllCarts($userId)
    {
        try {
            $sql = "DELETE FROM Carts WHERE user_id = ?";
            $conn = $this->_conn->MySQLi();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $userId);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            error_log('Lỗi khi xóa tất cả sản phẩm khỏi giỏ hàng: ' . $e->getMessage());
            return false;
        }
    }
}
