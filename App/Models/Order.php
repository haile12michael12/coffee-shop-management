<?php

namespace App\Models;

class Order extends Model {
    protected $table = 'orders';

    public function getByStatus($status) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE status = :status ORDER BY created_at DESC");
        $stmt->execute(['status' => $status]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateStatus($orderId, $status) {
        return $this->update($orderId, ['status' => $status]);
    }

    public function getTotalSales() {
        $stmt = $this->db->prepare("SELECT SUM(total_price) as total FROM {$this->table} WHERE status = 'Delivered'");
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total'] ?? 0;
    }
}