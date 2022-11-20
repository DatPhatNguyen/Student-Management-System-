<?php
session_start();
include '../config/connect.php';
include '../config/functionStatement.php';
$scoreStudentID = $_GET['updatescoreid'] ?? $_POST['updatescoreid'] ?? '';

// get name and stcode
$selectStudent = "SELECT * FROM `students` WHERE id = $scoreStudentID";
$result = executeStatement($selectStudent);
$row = $result->fetch_assoc();
$name = $row['name'];
$stcode = $row['stcode'];
// get scores
$selectScore = "SELECT * FROM `scores` WHERE `student_id` = '$scoreStudentID'";
$result = executeStatement($selectScore);
$scoreRow = $result->fetch_assoc();
$training_score = $scoreRow['training_score'];
$learning_score = $scoreRow['learning_score'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $training_score = validData($_POST['training_score']);
        $learning_score = validData($_POST['learning_score']);
        $sql
            = "UPDATE `scores` 
                    SET `student_id` ='$scoreStudentID', `training_score`='$training_score', `learning_score` = '$learning_score' 
                    WHERE `student_id` = '$scoreStudentID'";
        $result  = executeStatement($sql);
        if ($result) {
            echo "<script language='javascript' type='text/javascript'>
                window.alert('Chỉnh sửa điểm thành công');
                window.location.href='scoreList.php';   
                </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa điểm sinh viên</title>
    <?php include "../script.php"; ?>
</head>

<body>
    <?php include "./template/header.php" ?>
    <button class="btn btn-primary ms-4 mt-5">
        <a href="scoreList.php" class="text-decoration-none text-light">Xem danh sách điểm</a>
    </button>
    <h2 class="text-center text-uppercase mt-5 mb-4" style="font-weight:900;">Chỉnh sửa điểm sinh viên
    </h2>
    <div class="container mt-3 mb-5 mx-auto shadow " style="max-width:40vw; background:#fff; border-radius: 30px;">
        <form method="POST" class="p-5">
            <div class="mb-3">
                <label class="form-label fw-bold">Tên sinh viên:</label>
                <input type="text" class="form-control" placeholder="Nguyễn Văn A..." autocomplete="off"
                    value=<?php echo (isset($name)) ? $name : '' ?>>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mã số sinh viên: </label>
                <input type="text" class="form-control" placeholder="Nguyễn Văn A..." autocomplete="off"
                    value=<?php echo (isset($stcode)) ? $stcode : '' ?>>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Điểm rèn luyện:</label>
                <input type="text" class="form-control" placeholder="Nguyễn Văn A..." name="training_score"
                    autocomplete="off" value=<?php echo (isset($training_score)) ? $training_score : '' ?>>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Điểm học tập:</label>
                <input type="text" class="form-control" placeholder="1000" name="learning_score" autocomplete="off"
                    value=<?php echo (isset($learning_score)) ? $learning_score : '' ?>>
            </div>
            <div>
                <button class="btn btn-success w-100 px-4 mt-3 text-capitalize rounded-pill fw-bold" name="update"
                    style="font-size:18px">Hoàn
                    tất
                    chỉnh
                    sửa</button>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $("input").focus();
})
</script>

</html>