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
        include "config/connection.php";
        include "models/MedicineModel.php";
        $medicineModel = new MedicineModel($conn);
        $medicine = $medicineModel->getMedicine($_GET['id']);
        include_once 'views/medicine.php';
    }

}
?>