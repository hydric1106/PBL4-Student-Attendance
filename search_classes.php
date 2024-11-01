<?php
include('dbconnect.php');

if (isset($_GET['query'])) {
    $query = '%' . $conn->real_escape_string($_GET['query']) . '%';
    $sql = "SELECT ID, TenLop, ID_CapDo FROM lop WHERE TenLop LIKE ? OR ID_CapDo LIKE ?";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(["error" => "Lỗi chuẩn bị truy vấn SQL: " . $conn->error]);
        exit;
    }
    
    $stmt->bind_param("ss", $query, $query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if (!$result) {
        echo json_encode(["error" => "Lỗi khi thực hiện truy vấn: " . $stmt->error]);
        exit;
    }
    
    $classes = [];
    while ($row = $result->fetch_assoc()) {
        $classes[] = $row;
    }
    
    echo json_encode($classes); // Trả dữ liệu dưới dạng JSON
} else {
    echo json_encode([]); // Trả về mảng rỗng nếu không có query
}

$conn->close();
