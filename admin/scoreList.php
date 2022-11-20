<?php
include_once "../config/connect.php";
include_once "../config/functionStatement.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include '../script.php';
    ?>
</head>

<body>
    <?php
    include_once './template/header.php';
    ?>
    <div class="mx-auto my-5" style="max-width:90vw;padding:10px;   ">
        <h2 class="text-center text-uppercase my-5" style="font-weight:900">Danh sách điểm sinh viên</h2>
        <table class="table table-bordered table-striped text-center align-middle bg-light mt-5 mb-3">
            <thead class="fw-bold">
                <tr>
                    <td class="text-uppercase p-3" style="font-size:18px">Tên sinh viên</td>
                    <td class="text-uppercase p-3" style="font-size:18px">Mã số sinh viên</td>
                    <td class="text-uppercase p-3" style="font-size:18px">Lớp</td>
                    <td class="text-uppercase p-3" style="font-size:18px" width="15%">Niên Khóa</td>
                    <td class="text-uppercase p-3" style="font-size:18px">Điểm rèn luyện</td>
                    <td class="text-uppercase p-3" style="font-size:18px">Điểm học tập</td>
                    <td class="text-uppercase p-3" style="font-size:18px">Chỉnh sửa điểm</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql =
                    "SELECT scores.student_id,scores.training_score, scores.learning_score,students.name ,students.yearofStudy,students.stcode,students.class
                        FROM  `scores` 
                        JOIN `students` ON scores.student_id = students.id";
                $result = executeStatement($sql);
                $numRows = $result->num_rows;
                $numberRowPerPage = 5; // moi trang chua 5 hang
                $totalPages = ceil($numRows / $numberRowPerPage); // tong so trang ( 15/5 = 3 trang)
                $page = $_GET['page'] ?? $_POST['page'] ??  $page = 1;
                $startingLimit = ($page - 1) * $numberRowPerPage;
                $sql =
                    "SELECT scores.student_id,scores.training_score, scores.learning_score,students.name ,students.yearofStudy,students.stcode,students.class
                        FROM  `scores` 
                        JOIN `students` ON scores.student_id = students.id  
                        limit $startingLimit  ,  $numberRowPerPage";
                $scores = executeResult($sql);
                foreach ($scores as $score) {
                    echo
                    '<tr>
                    <td class="p-3 text-capitalize ">' . $score['name'] . '</td>
                    <td class="p-3">' . $score['stcode'] . '</td>
                    <td class="p-3 text-uppercase">' . $score['class'] . '</td>
                    <td class="p-3 text-uppercase">' . $score['yearofStudy'] . '</td>
                    <td class="p-3 fw-bold">' . $score['training_score'] . '</td>
                    <td class="p-3 fw-bold">' . $score['learning_score'] . '</td>
                    <td class="p-3">
                    <button class="btn btn-primary btn-custom ms-2">
                                <i class="fa-solid fa-pencil "></i>
                                <a href="updateScore.php?updatescoreid=' . $score['student_id'] . '"
                                    class="text-white text-decoration-none ms-1">Chỉnh Sửa</a>
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
                <a class="text-white text-decoration-none" href="scoreList.php?page=' . $btn . '">' . $btn . '</a>
                </button>
                ';
        }
        ?>
    </div>
</body>

</html>