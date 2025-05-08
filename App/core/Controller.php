<?php

namespace App\Core;

class Controller {
    protected $db;
    protected $view;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->view = new View();
    }

    protected function render($view, $data = []) {
        return $this->view->render($view, $data);
    }

    protected function redirect($url) {
        header("Location: " . $url);
        exit;
    }

    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGet() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    protected function getPost($key = null) {
        if ($key === null) {
            return $_POST;
        }
        return $_POST[$key] ?? null;
    }

    protected function getQuery($key = null) {
        if ($key === null) {
            return $_GET;
        }
        return $_GET[$key] ?? null;
    }

    protected function requireAuth() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
    }

    protected function requireAdmin() {
        if (!isset($_SESSION['admin_id'])) {
            $this->redirect('/admin/login');
        }
    }

    public function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
}
?>