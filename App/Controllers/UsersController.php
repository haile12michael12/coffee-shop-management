<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Order;

class UsersController extends Controller {
    private $userModel;
    private $bookingModel;
    private $orderModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
        $this->bookingModel = new Booking();
        $this->orderModel = new Order();
    }

    public function bookings() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APPURL . '/auth/login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $allBookings = $this->bookingModel->getUserBookings($userId);

        // Load the view
        require_once __DIR__ . '/../Views/users/bookings.php';
    }

    public function orders() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APPURL . '/auth/login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $allOrders = $this->orderModel->getUserOrders($userId);

        // Load the view
        require_once __DIR__ . '/../Views/users/Orders.php';
    }

    public function profile() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APPURL . '/auth/login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $user = $this->userModel->findById($userId);

        // Load the view
        require_once __DIR__ . '/../Views/users/profile.php';
    }
} 