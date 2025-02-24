<?php

namespace Src\Validations\Admin;

class CategoryValidate
{
    public static function validate($data)
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = "Tên danh mục không được để trống!";
        } elseif (strlen($data['name']) < 3) {
            $errors['name'] = "Tên danh mục phải có ít nhất 3 ký tự!";
        }

        if (!empty($data['description']) && strlen($data['description']) < 10) {
            $errors['description'] = "Mô tả phải có ít nhất 10 ký tự!";
        }

        if (!isset($data['status']) || !in_array($data['status'], [1, 2])) {
            $errors['status'] = "Trạng thái không hợp lệ!";
        }

        return $errors;
    }
}
