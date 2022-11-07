<?php
session_start();
include "./config/connect.php";
include "./config/functionStatement.php";
// sql to show value into update input
$adminID = $_GET['updateadminid'] ?? $_POST['updateadminid'];
$sql = "SELECT * FROM `admins` WHERE `id` = '$adminID'";
$result = executeStatement($sql);
$row = $result->fetch_assoc();
$name = $row['name'];
echo '<pre>';
var_dump($name);
echo '</pre>';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $name = validData($_POST['name']);
        $sql = "UPDATE `admins`  SET  `id` = '$adminID', `name`= '$name'
        WHERE `id` = '$adminID'";
        if ($result) {
            echo '<script type="text/javascript">
            window.alert("Chỉnh sửa cán bộ thành công !!");
            window.location.href="adminlist.php"
        </script>';
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
    <title>Chỉnh sửa cán bộ</title>
    <?php include "../script.php"; ?>

</head>

<body>
    <?php include "./template/header.php" ?>
    <button class="btn btn-primary ms-4 mt-5">
        <a href="adminlist.php" class="text-decoration-none text-light">Xem danh sách</a>
    </button>
    <h3 class="text-center text-uppercase mt-5 mb-4" style="letter-spacing:2px; font-weight:900">Chỉnh sửa thông tin
        cán bộ
    </h3>
    <div class="container mt-2  mx-auto shadow" style="max-width:40%;background: #fff; border-radius: 30px;">
        <form method="POST" action="updateadmin.php" class="p-5">
            <div class="mb-3">
                <label class="form-label fw-bold">Tên đăng nhập admin:</label>
                <input type="text" class="form-control" placeholder="Tên đăng nhập..." autocomplete="off" name="name"
                    value=<?php echo isset($name) ? $name : '' ?>>
            </div>
            <div>
                <button class="btn btn-success w-100 px-4 mt-2 text-capitalize rounded-pill" name="update"
                    type="submit">Hoàn tất
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