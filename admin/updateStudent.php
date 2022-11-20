<?php
session_start();
include '../config/connect.php';
include '../config/functionStatement.php';
// get id
$studentID = $_GET['updatestudentid'] ?? $_POST['updatestudentid'] ?? null;
// sql to show value into update input
$sql = "SELECT * FROM `students` WHERE id = $studentID";
$result = executeStatement($sql);
$row = $result->fetch_assoc();
$name = $row['name'];
$stcode = $row['stcode'];
$class = $row['class'];
$yearofStudy = $row['yearofStudy'];
$major = $row['major'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $name = validData($_POST['name']);
        $stcode = validData($_POST['stcode']);
        $class = validData($_POST['class']);
        $yearofStudy = $_POST['yearofStudy'];
        $major = $_POST['major'];
        $sql =
            "UPDATE `students` 
                SET `id` ='$studentID', `name`='$name' , `stcode` = '$stcode', `class` = '$class' , `major` = '$major' 
                WHERE `id` = '$studentID'";
        $result  = executeStatement($sql);
        if ($result) {
            echo "<script language='javascript' type='text/javascript'>
                window.alert('Chỉnh sửa sinh viên thành công');
                window.location.href='studentlist.php';   
                </script>";
        } else {
            echo "<script language='javascript' type='text/javascript'>
            window.alert('Chỉnh sửa sinh viên thât bại');
            window.location.href='updateStudent.php';   
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
    <title>Chỉnh sửa phụ huynh</title>
    <?php include "../script.php"; ?>
</head>

<body>
    <?php include "./template/header.php" ?>
    <button class="btn btn-primary ms-4 mt-5">
        <a href="studentlist.php" class="text-decoration-none text-light">Xem danh sách</a>
    </button>
    <h2 class="text-center text-uppercase my-5" style="font-weight:900;">Chỉnh sửa thông tin sinh viên
    </h2>
    <div class="container mt-3 mb-5 mx-auto shadow " style="max-width:40vw;background:#fff; border-radius: 30px;">
        <form method="post" class="p-5">
            <div class="mb-3">
                <label class="form-label fw-bold">Tên sinh viên:</label>
                <input type="text" class="form-control  " placeholder="Nguyễn Văn A..." name="name"
                    value=<?php echo isset($name) ? $name : "" ?>>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mã số sinh viên:</label>
                <input type="text" class="form-control " placeholder=" B1900000..." name="stcode" minlength="8"
                    maxlength="8" value=<?php echo isset($stcode) ? $stcode : "" ?>>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Lớp:</label>
                <input type="text" class="form-control " placeholder="20V7A2..." name="class" minlength="6"
                    maxlength="6" value=<?php echo isset($class) ? $class : "" ?>>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Chuyên ngành học:</label>
                <select name="major" class="form-select">
                    <option value="<?php echo isset($major) ? $major : "" ?>" selected="selected">
                        Chọn chuyên ngành
                    </option>

                    <option value="Hệ thống thông tin">Hệ thống thông tin</option>
                    <option value="Công nghệ - Thông tin">Công nghệ - Thông tin</option>
                    <option value="Khoa học máy tính">Khoa học máy tính</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Niên khóa:</label>
                <select name="yearofStudy" id="" class="form-select">
                    <option value="" selected>Chọn chuyên ngành</option>
                    <option value="2018-2019">2018-2019</option>
                    <option value="2019-2020">2019-2020</option>
                    <option value="2020-2021">2020-2021</option>
                    <option value="2021-2022">2021-2022</option>
                </select>

            </div>
            <div>
                <button class="btn btn-primary px-4 mt-2 text-capitalize rounded-pill w-100" name="update"
                    style="font-size:18px">
                    Hoàn tất chỉnh sửa</button>
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