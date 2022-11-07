<?php
session_start();
include_once "../config/connect.php";
include_once "../config/functionStatement.php";
$errors = [];
$check = false;
define('REQUIRE_FIELD_ERROR', 'Vui lòng điền vào trường này');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = validData($_POST['name']);
    $password = validData($_POST['password']);
    if (empty($name) || empty($password)) {
        $errors['name'] = $errors['password'] = REQUIRE_FIELD_ERROR;
        echo
        '<script type="text/javascript">
        window.alert("Vui lòng điền đầy đủ các trường !!")
        </script>';
        $check = false;
    } else {
        $sql = sqlSelectAllCondition('admins', "name = '$name' AND password ='$password'  ");
        $admin = executeStatement($sql);
        $selectName = "SELECT name FROM `admins` WHERE name = '$name' AND password = '$password'";
        $query = executeStatement($selectName);
        while ($row = $query->fetch_assoc()) {
            $name = $row['name'];
        }
        if (mysqli_num_rows($admin) > 0) {
            echo "<script language='javascript'>
                window.alert('Đăng nhập thành công')
                window.location.href='index.php' 
                </script>";
            $_SESSION['admin'] = $name;
            $check = true;
        } else {
            echo "<script language='javascript'>
            window.alert('Tên đăng nhập hoặc mật khẩu không đúng !!')
            window.location.href='signin.php'</script>";
            $check = false;
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
    <title>Admin đăng nhập</title>
    <?php include "../script.php"; ?>
</head>

<body>
    <?php include "./template/header.php"; ?>
    <?php include_once "../pages/typeOfUser.php" ?>
    <div class="row mx-auto shadow" style="max-width:60%;border-radius:24px; background:#fff; margin: 50px 0 100px;   ">
        <div class="col-sm-6 col-lg-6" style="border-top-left-radius:24px;border-bottom-left-radius:24px">
            <img src="../template/images/admin-signin.jpg" alt="admin" class="my-3"
                style="object-position:center;object-fit:cover; max-width:100%;max-height:100%">
        </div>
        <div class="col-md-6 col-lg-6 ">
            <form method="post" class="p-5">
                <h2 class="text-center text-capitalize my-4 text-black fw-bold">Đăng nhập</h2>
                <div class="mb-3 form-group">
                    <label class="form-label fw-bold">Tên đăng nhập cán bộ:</label>
                    <input type="text" class="form-control  <?php echo isset($errors['name']) ? 'border border-danger' : ""
                                                            ?>" name="name" placeholder="Tên đăng nhập..."
                        value=<?php echo isset($name) ? $name : "" ?>>
                    <p class="text-danger mt-2"><?php echo isset($errors['name']) ? $errors['name'] : "" ?></p>
                </div>
                <div class="mb-3 form-group">
                    <label class="form-label fw-bold">Mật khẩu:</label>
                    <input type="password" class="form-control <?php echo isset($errors['password']) ? 'border border-danger' : ''
                                                                ?>" placeholder="Mật khẩu của bạn..."
                        name="password">
                    <p class="text-danger mt-2"><?php echo isset($errors['password']) ? $errors['password'] : '' ?></p>
                </div>
                <div class="d-block text-center">
                    <button type="submit" class="btn btn-primary w-100 text-capitalize fw-bold rounded-pill mt-3 btn-lg"
                        style="font-size:18px" name="signin">Đăng nhập</button>
                </div>
                <p class="mb-3 mt-4 text-center text-black" style="font-size:16px;">Chưa có tài khoản?
                    <a href="signup.php" class="text-center fw-bold">Tạo tài khoản
                    </a>
                </p>
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