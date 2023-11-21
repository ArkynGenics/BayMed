<?php

class CartController {
    public static function index() {
        session_start();
        if(!isset($_SESSION['user_id'])){
            header("Location: login");
        }
        include "config/connection.php";
        include "models/CartModel.php";
        $cartModel = new CartModel($conn);
        $result = $cartModel->listCart($_SESSION['user_id']);
        include_once 'views/cart.php';
    }

}
?>