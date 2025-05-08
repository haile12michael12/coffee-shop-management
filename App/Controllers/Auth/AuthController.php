<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Session;
use App\Core\Validator;

class AuthController {
    private $userModel;
    private $session;

    public function __construct() {
        $this->userModel = new User();
        $this->session = new Session();
    }

    public function loginForm() {
        // If user is already logged in, redirect to dashboard
        if ($this->session->isLoggedIn()) {
            header('Location: /dashboard');
            exit;
        }
        
        require_once 'App/Views/auth/login.php';
    }

    public function login() {
        $validator = new Validator();
        
        // Validate input
        $validator->validate($_POST, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            $error = $validator->getErrors();
            require_once 'App/Views/auth/login.php';
            return;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $remember = isset($_POST['remember_me']);

        // Attempt to login
        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $this->session->set('user_id', $user['id']);
            $this->session->set('user_role', $user['role']);
            
            // Set remember me cookie if requested
            if ($remember) {
                $token = bin2hex(random_bytes(32));
                $this->userModel->storeRememberToken($user['id'], $token);
                setcookie('remember_token', $token, time() + (86400 * 30), '/'); // 30 days
            }

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header('Location: /admin');
            } else {
                header('Location: /dashboard');
            }
            exit;
        }

        $error = 'Invalid email or password';
        require_once 'App/Views/auth/login.php';
    }

    public function registerForm() {
        if ($this->session->isLoggedIn()) {
            header('Location: /dashboard');
            exit;
        }
        
        require_once 'App/Views/auth/register.php';
    }

    public function register() {
        $validator = new Validator();
        
        // Validate input
        $validator->validate($_POST, [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'terms' => ['required']
        ]);

        if ($validator->fails()) {
            $error = $validator->getErrors();
            require_once 'App/Views/auth/register.php';
            return;
        }

        // Create user
        $userData = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'role' => 'customer' // Default role
        ];

        if ($this->userModel->create($userData)) {
            // Auto login after registration
            $user = $this->userModel->findByEmail($_POST['email']);
            $this->session->set('user_id', $user['id']);
            $this->session->set('user_role', $user['role']);
            
            header('Location: /dashboard');
            exit;
        }

        $error = 'Registration failed. Please try again.';
        require_once 'App/Views/auth/register.php';
    }

    public function logout() {
        // Clear session
        $this->session->destroy();
        
        // Clear remember me cookie if exists
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
        }
        
        header('Location: /login');
        exit;
    }

    public function forgotPassword() {
        // TODO: Implement forgot password functionality
        require_once 'App/Views/auth/forgot-password.php';
    }

    public function resetPassword() {
        // TODO: Implement password reset functionality
        require_once 'App/Views/auth/reset-password.php';
    }
}