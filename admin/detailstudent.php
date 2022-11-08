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
    <title>Trang chi tiết</title>
    <?php
    include "../script.php";
    ?>
</head>

<body>
    <button class="btn btn-primary ms-4 mt-5">
        <a href="studentlist.php" class="text-decoration-none text-light text-capitalize">Xem danh sách sinh viên</a>
    </button>
    <div class="mx-auto" style="max-width:90%">
        <table class="table table-bordered table-striped text-center align-middle bg-light my-5">
            <thead class="text-uppercase text-black lh-lg">
                <tr>
                    <th scope="col" width="15%" class="p-3">Tên sinh viên</th>
                    <th scope="col" width="15%" class="p-3">Mã số sinh viên</th>
                    <th scope="col" width="15%" class="p-3">Lớp</th>
                    <th scope="col" class="p-3">Niên khóa</th>
                    <th scope="col" width="20%" class="p-3">Chuyên ngành</th>
                    <th scope="col" width="20%" class="p-3">Ngày thêm vào</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $studentID = $_GET['detailid'] ?? $_POST['detailid'];
                $sql = sqlSelectAllCondition('students', "id = '$studentID'");
                $students = executeResult($sql);
                // $sql = sqlSelectAll('students');
                if (empty($students)) {
                    error_reporting(0);
                    ini_set('display_errors', 0);
                }
                foreach ($students as $student) {
                    echo '<tr>
                        <td class="text-capitalize p-3">' . $student['name'] . '</td>
                        <td class="text-capitalize p-3">' . $student['stcode'] . '</td>
                        <td class=" p-3 text-uppercase">' . $student['class'] . '</td>
                        <td class=" p-3">
                           ' . $student['yearofStudy'] . '
                        </td>
                        <td class=" p-3 text-capitalize">
                        ' . $student['major'] . '
                        </td>
                        <td class=" p-3">
                        ' . $student['created_at'] . '
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>