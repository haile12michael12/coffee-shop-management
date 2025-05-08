<?php

namespace App\Controllers\Auth; // Optional: Use namespaces

// Use statements if using namespaces
use App\Models\Admin;
use PDO;

// Start session if not already started (best done in a central bootstrap/index file)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include necessary files if not using an autoloader or framework
// require_once __DIR__ . '/../../../config/database.php'; // $conn should be available
// require_once __DIR__ . '/../../Models/Admin.php';
// require_once __DIR__ . '/../../../config/constants.php'; // For BASE_URL/ADMIN_URL

class AdminAuthController {
    private $adminModel;

    /**
     * Constructor
     * @param PDO $db Database connection
     */
    public function __construct(PDO $db) {
        // If using namespaces: $this->adminModel = new \App\Models\Admin($db);
        $this->adminModel = new Admin($db);
    }

    /**
     * Shows the admin login form view.
     * In a real MVC setup, this would load the view file.
     * For simplicity here, we assume the view file is accessed directly via URL.
     */
    public function showLoginForm() {
        // Logic to display the login form view
        // Example: include __DIR__ . '/../../../App/View/admin/admins/login-admins.php';
        // This method might not be explicitly called if the view is accessed directly.
        // Ensure BASE_URL is available in the view for the form action.
        header("Location: " . (defined('ADMIN_URL') ? ADMIN_URL : '/admin') . "/admins/login-admins.php");
        exit();
    }

    /**
     * Handles the admin login form submission.
     */
    public function handleLogin() {
        // Ensure this runs only on POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submit'])) {
             // Redirect back to login if not a valid submission
             $this->redirectBackToLogin();
        }

        // Basic validation
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $errorMessage = '';

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "Valid email is required.";
        } elseif (empty($password)) {
            $errorMessage = "Password is required.";
        } else {
            // Attempt to find admin by email
            $admin = $this->adminModel->getAdminByEmail($email);

            // Verify admin exists and password is correct
            // Assumes password in DB is hashed using password_hash()
            if ($admin && password_verify($password, $admin['password'])) {
                // Regenerate session ID for security
                session_regenerate_id(true);

                // Store admin info in session
                $_SESSION['admin_id'] = $admin['id']; // Adjust column name if needed
                $_SESSION['admin_email'] = $admin['email'];
                $_SESSION['admin_name'] = $admin['adminname']; // Adjust column name if needed
                $_SESSION['is_admin_logged_in'] = true; // Flag for checks

                // Redirect to admin dashboard or intended page
                // Make sure ADMIN_URL is defined correctly
                header("Location: " . (defined('ADMIN_URL') ? ADMIN_URL : '/admin') . "/index.php"); // Adjust target as needed
                exit();
            } else {
                // Invalid credentials
                $errorMessage = "Invalid email or password.";
            }
        }

        // If login fails, store error in session and redirect back
        $_SESSION['login_error'] = $errorMessage;
        $this->redirectBackToLogin();
    }

     /**
     * Handles admin logout.
     */
    public function logout() {
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
        // Redirect to the public home page or admin login page
        header("Location: " . (defined('BASE_URL') ? BASE_URL : '/') . "/admin/admins/login-admins.php");
        exit();
    }

    /**
     * Helper to redirect back to the login page.
     */
    private function redirectBackToLogin() {
        // Make sure ADMIN_URL is defined correctly
         header("Location: " . (defined('ADMIN_URL') ? ADMIN_URL : '/admin') . "/admins/login-admins.php");
         exit();
    }
}

// How this controller is instantiated and its methods called depends heavily
// on your application's entry point (e.g., index.php) and routing mechanism.
// You might need a dedicated script (e.g., /admin/login-process.php)
// or integrate it into your existing router in public/index.php.

/*
// --- Example of how to use it in a simple processing script (e.g., admin-login-handler.php) ---
require_once __DIR__ . '/../../../config/database.php'; // Provides $conn
require_once __DIR__ . '/../../Models/Admin.php';       // The Admin model class
require_once __DIR__ . '/AdminAuthController.php'; // This controller class

if ($conn) { // Ensure connection exists
    $authController = new \App\Controllers\Auth\AdminAuthController($conn); // Use namespace if applicable
    $authController->handleLogin();
} else {
    // Handle database connection error
    $_SESSION['login_error'] = "Database connection failed.";
    header("Location: " . (defined('ADMIN_URL') ? ADMIN_URL : '/admin') . "/admins/login-admins.php");
    exit();
}
*/