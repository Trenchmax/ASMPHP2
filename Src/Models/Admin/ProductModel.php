<?php

namespace Src\Models\Admin;

use Exception;
use Src\Models\BaseModel;

class ProductModel extends BaseModel
{
    protected $table = "products";
    protected $id = "id";

    public function getAllProduct()
    {
        return $this->getAll();
    }

    public function getOneNormal($id)
    {
        return $this->getOne($id);
    }


    public function createProduct($data)
    {
        return $this->create($data);
    }

    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->delete($id);
    }

    public function isNameDupliProductByColumn($name)
    {
        return $this->findDuplicateByColumn('name', $name);
    }

    public function addThumbnail($productId, $imagePath)
    {
        try {
            $sql = "INSERT INTO product_thumbnails (product_id, image_path) VALUES (?, ?)";

            $conn = $this->_conn->MySQLi();

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('is', $productId, $imagePath);

            return $stmt->execute();
        } catch (\Throwable $th) {
            error_log('Lỗi khi thêm thumbnail: ' . $th->getMessage());
            return false;
        }
    }
}
