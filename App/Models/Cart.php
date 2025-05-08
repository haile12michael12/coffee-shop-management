<?php

namespace App\Models;

class Cart extends Model {
    protected $table = 'cart';

    public function getByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addItem($data) {
        // Check if item already exists in cart
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id AND pro_id = :pro_id");
        $stmt->execute([
            'user_id' => $data['user_id'],
            'pro_id' => $data['pro_id']
        ]);
        $existingItem = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($existingItem) {
            // Update quantity if item exists
            return $this->update($existingItem['id'], [
                'quantity' => $existingItem['quantity'] + $data['quantity']
            ]);
        }

        // Create new cart item if it doesn't exist
        return $this->create($data);
    }

    public function updateQuantity($cartId, $quantity) {
        return $this->update($cartId, ['quantity' => $quantity]);
    }

    public function clearCart($userId) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE user_id = :user_id");
        return $stmt->execute(['user_id' => $userId]);
    }

    public function getCartTotal($userId) {
        $stmt = $this->db->prepare("
            SELECT SUM(price * quantity) as total 
            FROM {$this->table} 
            WHERE user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total'] ?? 0;
    }
}
