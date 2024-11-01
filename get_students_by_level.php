<?php
include 'dbconnect.php';

if (isset($_GET['level'])) {
    $level = intval($_GET['level']); 

    // Truy vấn cơ sở dữ liệu để lấy danh sách học viên theo cấp độ
    $sql = "SELECT ID, Ten, GioiTinh, Email, ID_Lop FROM hocvien WHERE ID_CapDo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $level);
    $stmt->execute();
    $result = $stmt->get_result();

    $hocvienList = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $hocvienList[] = $row; // Thêm từng học viên vào mảng
        }
    }

    echo json_encode($hocvienList); // Trả về dữ liệu dưới dạng JSON
}

$conn->close();
?>
