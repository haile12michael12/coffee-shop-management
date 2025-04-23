<?php
class Booking {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($data) {
        try {
            $stmt = $this->conn->prepare("
                INSERT INTO bookings 
                (first_name, last_name, date, time, phone, message, user_id)
                VALUES 
                (:first_name, :last_name, :date, :time, :phone, :message, :user_id)
            ");
            
            return $stmt->execute([
                ':first_name' => $data['first_name'],
                ':last_name' => $data['last_name'],
                ':date' => $data['date'],
                ':time' => $data['time'],
                ':phone' => $data['phone'],
                ':message' => $data['message'],
                ':user_id' => $data['user_id']
            ]);
            
        } catch(PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>