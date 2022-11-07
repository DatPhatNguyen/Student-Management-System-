<?php
session_start();
include "./config/connect.php";
include "./config/functionStatement.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách cán bộ</title>
    <?php include "../script.php"; ?>
</head>

<body>
    <?php include "template/header.php"; ?>
    <div class="row mx-auto my-5 shadow " style="max-width:95%;border-radius:30px;">
        <?php include "sidebar.php"; ?>
        <div class="col-lg-10 col-sm-10 col-md-10 p-4">
            <h3 class="text-center  my-5 text-uppercase" style="font-weight:900">Danh sách admin</h3>
            <hr>
            <table class="table table-bordered table-striped text-center align-middle bg-light my-5">
                <thead class="text-uppercase ">
                    <tr>
                        <th scope="col" width="15%" class="p-3">id</th>
                        <th scope="col" width="20%" class="p-3">Tên đăng nhập</th>
                        <th scope="col" width="20%" class="p-3">Ngày thêm vào</th>
                        <th scope="col" width="20%" class="p-3">Xóa / Sửa</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    $sql = sqlSelectAll('admins');
                    $admins = executeResult($sql);
                    if (empty($admins)) {
                        error_reporting(0);
                        ini_set('display_errors', 0);
                    }
                    foreach ($admins as $admin) {
                        echo
                        '<tr>
                            <td class="text-capitalize">' . $admin['id'] . '</td>
                            <td class="p-3">' . $admin['name'] . '</td>
                            <td class="p-3">' . $admin['created_at'] . '</td>
                              <td>
                                    <button class="btn btn-danger btn-custom">
                                        <i class="fa-solid fa-trash"></i>
                                        <a href="deleteadmin.php?deleteadminid=' . $admin['id'] . '"
                                            class="text-white text-decoration-none ms-1">Xóa</a>
                                    </button>
                                    <button class="btn btn-primary btn-custom ms-2">
                                        <i class="fa-solid fa-pencil "></i>
                                        <a href="updateadmin.php?updateadminid=' . $admin['id'] . '"
                                            class="text-white text-decoration-none ms-1">Sửa</a>
                                    </button>
                                </td>
                        </tr>';
                    }
                    // admin's pagination
                    ?>
                </tbody>
            </table>
        </div>
</body>

</html>