<?php
include "../config/connect.php";
include "../config/functionStatement.php";
$check = false;
$errors = [];
define('REQUIRE_FIELD_ERROR', 'Vui lòng điền vào trường này');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = validData($_POST['name']);
    $email = validData($_POST['email']);
    $password = md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmpassword']);
    //todo: check
    if (empty($name) || empty($email) || empty($password) || empty($confirmpassword)) {
        $errors['name'] = $errors['email'] = $errors['password'] = $errors['confirmpassword'] = REQUIRE_FIELD_ERROR;
        $check = false;
        if ($password = $confirmpassword  === 'd41d8cd98f00b204e9800998ecf8427e') {
            $errors['password'] = $errors['confirmpassword'] = REQUIRE_FIELD_ERROR;
            $check = false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Không đúng định dạng email";
            $check = false;
        }
        // else if (strlen($password) < 6) {
        //     $errors['password'] = "Mật khẩu phải lớn hơn 6 kí tự";
        //     $check = false;
        // }
        if (!strcmp($confirmpassword, $password) && ($confirmpassword !== $password)) {
            $errors['confirmpassword'] = 'Mật khẩu không trùng khớp';
            $check = false;
        }
    } else {
        $sql = "SELECT * FROM `parents` WHERE email = '$email' AND password = '$password'";
        $result = executeStatement($sql);
        $numberOfAccount = mysqli_num_rows($result);
        if ($numberOfAccount > 0) {
            echo "<script language='javascript' type='text/javascript'>
                window.alert('Email đã tồn tại. Vui lòng nhập email khác !!');
                window.location.href ='signup.php';
                </script>";
            $check = false;
        } else {
            $sql = "INSERT INTO `parents`  
                (name,email,password,confirmpassword) VALUES 
                ('$name','$email','$password','$confirmpassword')";
            $result = executeStatement($sql);
            if ($result) {
                echo "<script language='javascript' type='text/javascript'>
                                window.alert('Đăng ký thành công')
                                window.location.href='signin.php'
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
    <title>Trang đăng ký</title>
    <?php include "../script.php"; ?>
</head>

<body>
    <header class="header" id="header">
        <div class="container-fluid mx-auto shadow header-container" id="top">
            <div class=" d-flex justify-content-between  align-items-center mx-5">
                <!-- index logo -->
                <div>
                    <a href='index.php'><img src='../template/images/logo-ctu.png' class='d-inline-block'
                            style='width:60px; height:auto;'></a>
                    <a href="index.php" class="text-capitalize text-success text-decoration-none active ms-3">Trang
                        chủ</a>
                </div>
                <?php echo isset($_SESSION['parent'])
                    ?
                    '<div class="pt-1">
                    <p class="me-3" style="font-weight:700; font-size:18px; display:inline-block">' . $_SESSION['parent'] . '</p>
                    <button type="submit" class=" border btn btn-danger py-2 px-4 text-center ">
                        <a href="logout.php" class="text-white text-decoration-none text-capitalize text-button">Đăng xuất</a>
                    </button>
                </div>'
                    : ' <div class="pt-1">
                <button type="submit" class=" border btn btn-primary py-2 px-4 text-center ">
                    <a href="signup.php" class="text-white text-decoration-none text-capitalize text-button">Đăng
                        ký</a>
                </button>
                <button type="submit" class=" border btn btn-danger py-2 px-4 text-center ms-3 ">
                    <a href="signin.php" class="text-white text-decoration-none text-capitalize text-button">Đăng
                        nhập</a>    
                </button>
            </div>';
                ?>
            </div>
        </div>
    </header>
    <?php include_once "../pages/typeOfUser.php" ?>
    <div class="row mx-auto shadow" style="max-width:65%;border-radius:24px; background:#fff; margin: 40px 0;">
        <div class="col-lg-6 col-sm-6" style="border-top-left-radius:24px;border-bottom-left-radius:24px">
            <img src="../template/images/parent-signup.jpg" class="mx-auto my-3"
                style="object-position:center;object-fit:cover; max-width:100%;max-height:100%">
        </div>
        <div class="col-lg-6 col-sm-6">
            <form method="POST" action='signup.php' style="padding:50px">
                <h2 class="text-center text-capitalize mb-3">Đăng ký</h2>
                <div class="form-group">
                    <label class="form-label fw-bold">Họ và tên:</label>
                    <input type="text"
                        class="form-control  <?php echo isset($errors['name']) ? 'border border-danger' : "" ?> "
                        placeholder=" Họ và tên.." name="name" autocomplete="off"
                        value="<?php echo $name ?? $_POST['name'] ?? '' ?>">
                    <?php echo isset($errors['name']) ? '<p class="text-danger  mt-2">' . $errors["name"] . '</p>' :
                        "<div class='mt-2'></div>" ?>
                </div>
                <div class="form-group">
                    <label class="form-label fw-bold">Email:</label>
                    <input type="email"
                        class="form-control <?php echo isset($errors['email']) ? 'border border-danger' : "" ?> "
                        placeholder="Email..." name="email" autocomplete="off "
                        value="<?php echo $email ?? $_POST['email'] ?? '' ?>">
                    <?php echo isset($errors['email']) ? '<p class="text-danger  mt-2">' . $errors["email"] . '</p>' :
                        "<div class='mt-2'></div>" ?>
                </div>
                <div class="form-group">
                    <label class="form-label fw-bold">Mật khẩu:</label>
                    <input type="password"
                        class="form-control   <?php echo isset($errors['password']) ? 'border border-danger' : "" ?>"
                        placeholder=" Mật khẩu..." name="password" autocomplete="off">
                    <?php echo isset($errors['password']) ? '<p class="text-danger  mt-2">' . $errors["password"] . '</p>' :
                        "<div class='mt-2'></div>" ?>
                </div>
                <div class="form-group">
                    <label class="form-label fw-bold">Xác nhận lại mật khẩu:</label>
                    <input type="password"
                        class="form-control <?php echo isset($errors['confirmpassword']) ? 'border border-danger' : "" ?>"
                        placeholder=" Nhập lại mật khẩu của bạn..." name="confirmpassword" autocomplete="off">
                    <?php echo isset($errors['confirmpassword']) ? '<p class="text-danger  mt-2">' . $errors["confirmpassword"] . '</p>' :
                        "<div class='mt-2'></div>" ?>
                </div>
                <div class=" d-block text-center">
                    <button type="submit" class="btn btn-primary w-100 text-capitalize my-3 fw-bold p-2 rounded-pill"
                        style="font-size:18px" name="signup">Đăng ký</button>
                </div>
                <p class="text-center ">Bạn đã có tài khoản<a href="signin.php" class="ms-1 fw-bold">Đăng
                        nhập</a></p>
            </form>
        </div>
    </div>
    <?php include "../template/footer.php"; ?>;
</body>
<script type="text/javascript">
$(document).ready(function() {
    $("input").focus();
})
</script>

</html>