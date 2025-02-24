<?php

namespace Src\Models\Client;

use Src\Models\BaseModel;

class UserModel extends BaseModel
{
    protected $table = "users";
    protected $id = "id";

    public function registerUser($data)
    {
        if ($this->isUserExists($data['email'], $data['phone'])) {
            return false;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        return $this->create($data);
    }

    public function updateUserInfo($userId, $data)
    {
        unset($data['id'], $data['password'], $data['created_at'], $data['updated_at']);

        if (empty($data)) {
            return false;
        }

        return $this->update($userId, $data);
    }

    public function isUserExists($email = null, $phone = null)
    {
        if (!$email && !$phone) {
            return false;
        }

        $sql = "SELECT * FROM $this->table WHERE ";
        $params = [];
        $types = "";

        if ($email) {
            $sql .= "email = ?";
            $params[] = $email;
            $types .= "s";
        }

        if ($phone) {
            if (!empty($params)) {
                $sql .= " OR ";
            }
            $sql .= "phone = ?";
            $params[] = $phone;
            $types .= "s";
        }

        $conn = $this->_conn->MySQLi();
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Lỗi truy vấn SQL: " . $conn->error);
        }

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $result;
    }




    public function loginUser($email, $password)
    {
        $user = $this->isUserExists($email);

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user['password']) || md5($password) === $user['password']) {
            return $user;
        }

        return false;
    }


    public function changePassword($userId, $newPassword)
    {
        $hashPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        return $this->update($userId, ['password' => $hashPassword]);
    }
}
