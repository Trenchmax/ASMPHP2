<?php

namespace Src\Validations\Admin;

class BrandValidate {
    public static function validateCreate(array $data) {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = "Tên thương hiệu không được để trống.";
        } elseif (strlen($data['name']) < 3) {
            $errors['name'] = "Tên thương hiệu phải có ít nhất 3 ký tự.";
        }

        if (!empty($data['description']) && strlen($data['description']) > 255) {
            $errors['description'] = "Mô tả không được vượt quá 255 ký tự.";
        }

        if (!isset($data['status']) || !in_array($data['status'], [0, 1])) {
            $errors['status'] = "Trạng thái không hợp lệ.";
        }

        return $errors;
    }
}
