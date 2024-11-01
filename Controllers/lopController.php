<?php
// LopController.php
require_once '/withmvc/Models/lopModel.php';

class lopController
{
    private $model;

    public function __construct()
    {
        $this->model = new lopModel();
    }

    public function showLopList()
    {
        $lops = $this->model->getAllLop();
        $capDoMapping = $this->model->getCapDoMapping();
        include 'Views/lop_list.php'; // Gọi view để hiển thị
    }


    public function searchLop($query)
    {
        $lops = $this->model->searchLop($query);
        $result = [];
        while ($row = $lops->fetch_assoc()) {
            $result[] = $row;
        }
        echo json_encode($result);
    }

    public function __destruct()
    {
        $this->model->close();
    }
}
?>