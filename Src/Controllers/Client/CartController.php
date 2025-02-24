<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\CartModel;

class CartController extends BaseController
{
    public function show()
    {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: /loginForm");
            exit();
        }

        $user_id = $_SESSION['user']['id'];
        $CartModel = new CartModel();
        $data = $CartModel->getCartByUser($user_id);

        echo $this->view->render('Client/Payment/Cart', ['data' => $data]);
    }

    public function store()
    {
        error_log("Store function is being called");  
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            error_log("Wrong request method");
            header("Location: /");
            exit();
        }

        if (!isset($_SESSION['user']['id'])) {
            error_log("User not logged in");
            header("Location: /loginForm");
            exit();
        }

        error_log("User ID: " . $_SESSION['user']['id']);

        $product_id = $_POST['product_id'] ?? null;
        $quantity = $_POST['quantity'] ?? null;
        error_log("Received product_id: $product_id, quantity: $quantity");

        if (!$product_id || !is_numeric($product_id) || !$quantity || !is_numeric($quantity) || $quantity <= 0) {
            error_log("Invalid input");
            header("Location: /cart?error=invalid_input");
            exit();
        }

        $CartModel = new CartModel();
        $result = $CartModel->createOrUpdateCart($_SESSION['user']['id'], $product_id, $quantity);

        if ($result) {
            error_log("Added to cart successfully");
        } else {
            error_log("Failed to add to cart");
        }

        header("Location: /cart");
        exit();
    }


    public function updateCart($params)
    {
        $id = $params['id'] ?? null;
        $quantity = $_POST['quantity'] ?? null;

        if (!$id || !is_numeric($id) || !$quantity || !is_numeric($quantity) || $quantity <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            exit();
        }

        $cartModel = new CartModel();
        $result = $cartModel->updateCart($id, ['quantity' => $quantity]);

        echo json_encode($result ? ['status' => 'success', 'message' => 'Cart updated successfully'] : ['status' => 'error', 'message' => 'Update failed']);
        exit();
    }

    public function deleteOneCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $CartModel = new CartModel();
            $id = $_POST['id'];

            $result = $CartModel->deleteCart($id);
            if ($result) {
                $_SESSION['success'] = "Sản phẩm đã được xóa khỏi giỏ hàng!";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra, vui lòng thử lại!";
            }
        }
        header('Location: /cart');
        exit();
    }

    public function deleteAllCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $CartModel = new CartModel();
            $user_id = $_SESSION['user']['id'];

            $result = $CartModel->deleteAllCarts($user_id);
            if ($result) {
                $_SESSION['success'] = "Giỏ hàng đã được làm trống!";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra, vui lòng thử lại!";
            }
        }
        header('Location: /cart');
        exit();
    }
}
