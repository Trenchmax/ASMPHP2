<?php
namespace Src\Validations\Admin;

use Src\Models\Admin\UserModel;

class UserValidate
{
    public static function validateUser($data, $isNew = true, $userId = null)
    {
        $errors = [];

        if (empty($data['email'])) {
            $errors['email'] = "Email không được để trống.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email không hợp lệ.";
        }

        if (!empty($data['phone']) && !preg_match('/^(0[2-9]|84[2-9])[0-9]{8,9}$/', $data['phone'])) {
            $errors['phone'] = "Số điện thoại không hợp lệ.";
        }

        if (!empty($data['password'])) {
            if (strlen($data['password']) < 6) {
                $errors['password'] = "Mật khẩu phải có ít nhất 6 ký tự.";
            }
            if (!preg_match('/[A-Za-z]/', $data['password']) || !preg_match('/\d/', $data['password'])) {
                $errors['password'] = "Mật khẩu phải chứa cả chữ và số.";
            }
        }

        if (empty($data['name'])) {
            $errors['name'] = "Họ tên không được để trống.";
        }

        // Kiểm tra trùng lặp email và số điện thoại
        if ($isNew || (!is_null($userId) && ($data['email'] || $data['phone']))) {
            $userModel = new UserModel();
            $duplicates = $userModel->getDuplicateFields($data['email'] ?? null, $data['phone'] ?? null);

            if (!empty($duplicates)) {
                if (isset($duplicates['email']) && $duplicates['email'] === $data['email']) {
                    $errors['email'] = "Email đã tồn tại.";
                }
                if (isset($duplicates['phone']) && $duplicates['phone'] === $data['phone']) {
                    $errors['phone'] = "Số điện thoại đã tồn tại.";
                }
            }
        }

        return $errors;
    }
}
?>
