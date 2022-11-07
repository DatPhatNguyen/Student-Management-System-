<?php include_once '../config/connect.php';
session_start();
if (empty($_SESSION['admin'])) {
    echo '<script type="text/javascript">
        window.alert("Trước tiên bạn cần phải đăng nhập !!")
        window.location.href="signin.php"
    </script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ admin</title>
    <?php include "../script.php"; ?>
</head>

<body>
    <?php include "./template/header.php"; ?>
    <div class="row mx-auto shadow-lg my-5 border" style="max-width:95%;border-radius:30px;">
        <?php include "sidebar.php"; ?>
        <div class="col-lg-10 col-sm-10 px-5 py-4">
            <?php include "dashboard.php" ?>
        </div>
    </div>
</body>

</html>