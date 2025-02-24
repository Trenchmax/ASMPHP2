<?php

namespace Src\Helpers\Client;

use Src\Models\Client\AddressModel;
use Src\Controllers\BaseController;
use Src\Models\Client\OrderModel;

class ProvinceHelpers extends BaseController
{
    private $userId;

    public function __construct()
    {
        $this->userId = $_SESSION['user']['id'] ?? null;
        if (!$this->userId) {
            $this->redirect('/login');
        }
    }

    private function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    private function setError($key, $message, $redirectUrl)
    {
        $_SESSION['error'] = ucfirst($key) . " $message!";
        $this->redirect($redirectUrl);
    }

    public function showAllAddress()
    {
        $addressModel = new AddressModel();
        $results = $addressModel->getUserAddress($this->userId);
        echo $this->view->render('Client/Pages/UserAddressManage', compact('results'));
    }

    public static function createAddress()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            header('Location: /login');
            exit;
        }

        if (empty($_SESSION['user']['phone'])) {
            $_SESSION['error'] = "Vui lòng nhập số điện thoại trước khi lưu địa chỉ!";
            header('Location: /profile');
            exit;
        }

        $requiredFields = ['city', 'district', 'ward', 'address', 'phone'];
        $data = array_intersect_key($_POST, array_flip($requiredFields));

        if (count($data) < count($requiredFields)) {
            $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin địa chỉ!";
            header('Location: /profile/address');
            exit;
        }

        if (!preg_match('/^\d{10}$/', $data['phone'])) {
            $_SESSION['error'] = "Số điện thoại không hợp lệ!";
            header('Location: /profile/address');
            exit;
        }

        $data['user_id'] = $userId;
        $data['status'] = 1;

        $addressModel = new AddressModel();
        if ($addressModel->createAddress($data)) {
            $_SESSION['success'] = "Địa chỉ đã được lưu thành công!";
        } else {
            $_SESSION['error'] = "Đã xảy ra lỗi, vui lòng thử lại!";
        }

        header('Location: /profile/address');
        exit;
    }

    public function deleteAddress($id)
    {
        $addressModel = new AddressModel();
        $orderModel = new OrderModel();

        if (!empty($orderModel->getOrdersByAddressId($id['id']))) {
            $_SESSION['error'] = "Không thể xóa địa chỉ này vì đang được sử dụng trong các đơn hàng!";
            header('Location: /profile/address');
            exit;
        }

        if ($addressModel->delete($id['id'])) {
            $_SESSION['success'] = "Bạn đã xóa thành công địa chỉ này!";
        } else {
            $_SESSION['error'] = "Xóa địa chỉ thất bại!";
        }

        header('Location: /profile/address');
        exit;
    }
}
