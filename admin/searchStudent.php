<?php
include_once '../config/connect.php';
include_once '../config/functionStatement.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ admin</title>
    <?php include "../script.php"; ?>
</head>

<body>
    <form action="searchStudent.php" method="POST" name="search-form" class="mt-5">
        <div class="form-group">
            <label for="" class="form-label fw-bold mb-3" style="font-size:16px;">Tìm kiếm sinh
                viên: </label>
            <input type="text" placeholder="Nhập tên sinh viên hoặc mã số sinh viên.." class="w-50 form-control p-2"
                name="student-search">
            <a href="./searchStudent.php">
                <button class="my-3 btn btn-primary px-3 pt-2 text-center" name="search" type="submit">Tìm sinh
                    viên
                </button>
            </a>
        </div>
        <hr>
    </form>
    <h3 class="text-center my-5 text-uppercase fw-bold" style="color:#1e3799;letter-spacing:1.5px;">Sinh viên tìm thấy
    </h3>
    <hr>
    <table class='table table-bordered table-striped text-center align-middle bg-light border my-5'>
        <thead class="text-uppercase text-secondary">
            <tr>
                <th scope="col">Tên sinh viên</th>
                <th scope="col">Mã số sinh viên</th>
                <th scope="col">Lớp</th>
                <th scope="col">Niên Khóa</th>
                <th scope="col">Xóa / Sửa</th>
            </tr>
        </thead>
        <?php
        if (isset($_POST['search'])) {
            $search = $_POST['student-search'];
            $sql = "SELECT * FROM `students` WHERE name like '%$search%' OR stcode like '%$search%' OR class like '%$search%'";
            $students = executeResult($sql);
            if ($search === '') {
                echo '<script type="text/javascript">
                window.alert("Bạn phải nhập tên sinh viên !!");
                window.location.href="searchStudent.php"
           </script>';
            }
            foreach ($students as $student) {
                echo '
                                    <tbody>
                                <tr>
                                    <td class="text-capitalize">' . $student['name'] . '</td>
                                    <td class="text-capitalize">' . $student['stcode'] . '</td>
                                    <td class="text-uppercase">' . $student['class'] . '</td>
                                    <td>' . $student['yearofStudy'] . '</td>
                                    <td style="max-width:120px">
                                        <button class="btn btn-primary btn-custom">
                                            <i class="fa-solid fa-trash"></i>
                                            <a href="deleteuser.php?deleteid=' . $student['id'] . '"
                                                class="text-white text-decoration-none ms-1">Xóa</a>
                                        </button>
                                        <button class="btn btn-danger btn-custom ms-2">
                                            <i class="fa-solid fa-pencil "></i>
                                            <a href="updateuser.php?updateid=' . $student['id'] . '"
                                                class="text-white text-decoration-none ms-1">Sửa</a>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>';
            }
        }
        ?>
    </table>
</body>

</html>