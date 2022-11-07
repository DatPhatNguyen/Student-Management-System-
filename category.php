<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn loại người dùng</title>
    <?php include_once "./script.php" ?>
    <style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    </style>
</head>

<body>
    <div class="row p-5 shadow text-center" style="max-width:1024px;background-color:#fff">
        <h2 class="text-capitalize text-start" style="font-weight:900; font-family:Roboto,san-serif;">Chọn
            loại người dùng
        </h2>
        <h6 class="mt-2 mb-4 ms-3 text-start" style="font-family:Roboto,san-serif;">Chọn loại người dùng mà bạn
            muốn truy cập: </h6>
        <?php
        include_once 'operator.php';
        createCategory('admin.jpg', 'Quản lý', 'admin/signin.php');
        createCategory('parents.jpg', 'Phụ huynh', 'parent/signin.php');
        createCategory('students.jpg', 'Sinh viên', 'student/signin.php');
        ?>
    </div>
</body>

</html>