<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\UserModel;
use Src\Validations\Admin\UserValidate;

class UserController extends BaseController
{
    public function show()
    {
        $UserModel = new UserModel();
        $users = $UserModel->showAll();
        echo $this->view->render('Admin/Pages/Users/UsersList', ['users' => $users]);
    }

    public function add()
    {
        echo $this->view->render('Admin/Pages/Users/UserAdd');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $UserModel = new UserModel();

            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'firstname' => trim($_POST['firstname'] ?? ''),
                'lastname' => trim($_POST['lastname'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
                'role' => filter_var($_POST['role'] ?? '', FILTER_VALIDATE_INT),
                'status' => isset($_POST['status']) ? (int)$_POST['status'] : 1,
            ];

            $errors = UserValidate::validateUser($data);

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /admin/create-user");
                exit;
            }

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $newUserId = $UserModel->createUser($data);

            if ($newUserId) {
                $_SESSION['success'] = "Thêm người dùng thành công!";
                header("Location: /admin/users");
                exit;
            } else {
                $_SESSION['errors'] = ["Thêm người dùng thất bại!"];
                header("Location: /admin/create-user");
                exit;
            }
        } else {
            die("Phương thức không hợp lệ!");
        }
    }

    public function edit($params)
    {
        $id = $params['id'];
        $UserModel = new UserModel();
        $users = $UserModel->getOneUser($id);
        echo $this->view->render('Admin/Pages/Users/UserEdit', ['users' => $users]);
    }

    public function update($params)
    {
        $id = $params['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $UserModel = new UserModel();

            $user = $UserModel->getOne($id);
            if (!$user) {
                $_SESSION['errors'] = ["Người dùng không tồn tại!"];
                header("Location: /admin/users");
                exit;
            }

            $data = [
                'firstname' => trim($_POST['firstname'] ?? ''),
                'lastname' => trim($_POST['lastname'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'name' => trim($_POST['name'] ?? ''),
                'password' => $_POST['password'] ?? '', 
                'role' => filter_var($_POST['role'] ?? '', FILTER_VALIDATE_INT),
                'status' => isset($_POST['status']) ? (int)$_POST['status'] : 1,
            ];

            $errors = UserValidate::validateUser($data);

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /admin/users/edit/$id");
                exit;
            }

            if (empty($data['password'])) {
                $data['password'] = $user['password'];
            } else {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }

            $updated = $UserModel->updateUser($id, $data);

            if ($updated) {
                $_SESSION['success'] = "Cập nhật người dùng thành công!";
                header("Location: /admin/users");
                exit;
            } else {
                $_SESSION['errors'] = ["Cập nhật người dùng thất bại!"];
                header("Location: /admin/users/edit/$id");
                exit;
            }
        } else {
            die("Phương thức không hợp lệ!");
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $UserModel = new UserModel();

            $deleteSuccess = $UserModel->deleteUser($id['id']);

            if ($deleteSuccess) {
                $_SESSION['success'] = "Xóa người dùng thành công!";
            } else {
                $_SESSION['errors'] = ["Xóa người dùng thất bại!"];
            }

            header('Location: /admin/users');
            exit;
        }
    }
}
