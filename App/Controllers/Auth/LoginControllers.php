<?php
session_start();
require '../config/config.php';
require '../models/UserModel.php';

class LoginController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function login($email, $password) {
        if (empty($email) || empty($password)) {
            return "One or more inputs are empty.";
        }

        $user = $this->userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];
            header("Location: " . APPURL);
            exit();
        } else {
            return "Invalid email or password.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new LoginController($conn);
    $error = $controller->login($_POST['email'], $_POST['password']);
}