<?php
require_once __DIR__.'/../models/Product.php';
require_once __DIR__.'/../models/Review.php';
require_once __DIR__.'/../config/config.php';

class HomeController {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function index() {
        $productModel = new Product($this->conn);
        $reviewModel = new Review($this->conn);

        $allProducts = $productModel->getDrinks();
        $allReviews = $reviewModel->getAllReviews();

        require_once __DIR__.'/../views/home/index.php';
    }
}
?>