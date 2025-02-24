<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\CartModel;
use Src\Models\Client\CheckoutModel;
use Src\Models\Client\AddressModel;
use Src\Models\Client\OrderDetailsModel;
use Src\Models\Client\OrderModel;
use Src\Models\Database;
use Exception;

class CheckoutController extends BaseController
{

    public function cart()
    {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: /loginForm");
            exit();
        }

        $user_id = $_SESSION['user']['id'];
        $CartModel = new CartModel();
        $data = $CartModel->getCartByUser($user_id);

        if ($data === false) {
            die("Lỗi: Không thể lấy giỏ hàng. Vui lòng thử lại.");
        }

        echo $this->view->render('Client/Payment/cart', ['data' => $data]);
    }

    public function show()
    {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: /loginForm");
            exit();
        }

        $user_id = $_SESSION['user']['id'];
        $CartModel = new CartModel();
        $addressModel = new AddressModel();
        $results = $addressModel->getUserAddress($user_id);
        $data = $CartModel->getCartByUser($user_id);

        if ($data === false) {
            die("Lỗi: Không thể lấy giỏ hàng. Vui lòng thử lại.");
        }

        echo $this->view->render('Client/Payment/checkout', ['data' => $data, 'results' => $results]);
    }

    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /cart");
            exit();
        }
    
        if (empty($_SESSION['user']['id'])) {
            header("Location: /login");
            exit();
        }
    
        $user_id = $_SESSION['user']['id'];
        $CartModel = new CartModel();
        $CheckoutModel = new CheckoutModel();
        $AddressModel = new AddressModel();
    
        $cartItems = $CartModel->getCartByUser($user_id);
        if (empty($cartItems)) {
            header("Location: /cart?error=empty_cart");
            exit();
        }
    
        $first_name = $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $total_price = $_POST['total_price'] ?? 0;
        $payment_method = $_POST['payment_method'] ?? 'cod';
        $shipping_address_id = $_POST['shipping_address'] ?? null;
    
        $shipping_address_id = $_POST['shipping_address'] ?? null;
    
        if ($shipping_address_id) {
            $AddressModel = new AddressModel();
            $shipping_address = $AddressModel->getOneAddress($user_id, $shipping_address_id);
            $address_id = $shipping_address['id'] ?? null;
        } else {
            $address_id = null;
        }
    
        $database = new Database();
        $conn = $database->MySQLi();
        $conn->begin_transaction();
    
        try {
            $OrderModel = new OrderModel();
            $OrderDetailsModel = new OrderDetailsModel();
    
            $orderData = [
                'user_id' => $user_id,
                'total_price' => $total_price,
                'status' => 1,  
                'address_id' => $address_id
            ];
            $order_id = $OrderModel->createOrderReturnId($orderData);
    
            if (!$order_id) {
                throw new Exception('Không thể tạo đơn hàng');
            }
    
            foreach ($cartItems as $item) {
                $orderDetailData = [
                    'order_id' => $order_id,
                    'product_id' => $item['product_id'],   
                    'price' => $item['product_price'],
                    'quantity' => $item['quantity']
                ];
    
                $result = $OrderDetailsModel->createDetail($orderDetailData);
    
                if (!$result) {
                    throw new Exception('Không thể thêm chi tiết đơn hàng');
                }
            }
    
            $conn->commit();
    
            $CartModel->deleteAllCarts($user_id);
    
            header("Location: /Orders");
            exit();
    
        } catch (Exception $e) {
            $conn->rollback();
            error_log('Lỗi khi tạo đơn hàng: ' . $e->getMessage());
            header("Location: /checkout?error=failed");
            exit();
        }
    }
    
    
}
