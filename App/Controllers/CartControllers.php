<?php
session_start();
require '../config/config.php';
require '../models/CartModel.php';

class CartController {
    private $cartModel;

    public function __construct($db) {
        $this->cartModel = new CartModel($db);
    }

    public function showCart() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . APPURL);
            exit();
        }

        $products = $this->cartModel->getCartProducts($_SESSION['user_id']);
        $cartTotal = $this->cartModel->getCartTotal($_SESSION['user_id']);

        return [
            'products' => $products,
            'cartTotal' => $cartTotal
        ];
    }

    public function proceedToCheckout($totalPrice) {
        $_SESSION['total_price'] = $totalPrice;
        header("Location: checkout.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $controller = new CartController($conn);
    $controller->proceedToCheckout($_POST['total_price']);
}
