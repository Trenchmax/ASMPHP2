<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\CartModel;
use Src\Models\Client\CheckoutModel;
use Src\Models\Client\AddressModel;
use Src\Models\Client\OrderDetailsModel;
use Src\Models\Client\OrderModel;
use Src\Models\Database;
use Src\Helpers\Client\Mailer;
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

        if ($shipping_address_id) {
            $shipping_address = $AddressModel->getOneAddress($user_id, $shipping_address_id);
            $address_id = $shipping_address['id'] ?? null;
        } else {
            $address_id = null;
        }

        if ($payment_method === 'vnpay') {
          
            $vnp_TmnCode = "5Z67L847";
            $vnp_HashSecret = "NSH18UONI26VMR534U26G13KWYS2IIN5";
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost:8000/Orders";  

            $vnp_TxnRef = time();  
            $vnp_OrderInfo = "Thanh toán đơn hàng #{$vnp_TxnRef}";
            $vnp_OrderType = "billpayment";
            $vnp_Amount = $total_price * 100;  
            $vnp_Locale = "vn";
            $vnp_BankCode = "VNPAYQR";  
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = [
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            ];

            ksort($inputData);
            $query = "";
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                $hashdata .= ($hashdata ? '&' : '') . urlencode($key) . '=' . urlencode($value);
                $query .= ($query ? '&' : '') . $key . '=' . $value;
            }

            $vnp_Url .= "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac("sha512", $hashdata, $vnp_HashSecret);
                $vnp_Url .= "&vnp_SecureHash=" . $vnpSecureHash;
            }

      
            header("Location: " . $vnp_Url);
            exit();
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

            $full_name = $first_name . ' ' . $last_name;
            Mailer::sendOrderEmail($email, $full_name, $order_id, $total_price, $cartItems);

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
