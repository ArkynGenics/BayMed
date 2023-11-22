<?php

class MedicineController {
    public static function viewAll() {
        session_start();
        if(!isset($_SESSION['user_id'])){
            header("Location: login");
        }
        include "config/connection.php";
        include "models/MedicineModel.php";
        $medicineModel = new MedicineModel($conn);
        $result = $medicineModel->listMedicine();
        include_once 'views/medicines.php';
    }
    public static function viewMedicine() {
        session_start();
        if(!isset($_SESSION['user_id'])){
            header("Location: login");
        }
        include "config/connection.php";
        include_once 'function/anticsrf.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            if(validateCSRFToken($_POST['csrf_token'])){
                if($_POST['action'] === 'add_to_cart'){
                    include 'models/CartModel.php';
                    $cartModel = new CartModel($conn);
                    $medicineId = $_POST['medicine_id'];
                    $quantity = $_POST['quantity'];
                    $success = $cartModel->addToCart($medicineId, $_SESSION['user_id'], $quantity);
                    if($success){
                        $_SESSION['success_message'] = "Added to Cart Successfully";
                        header('Location:medicine?id='. $medicineId);
                    }
                    else{
                       $_SESSION['error_message'] = "Add to Cart Failed";
                       header('Location:medicine?id='. $medicineId);
                    }
                }
            }else{
                $_SESSION['error_message'] = "CSRF Token Failed";
                header('Location:medicine?id='. $_POST['medicine_id']);
            }
        }   
        else{
            include "models/MedicineModel.php";
            $medicineModel = new MedicineModel($conn);
            $medicine = $medicineModel->getMedicine($_GET['id']);
            generateCSRFToken();
            include_once 'views/medicine.php';
        }

    }

}
?>