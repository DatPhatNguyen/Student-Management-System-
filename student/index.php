<?php
session_start();
if (empty($_SESSION['student'])) {
    echo '<script type="text/javascript">
        window.alert("Trước tiên bạn cần phải đăng nhập !!");
        window.location.href="signin.php";
    </script>';
}
include './autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang sinh viên</title>
</head>

<body>
    <?php
    include_once "header.php";
    include_once "../script.php";
    include_once "../pages/background.php";
    include_once "../pages/about.php";
    include_once "../pages/support.php";
    // include_once "../pages/menu.php";
    include_once "../pages/menu.php";
    include_once "../pages/contact.php";
    include_once "../pages/backtoTop.php";
    include_once "../template/footer.php";
    ?>

</body>

</html>