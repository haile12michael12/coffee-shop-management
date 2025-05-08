<?php

namespace App\Core;

class Router {
    private $routes = [];
    private $params = [];

    public function add($route, $controller, $action = 'index') {
        $this->routes[$route] = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch($url) {
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $action = $this->params['action'];

            $controllerClass = "App\\Controllers\\" . $controller;
            
            if (class_exists($controllerClass)) {
                $controllerObject = new $controllerClass();
                
                if (method_exists($controllerObject, $action)) {
                    return $controllerObject->$action();
                }
            }
        }
        
        // If no route matches, show 404 page
        header("HTTP/1.0 404 Not Found");
        require_once __DIR__ . '/../Views/404.php';
    }

    private function match($url) {
        foreach ($this->routes as $route => $params) {
            $pattern = preg_replace('/\//', '\\/', $route);
            $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $pattern);
            $pattern = '/^' . $pattern . '$/i';

            if (preg_match($pattern, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function getParams() {
        return $this->params;
    }
} 