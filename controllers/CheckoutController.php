<?php

class CheckoutController {
    public static function index() {
        include_once "config/connection.php";
        include_once "function/anticsrf.php";
        session_start();
        if(!isset($_SESSION['user_id'])){
            header("Location: login");
        }
        include 'models/CartModel.php';
        $cartModel = new CartModel($conn);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $success = $cartModel->deleteUserCart($_SESSION['user_id']);
            header('Content-Type: application/json');

            if($success){
                echo json_encode(['success' => true, 'message' => 'Checkout Successful']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Checkout failed']);
            }
            return;
        }
    }
}
?>