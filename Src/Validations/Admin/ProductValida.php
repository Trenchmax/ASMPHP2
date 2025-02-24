<?php

namespace Src\Validations\Admin;

class ProductValida {
    
    public static function validate($data) {
        $errors = [];

        if (empty($data['name'])) {
            $errors[] = "Tên sản phẩm không được để trống.";
        }

        if (!isset($data['price']) || $data['price'] <= 0) {
            $errors[] = "Giá sản phẩm phải lớn hơn 0.";
        }

        if (!isset($data['total_quantity']) || $data['total_quantity'] < 0) {
            $errors[] = "Số lượng sản phẩm không hợp lệ.";
        }

        if (!empty($data['image'])) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExt = pathinfo($data['image'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($fileExt), $allowedExtensions)) {
                $errors[] = "Định dạng hình ảnh không hợp lệ (chỉ hỗ trợ JPG, PNG, GIF).";
            }
        }

        return $errors;
    }
}
