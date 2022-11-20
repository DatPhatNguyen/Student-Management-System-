<?php
session_start();
include_once "../config/connect.php";
include_once "../config/functionStatement.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
</head>

<body>
    <?php include "template/header.php" ?>
    <!-- manage -->
    <div class="row mx-auto shadow-lg my-5 border" style="max-width:95%;border-radius:30px">
        <?php
        include "sidebar.php"
        ?>
        <div class="col-lg-10 col-sm-10 p-4">
            <h3 class="text-center  my-5 text-uppercase" style="font-weight:900">Danh sách sinh viên</h3>
            <hr>
            <table class="table table-bordered table-striped text-center align-middle bg-light mt-5 mb-3">
                <thead>
                    <tr>
                        <th scope="col" width="15%" class="p-3">Tên sinh viên</th>
                        <th scope="col" width="15%" class="p-3">Mã số sinh viên</th>
                        <th scope="col" width="10%" class="p-3">Lớp</th>
                        <th scope="col" class="p-3" width="15%">Xem Chi tiết</th>
                        <th scope=" col" width="20%" class="p-3">Xóa / Sửa</th>
                        <th scope="col" width="20%" class="p-3">Nhập điểm sinh viên</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // lay cai nay de lay so trang / so hang
                    // VD : num->rows = 10
                    $sql = "SELECT * FROM `students`";
                    $result = executeStatement($sql);
                    // lay so hang trong database
                    $numRows = $result->num_rows;
                    $numberRowPerPage = 5; // moi trang chua 5 hang
                    $totalPages = ceil($numRows / $numberRowPerPage); // tong so trang ( 15/5 = 3 trang)
                    $page = $_GET['page'] ?? $_POST['page'] ??  $page = 1;
                    $startingLimit = ($page - 1) * $numberRowPerPage;
                    $sql = "SELECT * FROM `students` limit $startingLimit  ,  $numberRowPerPage"; // offset
                    $query = executeStatement($sql);
                    // echo '<pre>';
                    // var_dump("limit bat dau: " . $startingLimit, "so dong moi trang: " . $numberRowPerPage);
                    // echo '</pre>';
                    // number page = 5 -> 5 trang
                    // limit 0,5 // bat dau tu 0->5 ( so phia truoc là +5, so phia sau la so luong tren moi trang), 5,5 -> 10,5
                    // echo '<pre>';
                    // var_dump("Tổng trang: " . $totalPages);
                    // echo '</pre>';
                    $students = executeResult($sql);
                    foreach ($students as $student) {
                        echo '<tr>
                    <td class="text-capitalize p-3">' . $student['name'] . '</td>
                    <td class="text-capitalize p-3">' . $student['stcode'] . '</td>
        
                    <td class=" p-3 text-uppercase">' . $student['class'] . '</td>
                    <td class=" p-3">
                            <button class="btn btn-success btn-custom ms-2">
                            <i class="fa-solid fa-circle-info"></i>
                            <a href="detailstudent.php?detailid=' . $student['id'] . '"
                                class="text-white text-decoration-none ms-1">Chi tiết</a>
                            </button>
                    </td>
                    <td class=" p-3">
                        <button class="btn btn-danger btn-custom">
                            <i class="fa-solid fa-trash"></i>
                            <a href="deleteStudent.php?deletestudentid=' . $student['id'] . '"
                                class="text-white text-decoration-none ms-1">Xóa</a>
                        </button>
                        <button class="btn btn-primary btn-custom ms-2">
                            <i class="fa-solid fa-pencil "></i>
                            <a href="updateStudent.php?updatestudentid=' . $student['id'] . '"
                                class="text-white text-decoration-none ms-1">Sửa</a>
                        </button>
                    </td>
                    <td class=" p-3">
                    <button class="btn btn-warning btn-custom ms-2">
                            <i class="fa-solid fa-pencil text-white"></i>
                            <a href="enterScore.php?studentscoreid=' . $student['id'] . '"
                                class="text-white text-decoration-none ms-1">Nhập điểm</a>
                        </button>
                    </td>
                </tr>';
                    }
                    ?>
                </tbody>
            </table>
            <?php
            // totalPages = ceil(tong so hang / so luong dong tren hang)
            // totalPages = ceil(15/5 = 3) -> tao 3 nut
            for ($btn = 1; $btn <= $totalPages; $btn++) {
                echo '
                    <button class="btn btn-danger mx-1 my-3">
                    <a class="text-white text-decoration-none" href="studentlist.php?page=' . $btn . '">' . $btn . '</a></a>
                    </button>
                    ';
            }
            ?>
        </div>
</body>

</html>