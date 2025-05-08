<?php

namespace App\Models;

class Category extends Model {
    protected $table = 'categories';

    public function getWithProductCount() {
        $stmt = $this->db->prepare("
            SELECT c.*, COUNT(p.id) as product_count 
            FROM {$this->table} c 
            LEFT JOIN products p ON c.id = p.category_id 
            GROUP BY c.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getWithProducts() {
        $stmt = $this->db->prepare("
            SELECT c.*, p.* 
            FROM {$this->table} c 
            LEFT JOIN products p ON c.id = p.category_id 
            ORDER BY c.name, p.name
        ");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
} 