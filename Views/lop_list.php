    <!-- lop_list.php -->
    <?php
    include '../header.php';
    include '../sidebar.php';
    include '../dbconnect.php'; 

    $capDoMapping = [
        1 => 'N1',
        2 => 'N2',
        3 => 'N3',
        4 => 'N4',
        5 => 'N5',
    ];


    $sql = "SELECT ID, TenLop, ID_CapDo FROM lop";
    $result = $conn->query($sql);

    $lops = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $lops[] = $row;
        }
    }

    $conn->close();
    ?>

    <div id="formMaincontent" class="form-container container-lg">
        <div class="title">
            <h4>Danh sách lớp học</h4>
        </div>

        <!-- Form tìm kiếm -->
        <form class="formSearch" id="formSearch">
            <input type="text" name="query" class="textSearch form-check-label" placeholder="Tìm tên lớp, cấp ..">
            <button class="btnSearch btn btn-outline-primary" type="submit" id="btnTim">
                <i class="icon1 las la-search"></i>Tìm kiếm
            </button>
        </form>

        <!-- Kết quả tìm kiếm -->
        <div id="searchResults">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Lớp</th>
                        <th scope="col">Cấp độ</th>
                        <th scope="col">Danh sách học viên</th>
                    </tr>
                </thead>
                <tbody id="resultTable">
                    <?php
                    if (isset($lops) && count($lops) > 0) { 
                        foreach ($lops as $row) { 
                            echo "<tr>";
                            echo "<th scope='row'>" . $row['ID'] . "</th>";
                            echo "<td>" . $row['TenLop'] . "</td>";
                            echo "<td>" . $capDoMapping[$row['ID_CapDo']] . "</td>";
                            echo "<td><button class='btnHS' data-id='" . $row['ID'] . "' type='button'><i class='icon1 iconedit las la-list'></i></button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript xử lý tìm kiếm -->
    <script>
        document.getElementById('formSearch').addEventListener('submit', function (e) {
            e.preventDefault();
            const query = document.querySelector('input[name="query"]').value;

            fetch('../search_classes.php?query=' + encodeURIComponent(query), {
                method: 'GET',
            })
                .then(response => response.json())
                .then(data => {
                    const resultTable = document.getElementById('resultTable');
                    resultTable.innerHTML = ''; // Xóa kết quả tìm kiếm cũ

                    if (data.length > 0) {
                        data.forEach(row => {
                            resultTable.innerHTML += `
                            <tr>
                                <th scope="row">${row.ID}</th>
                                <td>${row.TenLop}</td>
                                <td>${row.ID_CapDo}</td>
                                <td><button class="btnHS" data-id="${row.ID}" type="button"><i class="icon1 iconedit las la-list"></i></button></td>
                            </tr>
                        `;
                        });
                    } else {
                        resultTable.innerHTML = '<tr><td colspan="4">Không có dữ liệu</td></tr>';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

    <?php include '../footer.php'; ?>