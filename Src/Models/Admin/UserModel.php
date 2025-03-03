<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;

class UserModel extends BaseModel
{
    protected $table = 'Users';
    protected $id = 'id';

    public function createUser($data)
    {

        return $this->create($data);
    }

    public function showAll()
    {
        $result = [];
        try {
            $sql = "SELECT * FROM $this->table ORDER BY created_at DESC";
            $result = $this->_conn->MySQLi()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            error_log('Lỗi khi hiển thị tất cả dữ liệu: ' . $th->getMessage());
            return $result;
        }
    }

    public function getOneUser($id)
    {
        return $this->getOne($id);
    }

    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getAllActiveUsers()
    {
        return $this->getAllByStatus();
    }

    public function deleteUser($id)
    {
        return $this->delete($id);
    }

    public function getDuplicateFields($email = null, $phone = null)
    {
        if (!$email && !$phone) {
            return [];
        }

        $sql = "SELECT email, phone FROM $this->table WHERE ";
        $params = [];
        $types = [];
        $conditions = [];

        if ($email) {
            $conditions[] = "email = ?";
            $params[] = $email;
            $types[] = "s";
        }

        if ($phone) {
            $conditions[] = "phone = ?";
            $params[] = $phone;
            $types[] = "s";
        }

        $sql .= implode(" OR ", $conditions);

        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Lỗi truy vấn SQL: " . $conn->error);
        }

        if (!empty($params)) {
            $stmt->bind_param(implode("", $types), ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $result ?: [];
    }
}
