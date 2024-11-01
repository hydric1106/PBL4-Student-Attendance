<?php

include '/withmvc/Models/hocvienModel.php';

class HocVienController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new HocVienModel($dbConnection);
    }

    public function listStudents() {
        $hocvienList = $this->model->getAllStudents();
        include '../Views/hocvien_list.php';
    }

    public function listStudentsByLevel($level) {
        $hocvienList = $this->model->getStudentsByLevel($level);
        echo json_encode($hocvienList);
        exit;
    }
}

// Xử lý yêu cầu
$dbConnection = new mysqli('localhost', 'root', '', 'pbl4'); // Replace with your actual database credentials
$controller = new HocVienController($dbConnection);

if (isset($_GET['level'])) {
    $level = intval($_GET['level']);
    echo json_encode($controller->getStudentsByLevel($level));
    exit;
}

$hocvienList = $controller->listStudents();
?>
