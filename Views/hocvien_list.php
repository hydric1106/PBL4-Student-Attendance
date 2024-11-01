<?php
include '../header.php';
include '../sidebar.php';

include '../dbconnect.php';

?>

<div class="main">
    <nav class="nav navbar navbartoggle">
        <span id="togglebar" class="iconNavbar icon fas fa-bars"></span>
        <span>Admin</span>
    </nav>

    <div class="main-content">
        <div id="formMaincontent" class="form-container container-lg">
            <div class="title">
                <h2>Overview</h2>
            </div>
            <div class="stats">
                <a id="cardn1" href="#" class="stat" data-level="1">
                    <span>N1</span>
                    <h3>150</h3>
                    <p>Học viên</p>
                </a>
                <a id="cardn2" href="#" class="stat" data-level="2">
                    <span>N2</span>
                    <h3>150</h3>
                    <p>Học viên</p>
                </a>
                <a id="cardn3" href="#" class="stat" data-level="3">
                    <span>N3</span>
                    <h3>150</h3>
                    <p>Học viên</p>
                </a>
            </div>
            <div class="stats the2">
                <a id="cardn4" href="#" class="stat" data-level="4">
                    <span>N4</span>
                    <h3>150</h3>
                    <p>Học viên</p>
                </a>
                <a id="cardn5" href="#" class="stat" data-level="5">
                    <span>N5</span>
                    <h3>150</h3>
                    <p>Học viên</p>
                </a>
            </div>

            <div id="formHS" class="form-container" style="display: none;">
                <div class="title">
                    <h4>Danh sách học viên</h4>
                    <button id="btnThem" class="btnThem btn btn-primary">
                        <i class="icon las la-plus-circle"></i>Thêm mới
                    </button>
                </div>

                <table class="table table-hover" style="margin: 20px 0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Họ và tên</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">Email</th>
                            <th scope="col">Lớp</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="studentList">
                        <?php foreach ($hocvienList as $hocvien): ?>
                            <tr>
                                <th scope="row"><?= $hocvien['ID'] ?></th>
                                <td><?= $hocvien['Ten'] ?></td>
                                <td><?= $hocvien['GioiTinh'] ?></td>
                                <td><?= $hocvien['Email'] ?></td>
                                <td><?= $hocvien['ID_Lop'] ?></td>
                                <td>
                                    <button class="btnEdit" data-id="<?= $hocvien['ID'] ?>" type="button">
                                        <i class="icon1 las la-edit"></i>Sửa
                                    </button>
                                    <button class="btnDelete" data-id="<?= $hocvien['ID'] ?>" type="button">
                                        <i class="icon1 las la-trash"></i>Xóa
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button id="btnDong" type="button" class="btn btnDong">
                    <i class="icon1 las la-sign-out"></i>Đóng
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cards = document.querySelectorAll('.stat');
        cards.forEach(function (card) {
            card.addEventListener('click', function (event) {
                event.preventDefault();
                const level = card.getAttribute('data-level');

                // AJAX request to fetch students by level
                fetch(`hocvienController.php?level=${level}`)
                    .then(response => response.json())
                    .then(data => {
                        const studentList = document.getElementById('studentList');
                        studentList.innerHTML = ''; // Clear previous data

                        // Display the new student data
                        data.forEach(student => {
                            const row = `
                                <tr>
                                    <th scope="row">${student.ID}</th>
                                    <td>${student.Ten}</td>
                                    <td>${student.GioiTinh}</td>
                                    <td>${student.Email}</td>
                                    <td>${student.ID_Lop}</td>
                                    <td>
                                        <button class="btnXem" type="button">
                                            <i class="icon1 iconview las la-info"></i>Xem
                                        </button>
                                    </td>
                                </tr>`;
                            studentList.innerHTML += row;
                        });

                        // Show the student list
                        document.getElementById('formHS').style.display = 'block';
                        document.getElementById('formMaincontent').style.display = 'none';
                    });
            });
        });

        // Close student form
        document.getElementById('btnDong').addEventListener('click', function () {
            document.getElementById('formHS').style.display = 'none';
            document.getElementById('formMaincontent').style.display = 'block';
        });
    });
</script>

<script>
    const cardn1 = document.getElementById('cardn1');
    const btnDong = document.getElementById('btnDong');
    const btnThem = document.getElementById('btnThem');

    const formHS = document.getElementById('formHS');
    const formMaincontent = document.getElementById('formMaincontent');
    const formthem = document.getElementById('formthem');

    cardn1.addEventListener('click', function (event) {
        event.preventDefault();
        formMaincontent.style.display = 'none';
        formHS.style.display = 'block';
    });

    btnDong.addEventListener("click", function (event) {
        event.preventDefault();
        formHS.style.display = "none";
        formMaincontent.style.display = "block";
    });

    btnThem.addEventListener("click", function (event) {
        event.preventDefault();
        formHS.style.display = "none";
        formthem.style.display = "block";
        formMaincontent.style.display = "none";
    });
</script>

<?php include '../footer.php'; ?>
