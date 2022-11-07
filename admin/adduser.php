<?php
session_start();
include './config/connect.php';
include './config/functionStatement.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = trim(md5(mysqli_real_escape_string($conn, $_POST['password'])));
    $name = validData($_POST['name']);
    $stcode = validData($_POST['stcode']);
    $class = validData($_POST['class']);
    $yearofStudy = validData($_POST['yearofStudy']);
    $major = validData($_POST['major']);
    $check = false;
    $errors = [];
    //! check 
    define('REQUIRE_FIELD_ERROR', 'Vui lòng điền vào trường này');
    if (empty($name) || empty($stcode) || empty($password) || empty($class) || empty($yearofStudy) || empty($major)) {
        $errors['name'] = $errors['stcode'] = $errors['password'] =  $errors['class'] = $errors['yearofStudy'] = $errors['major'] = REQUIRE_FIELD_ERROR;
    } else if (!preg_match("/^[a-zA-Z0-9]/", $name)) {
        $errors['name'] = "Sai định dạng tên";
        $check = false;
    } else if (!preg_match("/^(?:B|C)\d{7}/", $stcode)) {
        $errors['stcode'] = "Sai định dạng MSSV";
        $check = false;
    } else if (strlen($password <= 6)) {
        $errors['password'] = "Mật khẩu phải lớn hơn 6 kí tự";
        $check = false;
    } else if (!preg_match("/^\d{2}[a-zA-Z]\d{1}[a-zA-Z]\d{1}/", $class)) {
        $errors['class'] = "Sai định dạng lớp";
        $check = false;
    } else {
        $sql = "INSERT INTO `students` (name,stcode ,password,class,yearofStudy,major) VALUES ('$name','$stcode','$password','$class','$yearofStudy','$major')";
        $result  = executeStatement($sql);
        if ($result) {
            echo "<script language='javascript' type='text/javascript'>
                window.alert('Thêm mới sinh viên thành công');
                window.location.href='studentlist.php';
        </script>";
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
    <title>Thêm sinh viên</title>
    <?php include "../script.php"; ?>

</head>

<body>
    <?php
    include "template/header.php";
    ?>
    <h2 class="text-center text-uppercase mt-5 mb-4" style="letter-spacing:2px; font-weight:900">Thêm sinh viên</h2>
    <div class="container mt-2  mx-auto shadow"
        style="max-width:40%; background:#fff; padding: 30px; margin: 90px 0; border-radius:30px;">
        <form method="post" class="p-4">
            <div class="mb-3">
                <label class="form-label fw-bold">Tên sinh viên:</label>
                <input type="text"
                    class="form-control  <?php echo isset($errors['name']) ? 'border border-danger' : " " ?>"
                    placeholder="Nguyễn Văn A..." name="name">
                <p class="text-danger mt-2"><?php echo isset($errors['name']) ? $errors['name'] : " " ?></p>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mã số sinh viên:</label>
                <input type="text"
                    class="form-control <?php echo isset($errors['stcode']) ? 'border border-danger' : " " ?>"
                    placeholder="B1900000..." name="stcode" minlength="8" maxlength="8">
                <p class="text-danger mt-2"><?php echo isset($errors['stcode']) ? $errors['stcode'] : " " ?></p>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mật khẩu:</label>
                <input type="password"
                    class="form-control  <?php echo isset($errors['password']) ?  'border border-danger' : " " ?>"
                    placeholder="Nhập mật khẩu..." name="password">
                <p class="text-danger mt-2"><?php echo isset($errors['password']) ? $errors['password'] : " " ?></p>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Lớp:</label>
                <input type="text"
                    class="form-control <?php echo isset($errors['class']) ? 'border border-danger' : " " ?>"
                    placeholder="20V7A2..." name="class" minlength="6" maxlength="6">
                <p class="text-danger mt-2"><?php echo isset($errors['class']) ? $errors['class'] : "" ?></p>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Chuyên ngành học:</label>
                <select name="major"
                    class="form-select <?php echo isset($errors['major']) ? 'border border-danger' : " " ?>">
                    <option value="" selected>Chọn chuyên ngành</option>
                    <option value="Hệ thống thông tin">Hệ thống thông tin</option>
                    <option value="Công nghệ - Thông tin">Công nghệ - Thông tin</option>
                    <option value="Khoa học máy tính">Khoa học máy tính</option>
                </select>
                <p class="text-danger mt-2"><?php echo isset($errors['major']) ? $errors['major'] : " " ?></p>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Niên khóa:</label>
                <select name="yearofStudy" id=""
                    class="form-select <?php echo isset($errors['yearofStudy']) ? 'border border-danger' : " " ?>">
                    <option value="" selected>Chọn niên khóa</option>
                    <option value="2018-2019">2018-2019</option>
                    <option value="2019-2020">2019-2020</option>
                    <option value="2020-2021">2020-2021</option>
                    <option value="2021-2022">2021-2022</option>
                </select>
                <p class="text-danger mt-2"><?php echo isset($errors['yearofStudy']) ? $errors['yearofStudy'] : " " ?>
                </p>
            </div>

            <div>
                <button class="btn btn-primary px-4 mt-2 text-capitalize rounded-pill w-100 fw-bold" name="addnewuser"
                    style="font-size:18px">Thêm mới
                    sinh
                    viên</button>
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