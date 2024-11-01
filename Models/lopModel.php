<?php
// LopModel.php
include_once '../dbconnect.php';

class lopModel
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }


    public function getAllLop()
    {
        $sql = "SELECT ID, TenLop, ID_CapDo FROM lop";
        $result = $this->conn->query($sql);

        // Kiểm tra nếu có lỗi
        if (!$result) {
            throw new Exception("Query failed: " . $this->conn->error);
        }


        return $result; // Trả về kết quả truy vấn
    }

    public function getCapDoMapping()
    {
        return [
            1 => 'N1',
            2 => 'N2',
            3 => 'N3',
            4 => 'N4',
            5 => 'N5'
        ];
    }

    public function searchLop($query)
    {
        $stmt = $this->conn->prepare("SELECT ID, TenLop, ID_CapDo FROM lop WHERE TenLop LIKE ? OR ID_CapDo LIKE ?");
        $searchQuery = "%" . $query . "%";
        $stmt->bind_param("ss", $searchQuery, $searchQuery);
        $stmt->execute();
        return $stmt->get_result();
    }


    public function close()
    {
        $this->conn->close();
    }
}
