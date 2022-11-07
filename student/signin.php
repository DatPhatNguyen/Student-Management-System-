<?php
session_start();
include "../admin/config/connect.php";
include "../admin/config/functionStatement.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stcode = mysqli_real_escape_string($conn, $_POST['stcode']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
    $passwordLength = strlen($password);
    $check = false;
    $errors = [];
    define('REQUIRE_FIELD_ERROR', 'Vui lòng điền vào trường này');
    if ($password === 'd41d8cd98f00b204e9800998ecf8427e') {
        $errors['password'] = REQUIRE_FIELD_ERROR;
    }
    if (empty($stcode) || empty($password)) {
        $errors['stcode'] = $errors['password'] =  REQUIRE_FIELD_ERROR;
        echo '<script type="text/javascript">
            window.alert("Vui lòng điền đầy đủ các trường")
        </script>';
        $check = false;
    } else if (!preg_match("/^(?:B|C)\d{7}/", $stcode)) {
        $errors['stcode'] = 'Không đúng định dạng';
        $check = false;
    } else if ($passwordLength < 6) {
        $errors['password'] = 'Mật khẩu phải lớn hơn 6 kí tự';
        $check = false;
    } else {
        $sql = "SELECT * FROM `students` WHERE stcode = '$stcode' AND  password = '$password'";
        $selectName = "SELECT name FROM `students` WHERE stcode = '$stcode' AND password = '$password'";
        $query = executeStatement($selectName);
        while ($row = $query->fetch_assoc()) {
            $name = $row['name'];
        }
        $result = $conn->query($sql);
        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                echo "<script language='javascript' type='text/javascript'>
                window.alert('Đăng nhập thành công !!');
                window.location.href ='index.php';
                </script>";
                $check = true;;
                $_SESSION['student'] = $name;
            } else {
                echo "<script language='javascript' type='text/javascript'>
                window.alert('Mã số sinh viên hoặc mật khẩu không đúng !!');
                window.location.href ='signin.php';
                </script>";
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
    <style>
    .text-danger {
        font-size: 14px;
    }
    </style>
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
                <?php echo isset($_SESSION['student'])
                    ?
                    '<div class="pt-1">
                    <p class="me-3" style="font-weight:700; font-size:18px; display:inline-block">' . $_SESSION['student'] . '</p>
                    <button type="submit" class=" border btn btn-danger py-2 px-4 text-center ">
                        <a href="logout.php" class="text-white text-decoration-none text-capitalize text-button">Đăng xuất</a>
                    </button>
                </div>'
                    : ' <div class="pt-1">
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
    <div class="row mx-auto mt-5 shadow" style="max-width:55%;border-radius:24px; background:#fff;">
        <div class="col-sm-6 col-lg-6" style="border-top-left-radius:24px;border-bottom-left-radius:24px">
            <img src="../template/images/students.jpg" alt="" class="my-3"
                style="object-position:center;object-fit:cover; max-width:100%;max-height:100%">
        </div>
        <div class="container mx-auto col-sm-6 col-lg-6">
            <form method="POST" style="padding:50px" action="signin.php">
                <h2 class="text-center text-capitalize mb-4">Đăng nhập</h2>
                <div class="mb-3">
                    <label class="form-label fw-bold">Mã số sinh viên:</label>
                    <input type="text"
                        class="form-control <?php echo isset($errors['stcode']) ? 'border border-danger' : "" ?>"
                        placeholder="Nhập mã số sinh viên" name="stcode" minlength="8" maxlength="8"
                        value=<?php echo isset($stcode) ? $stcode : "" ?>>
                    <p class="text-danger mt-2">
                        <?php echo $errors['stcode'] ?? $errors['stcode']  ?? "" ?>
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Mật khẩu:</label>
                    <input type="password"
                        class="form-control <?php echo isset($errors['password']) ? 'border border-danger' :  "" ?>"
                        placeholder="Mật khẩu của bạn..." name="password">
                    <p class="text-danger mt-2">
                        <?php echo $errors['password'] ?? $errors['password'] ?? "" ?>
                    </p>
                </div>
                <div class="d-block text-center mt-4">
                    <button type="submit" class="btn btn-primary w-100 text-capitalize  rounded-pill fw-bold"
                        style="font-size:18px" name="signin">Đăng
                        nhập</button>
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