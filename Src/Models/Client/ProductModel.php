<?php

namespace Src\Models\Client;

use Src\Models\BaseModel;

class ProductModel extends BaseModel
{

    protected $table = 'products';
    protected $id = 'id';

    public function getAllProduct()
    {
        return $this->getAll();
    }

    public function getOneNormal($id)
    {
        return $this->getOne($id);
    }


    public function getAllRamProduct()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table ORDER BY RAND() LIMIT 12;";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllRamProduct4()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table ORDER BY RAND() LIMIT 4;";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getAllProductByCategory(int $id)
{
    $result = [];
    try {
        $sql = "SELECT * FROM $this->table WHERE category_id = ? ORDER BY created_at DESC";
        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } catch (\Throwable $th) {
        error_log('Lỗi khi hiển thị chi tiết dữ liệu: ' . $th->getMessage());
        return [];
    }
}

}
