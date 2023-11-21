<?php

class MedicineController {
    public static function viewAll() {
        session_start();
        include "config/connection.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            if($_POST['action'] === 'add_to_cart'){
                $cartModel = new CartModel($conn);
                $medicineId = $_POST['medicine_id'];
                $quantity = $_POST['quantity'];
                $success = $cartController->addToCart($medicineId, $_SESSION['user_id'], $quantity);

            }
        }   
        include "models/MedicineModel.php";
        $medicineModel = new MedicineModel($conn);
        $result = $medicineModel->listMedicine();
        include_once 'views/medicines.php';
    }
    public static function viewMedicine() {
        include "config/connection.php";
        include "models/MedicineModel.php";
        $medicineModel = new MedicineModel($conn);
        $medicine = $medicineModel->getMedicine($_GET['id']);
        include_once 'views/medicine.php';
    }

}
?>