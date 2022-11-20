<?php
session_start();
include "../config/connect.php";
include "../config/functionStatement.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách phụ huynh</title>
    <?php include "../script.php" ?>
</head>

<body>
    <?php include "./template/header.php"; ?>
    <!-- manage -->
    <div class="row mx-auto shadow-lg my-5 border" style="max-width:95%;border-radius:30px">
        <?php
        include "sidebar.php"
        ?>
        <div class="col-lg-10 col-md-10 p-4">
            <h3 class="text-center my-5 text-uppercase" style="font-weight:900">Danh sách phụ huynh
            </h3>
            <hr>
            <table class="table table-bordered table-striped text-center align-middle bg-light  mt-5 mb-3">
                <thead class="text-uppercase text-black lh-lg">
                    <tr>
                        <th scope="col" width="15%" class="p-3">Tên phụ huynh</th>
                        <th scope="col" width="10%" class="p-3">Email</th>
                        <th scope="col" width="10%" class="p-3">Mã số</th>
                        <th scope="col" width="20%" class="p-3">phụ huynh sinh viên</th>
                        <th scope="col" width="15%" class="p-3">Ngày thêm</th>
                        <th scope="col" width="17%" class="p-3">Xóa / Sửa</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    $sql = sqlSelectAll('parents');
                    $result = executeStatement($sql);
                    // lay so hang trong database
                    $numRows = $result->num_rows;
                    $numberRowPerPage = 5; // moi trang chua 5 hang
                    $totalPages = ceil($numRows / $numberRowPerPage); // tong so trang ( 15/5 = 3 trang)
                    $page = $_GET['page'] ?? $_POST['page'] ??  $page = 1;
                    $startingLimit = ($page - 1) * $numberRowPerPage;
                    $sql = "SELECT * FROM `parents` limit $startingLimit  ,  $numberRowPerPage";
                    $parents = executeResult($sql);
                    if (empty($parents)) {
                        error_reporting(0);
                        ini_set('display_errors', 0);
                    }
                    foreach ($parents as $parent) {
                        echo '<tr>
                        <td class="text-capitalize p-3">' . $parent['name'] . '</td>
                        <td class="p-3">' . $parent['email'] . '</td>
                        <td class="text-capitalize p-3">' . $parent['parentcode'] . '</td>  
                        <td class="text-capitalize p-3">' . $parent['parentcode'] . '</td>  
                      
                        <td class="p-3">' . $parent['created_at'] . '</td>
                        </td>
                        <td style="max-width:120px"class=" p-3">
                            <button class="btn btn-danger btn-custom">
                                <i class="fa-solid fa-trash"></i>
                                <a href="deleteParent.php?deleteparentid=' . $parent['parent_id'] . '"
                                    class="text-white text-decoration-none ms-1">Xóa</a>
                            </button>
                            <button class="btn btn-primary btn-custom ms-2">
                                <i class="fa-solid fa-pencil "></i>
                                <a href="updateparent.php?updateparentid=' . $parent['parent_id'] . '"
                                    class="text-white text-decoration-none ms-1">Sửa</a>
                            </button>
                        </td>
                    </tr>';
                    }
                    // parents's pagination
                    ?>
                </tbody>
            </table>
            <?php
            // totalPages = ceil(tong so hang / so luong dong tren hang)
            // totalPages = ceil(15/5 = 3) -> tao 3 nut
            for ($btn = 1; $btn <= $totalPages; $btn++) {
                echo '
                    <button class="btn btn-danger mx-1 my-3">
                    <a class="text-white text-decoration-none" href="parentlist.php?page=' . $btn . '">' . $btn . '</a></a>
                    </button>
                    ';
            }
            ?>
        </div>
</body>

</html>