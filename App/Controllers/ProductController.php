<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    public function index() {
        $search = $_GET['search'] ?? '';
        $categoryId = $_GET['category'] ?? null;

        $products = $search 
            ? $this->productModel->search($search)
            : ($categoryId 
                ? $this->productModel->getByCategory($categoryId)
                : $this->productModel->all());

        $categories = $this->categoryModel->all();

        return $this->view('products/index', [
            'products' => $products,
            'categories' => $categories,
            'search' => $search,
            'selectedCategory' => $categoryId
        ]);
    }

    public function show($id) {
        $product = $this->productModel->find($id);
        if (!$product) {
            $this->setFlashMessage('Product not found', 'danger');
            return $this->redirect('/products');
        }

        return $this->view('products/show', [
            'product' => $product,
            'title' => $product['name'] . ' - Product Details'
        ]);
    }

    public function create() {
        $categories = $this->categoryModel->all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'category_id' => $_POST['category_id'],
                'stock_quantity' => $_POST['stock_quantity']
            ];

            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/uploads/products/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $data['image'] = '/uploads/products/' . $fileName;
                }
            }

            $errors = $this->validate($data, [
                'name' => 'required',
                'price' => 'required',
                'category_id' => 'required'
            ]);

            if (empty($errors)) {
                $this->productModel->create($data);
                $this->setFlashMessage('Product created successfully', 'success');
                return $this->redirect('/products');
            }

            return $this->view('products/create', [
                'errors' => $errors,
                'data' => $data,
                'categories' => $categories,
                'title' => 'Create New Product'
            ]);
        }

        return $this->view('products/create', [
            'categories' => $categories,
            'title' => 'Create New Product'
        ]);
    }

    public function edit($id) {
        $product = $this->productModel->find($id);
        if (!$product) {
            $this->setFlashMessage('Product not found', 'danger');
            return $this->redirect('/products');
        }

        $categories = $this->categoryModel->all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'category_id' => $_POST['category_id'],
                'stock_quantity' => $_POST['stock_quantity']
            ];

            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/uploads/products/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    // Delete old image if exists
                    if (!empty($product['image'])) {
                        $oldFile = __DIR__ . '/../../public' . $product['image'];
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
                    $data['image'] = '/uploads/products/' . $fileName;
                }
            }

            $errors = $this->validate($data, [
                'name' => 'required',
                'price' => 'required',
                'category_id' => 'required'
            ]);

            if (empty($errors)) {
                $this->productModel->update($id, $data);
                $this->setFlashMessage('Product updated successfully', 'success');
                return $this->redirect('/products');
            }

            return $this->view('products/edit', [
                'errors' => $errors,
                'product' => array_merge($product, $data),
                'categories' => $categories,
                'title' => 'Edit Product'
            ]);
        }

        return $this->view('products/edit', [
            'product' => $product,
            'categories' => $categories,
            'title' => 'Edit Product'
        ]);
    }

    public function delete($id) {
        $product = $this->productModel->find($id);
        if (!$product) {
            $this->setFlashMessage('Product not found', 'danger');
            return $this->redirect('/products');
        }

        // Delete product image if exists
        if (!empty($product['image'])) {
            $imageFile = __DIR__ . '/../../public' . $product['image'];
            if (file_exists($imageFile)) {
                unlink($imageFile);
            }
        }

        $this->productModel->delete($id);
        $this->setFlashMessage('Product deleted successfully', 'success');
        return $this->redirect('/products');
    }

    private function setFlashMessage($message, $type = 'info') {
        $_SESSION['flash_message'] = [
            'message' => $message,
            'type' => $type
        ];
    }
} 