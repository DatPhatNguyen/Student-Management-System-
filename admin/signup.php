<?php
session_start();
include "../config/connect.php";
include "../config/functionStatement.php";
$errors = [];
$check = false;
define('REQUIRE_FIELD_ERROR', 'Vui lòng điền vào trường này');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = validData($_POST['name']);
    $password = validData($_POST['password']);
    $check = false;
    if (empty($name) || empty($password)) {
        $errors['name'] = $errors['password'] = REQUIRE_FIELD_ERROR;
        $check = false;
    } else {
        $sql = sqlSelectAllCondition('admins', "name = '$name' and password = '$password'");
        $query = executeStatement($sql);
        if (mysqli_num_rows($query) > 0) {
            echo "<script language='javascript' type='text/javascript'>
                 window.alert('Tài khoản cán bộ đã tồn tại!!')
                 window.location.href='addadmin.php'
                </script>";
            $check = false;
        } else {
            $sql = "INSERT INTO `admins` (name,password) VALUES ('$name', '$password')";
            $result = executeStatement($sql);
            if ($result) {
                echo "<script language='javascript' type='text/javascript'>
                 window.alert('Thêm cán bộ mới thành công!!')
                 window.location.href ='index.php'
                     </script>";
                $check = true;
            }
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
    <title>Thêm cán bộ</title>
    <?php include_once "../script.php"; ?>
</head>

<body>
    <?php include_once "./template/header.php"; ?>
    <div class="row mx-auto shadow" style="max-width:60%;border-radius:24px; background:#fff; margin: 70px 0 ;">
        <div class="col-sm-6 col-lg-6">
            <img src="../template/images/admin-signup.jpg" alt="" class="my-3"
                style="object-position:center;object-fit:cover; max-width:100%;max-height:100%">
        </div>
        <div class="col-lg-6 col-md-6">
            <form method="post" class="p-5">
                <h2 class="text-center text-capitalize my-4 text-black fw-bold">Thêm cán bộ mới</h2>
                <div class="mb-3">
                    <label class="form-label fw-bold ">Tên đăng nhập:</label>
                    <input type="text"
                        class="form-control   <?php echo isset($errors['name']) ? 'border border-danger' : '' ?>"
                        placeholder="Tên đăng nhập cán bộ..." name="name">
                    <p class="text-danger mt-2 "><?php echo isset($errors['name']) ? $errors['name'] : '' ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Mật khẩu:</label>
                    <input type="password"
                        class="form-control <?php echo isset($errors['password']) ? 'border border-danger' : '' ?>"
                        placeholder="Nhập mật khẩu..." name="password">
                    <p class="text-danger mt-2 "><?php echo isset($errors['password']) ? $errors['password'] : '' ?></p>
                </div>
                <div class="d-block text-center">
                    <button type="submit" class="btn btn-primary w-100 text-capitalize fw-bold rounded-pill mt-3 btn-lg"
                        style="font-size:18px" name="signup">Thêm mới</button>
                    <p class="text-center mt-4">Đã có tài khoản<a href="signin.php" class="ms-2 fw-bold">Đăng
                            nhập</a></p>
                </div>
            </form>
        </div>
    </div>
    <?php
    include '../template/footer.php';
    ?>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $("input").focus();
})
</script>

</html>