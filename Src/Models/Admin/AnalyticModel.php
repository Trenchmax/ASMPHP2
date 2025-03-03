<?php

namespace Src\Models\Admin;

use Src\Models\BaseModel;

class AnalyticModel extends BaseModel {
    protected $table = 'users';

    public function getTotalUsers() {
        $sql = "SELECT COUNT(*) AS total FROM users";
        $stmt = $this->_conn->MySQLi()->query($sql);
        return $stmt->fetch_assoc()['total'] ?? 0;
    }

    public function getTotalOrders() {
        $sql = "SELECT COUNT(*) AS total FROM orders";
        $stmt = $this->_conn->MySQLi()->query($sql);
        return $stmt->fetch_assoc()['total'] ?? 0;
    }

    public function getTotalBrands() {
        $sql = "SELECT COUNT(*) AS total FROM brands"; 
        $stmt = $this->_conn->MySQLi()->query($sql);
        return $stmt->fetch_assoc()['total'] ?? 0;
    }

    public function getProductCategories() {
        $sql = "SELECT category.name, COUNT(products.id) AS count 
                FROM categories AS category 
                LEFT JOIN products ON category.id = products.category_id 
                GROUP BY category.id";
        $stmt = $this->_conn->MySQLi()->query($sql);
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function getTopCommentedProducts() {
        $sql = "SELECT products.name, COUNT(comments.id) AS count 
                FROM products 
                LEFT JOIN comments ON products.id = comments.product_id 
                GROUP BY products.id 
                ORDER BY count DESC 
                LIMIT 5";
        $stmt = $this->_conn->MySQLi()->query($sql);
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
}
