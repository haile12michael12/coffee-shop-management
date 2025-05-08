<?php

namespace App\Controllers;

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        $viewPath = __DIR__ . "/../../views/{$view}.php";
        
        if (file_exists($viewPath)) {
            ob_start();
            require $viewPath;
            return ob_get_clean();
        }
        
        throw new \Exception("View {$view} not found");
    }

    protected function json($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }

    protected function validate($data, $rules) {
        $errors = [];
        
        foreach ($rules as $field => $rule) {
            if (strpos($rule, 'required') !== false && empty($data[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }
        
        return $errors;
    }
} 