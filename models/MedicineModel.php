<?php

class MedicineModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function listMedicine(){
        $sql = "SELECT id,name, price, quantity,file_path FROM medicines";
        $result = $this->conn->query($sql);
        if ($result) {
            return $result;
        }
    }
    public function searchMedicine($search){
        $sql = "SELECT id,name, price, quantity,file_path FROM medicines WHERE name LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $searchTerm = "%$search%";
        $stmt->bind_param('s',$searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getMedicine($id){
        $stmt = $this->conn->prepare("SELECT * FROM medicines where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $medicine = $result->fetch_assoc();
        return $medicine;
    }
}

?>