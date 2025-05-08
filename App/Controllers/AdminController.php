<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Core\Session;
use App\Core\Validator;

class AdminController {
    private $userModel;
    private $productModel;
    private $orderModel;
    private $categoryModel;
    private $session;

    public function __construct() {
        // Check if user is admin
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $this->userModel = new User();
        $this->productModel = new Product();
        $this->orderModel = new Order();
        $this->categoryModel = new Category();
        $this->session = new Session();
    }

    public function dashboard() {
        // Get dashboard statistics
        $stats = [
            'total_users' => $this->userModel->count(),
            'total_products' => $this->productModel->count(),
            'total_orders' => $this->orderModel->count(),
            'recent_orders' => $this->orderModel->getRecent(5),
            'top_products' => $this->productModel->getTopSelling(5),
            'revenue' => $this->orderModel->getTotalRevenue()
        ];

        require_once 'App/Views/admin/dashboard.php';
    }

    // Product Management
    public function products() {
        $products = $this->productModel->getAll();
        require_once 'App/Views/admin/products/index.php';
    }

    public function createProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new Validator();
            $validator->validate($_POST, [
                'name' => ['required', 'min:3'],
                'description' => ['required'],
                'price' => ['required', 'numeric'],
                'category_id' => ['required', 'numeric']
            ]);

            if ($validator->fails()) {
                $error = $validator->getErrors();
                require_once 'App/Views/admin/products/create.php';
                return;
            }

            // Handle image upload
            $image = $_FILES['image'] ?? null;
            $imagePath = null;
            if ($image && $image['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->handleImageUpload($image);
            }

            $productData = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'category_id' => $_POST['category_id'],
                'image' => $imagePath,
                'status' => $_POST['status'] ?? 'active'
            ];

            if ($this->productModel->create($productData)) {
                $this->session->setFlash('success', 'Product created successfully');
                header('Location: /admin/products');
                exit;
            }

            $error = 'Failed to create product';
        }

        $categories = $this->categoryModel->getAll();
        require_once 'App/Views/admin/products/create.php';
    }

    public function editProduct($id) {
        $product = $this->productModel->findById($id);
        
        if (!$product) {
            $this->session->setFlash('error', 'Product not found');
            header('Location: /admin/products');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new Validator();
            $validator->validate($_POST, [
                'name' => ['required', 'min:3'],
                'description' => ['required'],
                'price' => ['required', 'numeric'],
                'category_id' => ['required', 'numeric']
            ]);

            if ($validator->fails()) {
                $error = $validator->getErrors();
                require_once 'App/Views/admin/products/edit.php';
                return;
            }

            // Handle image upload
            $image = $_FILES['image'] ?? null;
            $imagePath = $product['image'];
            if ($image && $image['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->handleImageUpload($image);
            }

            $productData = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'category_id' => $_POST['category_id'],
                'image' => $imagePath,
                'status' => $_POST['status'] ?? 'active'
            ];

            if ($this->productModel->update($id, $productData)) {
                $this->session->setFlash('success', 'Product updated successfully');
                header('Location: /admin/products');
                exit;
            }

            $error = 'Failed to update product';
        }

        $categories = $this->categoryModel->getAll();
        require_once 'App/Views/admin/products/edit.php';
    }

    public function deleteProduct($id) {
        if ($this->productModel->delete($id)) {
            $this->session->setFlash('success', 'Product deleted successfully');
        } else {
            $this->session->setFlash('error', 'Failed to delete product');
        }
        header('Location: /admin/products');
        exit;
    }

    // Order Management
    public function orders() {
        $orders = $this->orderModel->getAll();
        require_once 'App/Views/admin/orders/index.php';
    }

    public function viewOrder($id) {
        $order = $this->orderModel->findById($id);
        if (!$order) {
            $this->session->setFlash('error', 'Order not found');
            header('Location: /admin/orders');
            exit;
        }
        require_once 'App/Views/admin/orders/view.php';
    }

    public function updateOrderStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? '';
            if ($this->orderModel->updateStatus($id, $status)) {
                $this->session->setFlash('success', 'Order status updated successfully');
            } else {
                $this->session->setFlash('error', 'Failed to update order status');
            }
        }
        header('Location: /admin/orders');
        exit;
    }

    // User Management
    public function users() {
        $users = $this->userModel->getAll();
        require_once 'App/Views/admin/users/index.php';
    }

    public function editUser($id) {
        $user = $this->userModel->findById($id);
        
        if (!$user) {
            $this->session->setFlash('error', 'User not found');
            header('Location: /admin/users');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new Validator();
            $validator->validate($_POST, [
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email'],
                'role' => ['required', 'in:admin,staff,customer']
            ]);

            if ($validator->fails()) {
                $error = $validator->getErrors();
                require_once 'App/Views/admin/users/edit.php';
                return;
            }

            $userData = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'role' => $_POST['role']
            ];

            if ($this->userModel->update($id, $userData)) {
                $this->session->setFlash('success', 'User updated successfully');
                header('Location: /admin/users');
                exit;
            }

            $error = 'Failed to update user';
        }

        require_once 'App/Views/admin/users/edit.php';
    }

    public function deleteUser($id) {
        if ($this->userModel->delete($id)) {
            $this->session->setFlash('success', 'User deleted successfully');
        } else {
            $this->session->setFlash('error', 'Failed to delete user');
        }
        header('Location: /admin/users');
        exit;
    }

    // Helper Methods
    private function handleImageUpload($file) {
        $uploadDir = 'public/uploads/products/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = uniqid() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $targetPath;
        }

        return null;
    }
} 