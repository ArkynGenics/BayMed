<?php

class MedicineController {
    public static function viewAll() {
        session_start();
        include "config/connection.php";
        include "models/MedicineModel.php";
        $medicineModel = new MedicineModel($conn);
        $result = $medicineModel->listMedicine();
        include_once 'views/medicines.php';
    }
    public static function viewMedicine() {
        session_start();
        include "config/connection.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
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
        }   
        else{
            include "models/MedicineModel.php";
            $medicineModel = new MedicineModel($conn);
            $medicine = $medicineModel->getMedicine($_GET['id']);
            include_once 'views/medicine.php';
        }

    }

}
?>