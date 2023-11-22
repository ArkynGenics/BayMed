<?php

class CartController {
    public static function index() {
        include_once "config/connection.php";
        include_once "function/anticsrf.php";
        session_start();
        if(!isset($_SESSION['user_id'])){
            header("Location: login");
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            if(validateCSRFToken($_POST['csrf_token'])){
                if($_POST['action'] === "delete_cart"){
                    include 'models/CartModel.php';
                    $cartModel = new CartModel($conn);
                    $cartId = $_POST['id'];
                    $cart = $cartModel->viewCart($cartId);
                    if($cart['user_id'] === $_SESSION['user_id']){
                        $success = $cartModel->deleteFromCart($cartId);
                        if($success){
                            $_SESSION['success_message'] = "Cart Deleted Successfully";
                            header('Location:cart');
                        }
                        else{
                            $_SESSION['error_message'] = "Cart Delete Failed";
                            header('Location:cart');
                        }
                    }
                }
            }else{
                $_SESSION['error_message'] = "CSRF Token Failed";
                header('Location: cart');
            }
        }else{
            include "config/connection.php";
            include "models/CartModel.php";
            generateCSRFToken();
            $cartModel = new CartModel($conn);
            $result = $cartModel->listCart($_SESSION['user_id']);
            include_once 'views/cart.php';
        }
    }

}
?>