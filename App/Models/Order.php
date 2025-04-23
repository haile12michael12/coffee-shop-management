<?php
class Order {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getOrdersByUserId($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>