<?php

namespace App\Core;

class View {
    private $layout = 'default';

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function render($view, $data = []) {
        // Extract data to make variables available in view
        extract($data);

        // Start output buffering
        ob_start();
        
        // Include the view file
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            throw new \Exception("View file not found: {$viewFile}");
        }
        
        // Get the contents of the buffer
        $content = ob_get_clean();

        // Include the layout
        $layoutFile = __DIR__ . '/../Views/layouts/' . $this->layout . '.php';
        if (file_exists($layoutFile)) {
            require $layoutFile;
        } else {
            throw new \Exception("Layout file not found: {$layoutFile}");
        }
    }

    public function partial($view, $data = []) {
        extract($data);
        
        $viewFile = __DIR__ . '/../Views/partials/' . $view . '.php';
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            throw new \Exception("Partial view file not found: {$viewFile}");
        }
    }

    public function escape($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
} 