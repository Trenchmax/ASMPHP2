<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\BrandModel;
use Src\Validations\Admin\BrandValidate;

class BrandController extends BaseController
{
    public function show()
    {
        $BrandModel = new BrandModel();
        $brand = $BrandModel->getAll();
        echo $this->view->render('Admin/Pages/Brands/BrandsList', ['brand' => $brand]);
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

    public function add()
    {
        echo $this->view->render('Admin/Pages/Brands/BrandAdd');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $BrandModel = new BrandModel();
            $uploadDir = realpath(__DIR__ . '/../../../public/Assets/uploads') . DIRECTORY_SEPARATOR;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $status = isset($_POST['status']) ? (int)$_POST['status'] : 1;

            require_once __DIR__ . '/../../Validations/Admin/BrandValidate.php';
            $errors = $brandModel->validateCreate($_POST);

            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
                header('Location: /admin/brands/add');
                exit;
            }

            $image = null;
            if (!empty($_FILES['image']['name'])) {
                $imageUploadResult = $this->uploadImage($_FILES['image'], $uploadDir);
                if (isset($imageUploadResult['success'])) {
                    $image = $imageUploadResult['success'];
                } else {
                    $_SESSION['error'] = $imageUploadResult['error'];
                    header('Location: /admin/brands/add');
                    exit;
                }
            }

            try {
                $newBrandId = $BrandModel->createBrand([
                    'name' => $name,
                    'description' => $description,
                    'image' => $image,
                    'status' => $status,
                ]);

                if ($newBrandId) {
                    $_SESSION['success'] = 'Thêm thương hiệu thành công!';
                    header('Location: /admin/brands');
                    exit;
                } else {
                    $_SESSION['error'] = 'Thêm thương hiệu thất bại!';
                }
            } catch (\Throwable $th) {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }

            header('Location: /admin/brands/add');
            exit;
        }
    }

    public function edit($params)
    {
        $id = $params['id'];
        $brandModel = new BrandModel();
        $brand = $brandModel->getOneBrand($id);
        echo $this->view->render('Admin/Pages/Brands/BrandEdit', ['brand' => $brand]);
    }

    public function update($params)
    {
        $id = $params['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $BrandModel = new BrandModel();
            $uploadDir = realpath(__DIR__ . '/../../../public/Assets/uploads/brands') . DIRECTORY_SEPARATOR;

            $brand = $BrandModel->getOneBrand($id);
            if (!$brand) {
                $_SESSION['error'] = 'Thương hiệu không tồn tại!';
                header('Location: /admin/brands');
                exit;
            }

            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $status = isset($_POST['status']) ? (int)$_POST['status'] : 1;

            require_once __DIR__ . '/../../Validations/Admin/BrandValidate.php';
            $errors = $brandModel->validateCreate($_POST);

            if (!empty($errors)) {
                $_SESSION['error'] = $errors;
                header("Location: /admin/brands/edit/$id");
                exit;
            }

            $image = $brand['image'];
            if (!empty($_FILES['image']['name'])) {
                $imageUploadResult = $this->uploadImage($_FILES['image'], $uploadDir);
                if (isset($imageUploadResult['success'])) {
                    $image = $imageUploadResult['success'];
                    if (!empty($brand['image'])) {
                        unlink($uploadDir . $brand['image']);
                    }
                }
            }

            try {
                $updated = $BrandModel->updateBrand($id, [
                    'name' => $name,
                    'description' => $description,
                    'image' => $image,
                    'status' => $status,
                ]);

                if ($updated) {
                    $_SESSION['success'] = 'Cập nhật thương hiệu thành công!';
                } else {
                    $_SESSION['error'] = 'Cập nhật thương hiệu thất bại!';
                }
            } catch (\Throwable $th) {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }

            header("Location: /admin/brands");
            exit;
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $BrandModel = new BrandModel();

            $deleteSuccess = $BrandModel->delete($id['id']);

            if ($deleteSuccess) {
                $_SESSION['success'] = 'Xóa thương hiệu thành công!';
            } else {
                $_SESSION['error'] = 'Xóa thương hiệu thất bại!';
            }

            header('Location: /admin/brands');
            exit;
        }
    }
}
