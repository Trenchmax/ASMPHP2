<?php
namespace Src\Validations\Admin;

class UserValidate
{
    public static function validateUser($data)
    {
        $errors = [];

        if (empty($data['email'])) {
            $errors[] = "Email không được để trống.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email không hợp lệ.";
        }

        if (!empty($data['phone']) && !preg_match('/^(0[2-9]|84[2-9])[0-9]{8,9}$/', $data['phone'])) {
            $errors[] = "Số điện thoại không hợp lệ.";
        }

        if (!empty($data['password'])) {
            if (strlen($data['password']) < 6) {
                $errors[] = "Mật khẩu phải có ít nhất 6 ký tự.";
            }
            if (!preg_match('/[A-Za-z]/', $data['password']) || !preg_match('/\d/', $data['password'])) {
                $errors[] = "Mật khẩu phải chứa cả chữ và số.";
            }
        }

        if (empty($data['name'])) {
            $errors[] = "Họ tên không được để trống.";
        }

        return $errors;
    }
}
?>
