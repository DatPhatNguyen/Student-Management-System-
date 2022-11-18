<?php
session_start();
include_once "../config/connect.php";
include_once "../config/functionStatement.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars(trim(mysqli_real_escape_string($conn, $_POST['email'])));
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
    $passwordLength = strlen($password);
    $check = false;
    $errors = [];
    define('REQUIRE_FIELD_ERROR', 'Vui lòng điền vào trường này');
    if ($password  === 'd41d8cd98f00b204e9800998ecf8427e') {
        $errors['password'] = REQUIRE_FIELD_ERROR;
    }
    if (empty($email) || empty($password)) {
        $errors['email'] = $errors['password'] =  REQUIRE_FIELD_ERROR;
        echo '<script type="text/javascript">
        window.alert("Vui lòng điền đầy đủ các trường")
            </script>';
        $check = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Phải đúng dịnh dạng email';
        $check = false;
    } else {
        $sql = "SELECT * FROM `parents` WHERE email = '$email' AND password = '$password'";
        $selectName = "SELECT name  FROM `parents` WHERE email = '$email' AND password = '$password'";
        $selectID = "SELECT parent_id  FROM `parents` WHERE email = '$email' AND password = '$password'";
        $query = executeStatement($selectName);
        while ($row = $query->fetch_assoc()) {
            $name = $row['name'];
        }
        $queryID = executeStatement($selectID);
        while ($row = $queryID->fetch_assoc()) {
            $parentID = $row['parent_id'];
        }
        $result = executeStatement($sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo "<script language='javascript' type='text/javascript'>
                window.alert('Đăng nhập thành công !!');
                window.location.href ='index.php';
                </script>";
                $check = true;
                $_SESSION['parent'] = $name;
                $_SESSION['parent_id'] = $parentID;
            } else {
                echo "<script language='javascript' type='text/javascript'>
                window.alert('Email hoặc mật khẩu không chính xác !!');
                window.location.href ='signin.php';
                </script>";
                $check = false;
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
    <title>Trang đăng nhập</title>
    <?php include "../script.php"; ?>
</head>

<body>
    <header class="header" id="header">
        <div class="container-fluid mx-auto shadow header-container" id="top">
            <div class="d-flex justify-content-between align-items-center mx-5">
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
    <!-- form -->
    <div class="row mx-auto shadow"
        style="max-width:60%;border-radius:24px; background:#fff; margin: 40px 0 60px 0  ;   ">
        <div class="col-sm-6 col-lg-6" style="border-top-left-radius:24px;border-bottom-left-radius:24px">
            <img src="../template/images/parents.jpg" alt="" class="my-3"
                style="object-position:center;object-fit:cover; max-width:100%;max-height:100%">
        </div>
        <div class="container mx-auto col-sm-6 col-lg-6">
            <form method="POST" style="padding:50px" action="signin.php">
                <h2 class="text-center text-capitalize mb-3">Đăng nhập</h2>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email:</label>
                    <input type="email"
                        class="form-control <?php echo isset($errors['email']) ? 'border border-danger' : "" ?>"
                        placeholder="Email của bạn.." name="email" value=<?php echo isset($email) ? $email : "" ?>>
                    <p class="text-danger mt-2">
                        <?php echo isset($errors['email']) ? $errors['email'] : "" ?>
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Mật khẩu:</label>
                    <input type="password"
                        class="form-control <?php echo isset($errors['password']) ? 'border border-danger' : "" ?>"
                        placeholder="Mật khẩu của bạn..." name="password">
                    <p class="text-danger mt-2">
                        <?php echo isset($errors['password']) ? $errors['password'] : "" ?>
                    </p>
                </div>
                <div class="d-block text-center mt-4">
                    <button type="submit" class="btn btn-primary w-100 text-capitalize fw-bold rounded-pill btn-lg"
                        style="font-size:18px" name="signin">Đăng
                        nhập</button>
                </div>
                <div class="mt-3">
                    <p class="text-center">Bạn chưa có tài khoản?
                        <a href="signup.php" class="text-center text-capitalize fw-bold">Đăng ký</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <?php include "../template/footer.php" ?>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $("input").focus();
})
</script>

</html>