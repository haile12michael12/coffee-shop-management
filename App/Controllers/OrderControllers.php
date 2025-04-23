
<?php
require_once __DIR__.'/../models/Order.php';
require_once __DIR__.'/../config/config.php';

class OrdersController {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("location: " . APPURL);
            exit();
        }

        $orderModel = new Order($this->conn);
        $allOrders = $orderModel->getOrdersByUserId($_SESSION['user_id']);

        require_once __DIR__.'/../views/orders/index.php';
    }
}
?>