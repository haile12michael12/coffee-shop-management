<?php

namespace App\Models; // Optional: Use namespaces if you structure your app this way

use PDO;
use PDOException;

class Admin extends Model {
    protected $table = 'admins';

    private $db;

    /**
     * Constructor to receive the database connection.
     * @param PDO $db The PDO database connection instance.
     */
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Fetches an admin user by email.
     *
     * @param string $email The admin's email address.
     * @return mixed Associative array of admin data if found, false otherwise.
     */
    public function getAdminByEmail(string $email) {
        try {
            // Ensure your admin table is named 'admins' and has 'email' and 'password' columns
            $query = "SELECT * FROM admins WHERE email = :email LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error appropriately in a real application
            error_log("Error fetching admin by email: " . $e->getMessage());
            return false;
        }
    }

    public function authenticate($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }
        return false;
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // You can add other methods here like:
    // public function createAdmin(...) { ... }
    // public function updateAdmin(...) { ... }
    // public function deleteAdmin(...) { ... }
}