<?php

namespace Src\Controllers\Admin;

use Src\Controllers\BaseController;
use Src\Models\Admin\CategoryModel;
use Src\Models\Admin\BrandModel;
use Src\Models\Admin\ProductModel;
use Src\Validations\Admin\ProductValida;

class ProductsController extends BaseController
{
    public function show()
    {
        $ProductModel = new ProductModel();
        $data = $ProductModel->getAllProduct();
        echo $this->view->render('Admin/Pages/Products/ProductList', ['data' => $data]);
    }

    public function add()
    {
        $BrandModel = new BrandModel();
        $CategoryModel = new CategoryModel;
        $brands = $BrandModel->getAllActiveBrands();
        $categories = $CategoryModel->getAllActiveCategories();
        echo $this->view->render('Admin/Pages/Products/ProductAdd', ['brands' => $brands, 'categories' => $categories]);
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
            $ProductModel = new ProductModel();
            $uploadDir = realpath(__DIR__ . '/../../../public/Assets/uploads') . DIRECTORY_SEPARATOR;
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $errors = ProductValida::validate($_POST);
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: /admin/product/add');
                exit;
            }

            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $brand_id = $_POST['brand_id'];
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $total_quantity = $_POST['total_quantity'];
            $status = $_POST['status'] ?? 1;

            $image = null;
            if (!empty($_FILES['image']['name'])) {
                $imageUploadResult = $this->uploadImage($_FILES['image'], $uploadDir);
                if (isset($imageUploadResult['success'])) {
                    $image = $imageUploadResult['success'];
                } else {
                    $_SESSION['errors'][] = $imageUploadResult['error'];
                    header('Location: /admin/product/add');
                    exit;
                }
            }
            $thumbnails = [];
            if (!empty($_FILES['thumbnail']['name'][0])) {
                foreach ($_FILES['thumbnail']['name'] as $key => $thumbFile) {
                    $thumbUploadResult = $this->uploadImage([
                        'name' => $_FILES['thumbnail']['name'][$key],
                        'tmp_name' => $_FILES['thumbnail']['tmp_name'][$key],
                        'error' => $_FILES['thumbnail']['error'][$key],
                        'type' => $_FILES['thumbnail']['type'][$key]
                    ], $uploadDir);

                    if (isset($thumbUploadResult['success'])) {
                        $thumbnails[] = $thumbUploadResult['success'];
                    }
                }
            }

            $thumbnailList = implode(',', $thumbnails);  

            $newProductId = $ProductModel->createProduct([
                'name' => $name,
                'description' => $description,
                'brand_id' => $brand_id,
                'category_id' => $category_id,
                'price' => $price,
                'total_quantity' => $total_quantity,
                'image' => $image,
                'thumbnail' => $thumbnailList,
                'status' => $status,
            ]);

            if ($newProductId) {
                $_SESSION['success'] = 'Thêm sản phẩm thành công!';
                header("Location: /admin/products");
                exit;
            } else {
                $_SESSION['errors'][] = 'Thêm sản phẩm thất bại!';
                header("Location: /admin/products/add");
                exit;
            }
        }
    }

    public function edit($params)
    {
        $id = $params['id'];
        $BrandModel = new BrandModel();
        $CategoryModel = new CategoryModel();
        $brands = $BrandModel->getAllActiveBrands();
        $categories = $CategoryModel->getAllActiveCategories();

        $ProductModel = new ProductModel();
        $product = $ProductModel->getOneNormal($id);

        if (!$product) {
            $_SESSION['errors'][] = 'Sản phẩm không tồn tại!';
            header("Location: /admin/products");
            exit;
        }

        echo $this->view->render('Admin/Pages/Products/ProductEdit', [
            'brand' => $brands,
            'categories' => $categories,
            'product' => $product
        ]);
    }
    public function update($params)
    {
        $id = $params['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ProductModel = new ProductModel();
            $uploadDir = realpath(__DIR__ . '/../../../public/Assets/uploads') . DIRECTORY_SEPARATOR;

            $product = $ProductModel->getOneNormal($id);
            if (!$product) {
                $_SESSION['errors'][] = "Sản phẩm không tồn tại!";
                header("Location: /admin/product/edit/$id");
                exit;
            }

            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $brand_id = filter_var($_POST['brand_id'] ?? '', FILTER_VALIDATE_INT);
            $category_id = filter_var($_POST['category_id'] ?? '', FILTER_VALIDATE_INT);
            $price = filter_var($_POST['price'] ?? '', FILTER_VALIDATE_FLOAT);
            $total_quantity = filter_var($_POST['total_quantity'] ?? '', FILTER_VALIDATE_INT);
            $status = isset($_POST['status']) ? (int)$_POST['status'] : 1;

            $errors = [];

            if (!$name) {
                $errors[] = "Tên sản phẩm không được để trống.";
            }
            if (!$brand_id) {
                $errors[] = "Vui lòng chọn thương hiệu hợp lệ.";
            }
            if (!$category_id) {
                $errors[] = "Vui lòng chọn danh mục hợp lệ.";
            }
            if (!$price || $price <= 0) {
                $errors[] = "Giá sản phẩm phải lớn hơn 0.";
            }
            if (!$total_quantity || $total_quantity < 0) {
                $errors[] = "Số lượng sản phẩm không hợp lệ.";
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /admin/product/edit/$id");
                exit;
            }

            $image = $product['image'];
            if (!empty($_FILES['image']['name'])) {
                $imageUploadResult = $this->uploadImage($_FILES['image'], $uploadDir);
                if (isset($imageUploadResult['success'])) {
                    $image = $imageUploadResult['success'];
                    unlink($uploadDir . $product['image']);  
                }
            }

            $thumbnails = [];
            if (!empty($_FILES['thumbnail']['name'][0])) {
                foreach ($_FILES['thumbnail']['name'] as $key => $thumbFile) {
                    $thumbUploadResult = $this->uploadImage([
                        'name' => $_FILES['thumbnail']['name'][$key],
                        'tmp_name' => $_FILES['thumbnail']['tmp_name'][$key],
                        'error' => $_FILES['thumbnail']['error'][$key],
                        'type' => $_FILES['thumbnail']['type'][$key]
                    ], $uploadDir);

                    if (isset($thumbUploadResult['success'])) {
                        $thumbnails[] = $thumbUploadResult['success'];
                    }
                }
            }

            $thumbnailList = implode(',', $thumbnails);  

            $updated = $ProductModel->updateProduct($id, [
                'name' => $name,
                'description' => $description,
                'brand_id' => $brand_id,
                'category_id' => $category_id,
                'price' => $price,
                'total_quantity' => $total_quantity,
                'image' => $image,
                'thumbnail' => $thumbnailList, 
                'status' => $status,
            ]);

            if ($updated) {
                $_SESSION['success'] = "Cập nhật sản phẩm thành công!";
                header("Location: /admin/products");
                exit;
            } else {
                $_SESSION['errors'][] = "Cập nhật sản phẩm thất bại!";
                header("Location: /admin/product/edit/$id");
                exit;
            }
        } else {
            $_SESSION['errors'][] = "Phương thức không hợp lệ!";
            header("Location: /admin/product/edit/$id");
            exit;
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $ProductModel = new ProductModel();
            $deleteSuccess = $ProductModel->deleteProduct($id['id']);

            if ($deleteSuccess) {
                $_SESSION['success'] = 'Xóa sản phẩm thành công!';
            } else {
                $_SESSION['errors'][] = 'Xóa sản phẩm thất bại!';
            }
            header('Location: /admin/products');
            exit;
        }
    }
}
