<?php

namespace App\Models;

use System\Model;
/* ========================
 * Model: CartModel.php
 * ======================== */
class CartModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getCartProducts($userId) {
        $query = $this->db->prepare("SELECT * FROM cart WHERE user_id = :user_id");
        $query->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCartTotal($userId) {
        $query = $this->db->prepare("SELECT SUM(quantity * price) AS total FROM cart WHERE user_id = :user_id");
        $query->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
}