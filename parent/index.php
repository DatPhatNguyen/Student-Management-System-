<?php
session_start();
if (empty($_SESSION['parent'])) {
    echo '<script>
            window.alert("Trước tiên bạn cần phải đăng nhập !!");
            window.location.href="signin.php"
           </script>';
}
?>
<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang phụ huynh</title>
</head>

<body>
    <?php
    include_once "../autoload/autoload.php";
    include_once "../script.php";
    include_once "./header.php";
    include_once "../pages/background.php";
    include_once "../pages/about.php";
    include_once "../pages/support.php";
    include_once "../pages/menu.php";
    include_once "../pages/contact.php";
    include_once "../pages/backtotop.php";
    include_once "../autoload/autoload.php";
    include_once "../template/footer.php";
    ?>
</body>

</html>