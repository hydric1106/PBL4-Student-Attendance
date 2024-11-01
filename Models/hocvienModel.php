<?php
include_once '../dbconnect.php';

class HocVienModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getAllStudents() {
        $sql = "SELECT ID, Ten, GioiTinh, Email, ID_Lop FROM hocvien";
        $result = $this->conn->query($sql);

        $hocvienList = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hocvienList[] = $row;
            }
        }
        return $hocvienList;
    }

    public function getStudentsByLevel($level) {
        $sql = "SELECT ID, Ten, GioiTinh, Email, ID_Lop FROM hocvien WHERE ID_CapDo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $level);
        $stmt->execute();
        $result = $stmt->get_result();

        $hocvienList = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hocvienList[] = $row;
            }
        }
        return $hocvienList;
    }
}
?>
