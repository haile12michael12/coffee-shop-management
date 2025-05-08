<?php

namespace App\Models;

class Booking extends Model {
    protected $table = 'bookings';

    public function getByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getByStatus($status) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE status = :status ORDER BY created_at DESC");
        $stmt->execute(['status' => $status]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateStatus($bookingId, $status) {
        return $this->update($bookingId, ['status' => $status]);
    }

    public function getBookingsByDate($date) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE date = :date ORDER BY time ASC");
        $stmt->execute(['date' => $date]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function checkAvailability($date, $time) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM {$this->table} 
            WHERE date = :date AND time = :time AND status != 'Cancelled'
        ");
        $stmt->execute([
            'date' => $date,
            'time' => $time
        ]);
        return $stmt->fetch(\PDO::FETCH_ASSOC)['count'] < 5; // Assuming max 5 bookings per time slot
    }
}
