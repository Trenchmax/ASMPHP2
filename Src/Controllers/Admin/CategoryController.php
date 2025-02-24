<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\CategoryModel;
use Src\Validations\Admin\CategoryValidate;

class CategoryController extends BaseController
{
    public function show()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAll();
        echo $this->view->render('Admin/Pages/Category/CategoryList', ['categories' => $categories]);
    }

    public function add()
    {
        echo $this->view->render('Admin/Pages/Category/CategoryAdd');
    }

    private function uploadImage($file, $uploadDir)
    {
        if (!empty($file['name']) && $file['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($file['type'], $allowedTypes)) {
                return ['error' => 'Định dạng ảnh không hợp lệ!'];
            }

            $imageName = time() . '_' . basename($file['name']);
            $imagePath = $uploadDir . $imageName;

            if (move_uploaded_file($file['tmp_name'], $imagePath)) {
                return ['success' => $imageName];
            } else {
                return ['error' => 'Lỗi upload ảnh!'];
            }
        }
        return ['error' => 'Không có file nào được tải lên!'];
    }

    public function create()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'status' => isset($_POST['status']) ? (int)$_POST['status'] : 1
        ];

        $errors = CategoryValidate::validate($data);

        if (!empty($errors)) {
            echo $this->view->render('Admin/Pages/Category/CategoryAdd', ['errors' => $errors, 'oldData' => $data]);
            exit;
        }

        $CategoryModel = new CategoryModel();
        $uploadDir = realpath(__DIR__ . '/../../../public/Assets/uploads/') . DIRECTORY_SEPARATOR;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $image = null;
        if (!empty($_FILES['image']['name'])) {
            $imageUploadResult = $this->uploadImage($_FILES['image'], $uploadDir);
            if (isset($imageUploadResult['success'])) {
                $image = $imageUploadResult['success'];
            } else {
                $_SESSION['error'] = $imageUploadResult['error'];
                header("Location: /admin/category/create");
                exit;
            }
        }

        $newCategoryId = $CategoryModel->createCategory([
            'name' => $data['name'],
            'image' => $image,
            'status' => $data['status'],
        ]);

        if ($newCategoryId) {
            $_SESSION['success'] = "Thêm danh mục thành công!";
        } else {
            $_SESSION['error'] = "Thêm danh mục thất bại!";
        }

        header("Location: /admin/categories");
        exit;
    }
}


    public function edit($params)
    {
        $id = $params['id'];
        $CategoryModel = new CategoryModel();
        $category = $CategoryModel->getOneCategory($id);
        echo $this->view->render('Admin/Pages/Category/CategoryEdit', ['category' => $category]);
    }

    public function update($params)
{
    $id = $params['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $CategoryModel = new CategoryModel();

        $category = $CategoryModel->getOneCategory($id);
        if (!$category) {
            $_SESSION['error'] = "Danh mục không tồn tại!";
            header("Location: /admin/categories");
            exit;
        }

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'status' => isset($_POST['status']) ? (int)$_POST['status'] : 1
        ];

        $errors = CategoryValidate::validate($data);

        if (!empty($errors)) {
            $_SESSION['error'] = "Vui lòng kiểm tra lại dữ liệu!";
            header("Location: /admin/category/edit/$id");
            exit;
        }

        $image = $category['image'];
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = realpath(__DIR__ . '/../../../public/Assets/uploads/') . DIRECTORY_SEPARATOR;
            $imageUploadResult = $this->uploadImage($_FILES['image'], $uploadDir);
            if (isset($imageUploadResult['success'])) {
                $image = $imageUploadResult['success'];
                if (!empty($category['image'])) {
                    unlink($uploadDir . $category['image']);  
                }
            } else {
                $_SESSION['error'] = $imageUploadResult['error'];
                header("Location: /admin/category/edit/$id");
                exit;
            }
        }

        $updated = $CategoryModel->updateCategory($id, [
            'name' => $data['name'],
            'image' => $image,
            'status' => $data['status'],
        ]);

        if ($updated) {
            $_SESSION['success'] = "Cập nhật danh mục thành công!";
        } else {
            $_SESSION['error'] = "Cập nhật danh mục thất bại!";
        }

        header("Location: /admin/categories");
        exit;
    }
}


public function delete($params)
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $CategoryModel = new CategoryModel();

        $deleteSuccess = $CategoryModel->delete($params['id']);

        if ($deleteSuccess) {
            $_SESSION['success'] = "Xóa danh mục thành công!";
        } else {
            $_SESSION['error'] = "Xóa danh mục thất bại!";
        }

        header("Location: /admin/categories");
        exit;
    }
}

}
