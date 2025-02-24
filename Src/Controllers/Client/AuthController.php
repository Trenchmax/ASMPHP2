<?php

namespace Src\Controllers\Client;

use Src\Controllers\BaseController;
use Src\Models\Client\UserModel;

class AuthController extends BaseController
{
    public function loginForm()
    {
        echo $this->view->render('Client/pages/login');
    }

    public function registerForm()
    {
        echo $this->view->render('Client/pages/register');
    }

    public function resetPassForm()
    {
        echo $this->view->render('Client/pages/ResetPassword');
    }

    public function register()
    {
        $userModel = new UserModel();

        if (
            empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['password']) ||
            empty($_POST['firstname']) || empty($_POST['lastname'])
        ) {
            echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ thông tin!"]);
            exit;
        }

        if ($userModel->isUserExists($_POST['email'], $_POST['phone'])) {
            echo json_encode(["status" => "error", "message" => "Email hoặc số điện thoại đã tồn tại!"]);
            exit;
        }

        $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $data = [
            'email'      => $_POST['email'],
            'phone'      => $_POST['phone'],
            'password'   => $hashedPassword,
            'name'       => trim($_POST['firstname'] . ' ' . $_POST['lastname']),
            'firstname'  => $_POST['firstname'],
            'lastname'   => $_POST['lastname'],
            'status'     => 1,
            'role'       => '1',
            'method'     => 'local',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($userModel->registerUser($data)) {
            header("Location: /loginForm");
            exit;
        } else {
            echo json_encode(["status" => "error", "message" => "Đăng ký thất bại!"]);
            exit;
        }
    }




    public function login()
    {
        $userModel = new UserModel();

        if (empty($_POST['email']) || empty($_POST['password'])) {
            echo json_encode(["status" => "error", "message" => "Vui lòng nhập đầy đủ thông tin!"]);
            exit;
        }
        $email = strtolower(trim($_POST['email']));
        $password = trim($_POST['password']);

        $user = $userModel->loginUser($email, $password);

        if ($user && isset($user['id'])) {  
            $_SESSION['user'] = $user;

            header("Location: /");
            exit;
        }

        var_dump($email, $password, $user);
        //    header("Location: /loginForm?error=" . urlencode("Sai email hoặc mật khẩu!"));
        exit;
    }

    public function updateInformation()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $data = [
            'name'      => trim($_POST['fullname'] ?? ''),
            'firstname' => trim($_POST['firstname'] ?? ''),
            'lastname'  => trim($_POST['lastname'] ?? ''),
            'phone'     => trim($_POST['phone'] ?? ''),
            'email'     => trim($_POST['email'] ?? '')
        ];

        if (isset($_SESSION['user']['google_id']) && !empty($_SESSION['user']['google_id'])) {
            unset($data['email']);
        }

        foreach ($data as $key => $value) {
            if (empty($value)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin!";
                header("Location: /Account");
                exit();
            }
            if (preg_match('/\s/', $value)) {
                $_SESSION['error'] = ucfirst($key) . " không được chứa khoảng trắng!";
                header("Location: /Account");
                exit();
            }
        }
        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email không hợp lệ!";
            header("Location: /Account");
            exit();
        }

        if (isset($data['email']) && !preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $data['email'])) {
            $_SESSION['error'] = "Email phải có đuôi @gmail.com!";
            header("Location: /Account");
            exit();
        }

        $userModel = new UserModel();
        $update = $userModel->updateUserinfo($userId, $data);

        if ($update) {
            $_SESSION['user'] = array_merge($_SESSION['user'], $data);
            $_SESSION['success'] = "Cập nhật thông tin thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra, vui lòng thử lại!";
        }

        header("Location: /Account");
        exit();
    }



    public function changePassword($userId, $oldPassword, $newPassword)
    {
        $userModel = new UserModel();

        $user = $userModel->getOne($userId);
        if (!$user || !password_verify($oldPassword, $user['password'])) {
            return json_encode(["status" => "error", "message" => "Mật khẩu cũ không đúng!"]);
        }

        return $userModel->changePassword($userId, $newPassword)
            ? json_encode(["status" => "success", "message" => "Đổi mật khẩu thành công!"])
            : json_encode(["status" => "error", "message" => "Thất bại!"]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();

        header("Location: /");
        exit();
    }
}
