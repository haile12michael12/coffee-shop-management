<?php

namespace App\Models;

class Product extends Model {
    protected $table = 'products';

    public function getByType($type) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE type = :type");
        $stmt->execute(['type' => $type]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function search($query) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE name LIKE :query OR description LIKE :query");
        $stmt->execute(['query' => "%$query%"]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTypes() {
        $stmt = $this->db->prepare("SELECT DISTINCT type FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }
}