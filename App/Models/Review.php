<?php

namespace App\Models;

class Review extends Model {
    protected $table = 'reviews';

    public function getByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = :username ORDER BY created_at DESC");
        $stmt->execute(['username' => $username]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getLatest($limit = 5) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAverageRating() {
        $stmt = $this->db->prepare("SELECT AVG(rating) as average FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC)['average'] ?? 0;
    }
}
