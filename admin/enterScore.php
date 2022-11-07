<?php
session_start();
include "./config/connect.php";
include "./config/functionStatement.php";
$errors = [];
define('REQUIRE_FIELD_ERROR', 'Vui lòng điền vào trường này');
$studentScoreID = $_GET['studentscoreid'] ?? $_POST['studentscoreid'] ?? null;
$sql = "SELECT stcode FROM students WHERE `id` = '$studentScoreID'";
$result = executeStatement($sql);
$row = mysqli_fetch_row($result);
$stcode = $row[0];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $training_score = mysqli_real_escape_string($conn, $_POST['training_score']);
    $learning_score = mysqli_real_escape_string($conn, $_POST['learning_score']);
    $check = false;
    if (empty($training_score) || empty($learning_score)) {
        $errors['training_score'] = $errors['learning_score'] = REQUIRE_FIELD_ERROR;
        $check = false;
    } else {
        $sql = "INSERT INTO `scores` (training_score,learning_score) VALUES ('$training_score', '$learning_score')";
        $result = executeStatement($sql);
        if ($result) {
            echo "<script language='javascript' type='text/javascript'>
                window.alert('Nhập điểm thành công !!');    
                window.location.href='scoreList.php';
                </script>";
            $check = true;
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
    <title>Nhập điểm sinh viên</title>
    <?php include "../script.php"; ?>
</head>

<body>
    <?php include_once "./template/header.php"; ?>
    <?php include_once "scoreList.php" ?>

    <h3 class="text-center text-uppercase my-5" style="letter-spacing:2px; font-weight:900">Nhập điểm sinh viên</h3>
    <div class="container mt-2 mx-auto shadow"
        style="max-width:45%; margin: 60px 0; background:#fff; border-radius:40px;">
        <form method="post" class="p-5" action='enterScore.php'>
            <div class="mb-3">
                <label class="form-label fw-bold">Mã số sinh viên:</label>
                <input type="text" class="form-control" value=<?php echo $stcode ?>>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Điểm rèn luyện:</label>
                <input type="text" class="form-control <?php echo isset($errors['training_score']) ? 'border border-danger' : ''
                                                        ?>" placeholder="Nhập điểm rèn luyện..."
                    name="training_score">
                <p class="text-danger mt-2">
                    <?php echo isset($errors['training_score']) ? $errors['training_score'] : '' ?>
                </p>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Điểm học tập / quá trình:</label>
                <input type="text" class="form-control <?php echo isset($errors['learning_score']) ? 'border border-danger' : ''
                                                        ?>" placeholder="Nhập điểm học kì..."
                    name="learning_score">
                <p class="text-danger mt-2">
                    <?php echo isset($errors['learning_score']) ? $errors['learning_score'] : '' ?></p>
            </div>
            <div>
                <button class="btn btn-primary mt-2 text-capitalize w-100" name="enterscore" type="submit">Nhập
                    điểm</button>
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