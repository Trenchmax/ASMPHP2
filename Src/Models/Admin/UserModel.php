<?php
namespace Src\Models\Admin;

use Src\Models\BaseModel;

class UserModel extends BaseModel {
    protected $table = 'Users';
    protected $id = 'id';
    
    public function createUser($data) {
        return $this->create($data);
    }

    public function showAll()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table  ORDER BY created_at DESC";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }
    public function getOneUser($id) {
        return $this->getOne($id);
    }
    public function updateUser($id, $data) {
        return $this->update($id,$data);
    }

    public function getAllActiveUsers() {
        return $this->getAllByStatus();
    }

    public function deleteUser($id) {
        return $this->delete($id);
    } 
}