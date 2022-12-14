<?php
session_start();
include_once "../config/connect.php";
include_once "../config/functionStatement.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
include '../script.php';
?>

<body>
    <header class="header" id="header" style="background:#fff;">
        <div class="container-fluid mx-auto shadow header-container" id="top">
            <div class=" d-flex justify-content-between  align-items-center mx-5">
                <!-- index logo -->
                <div>
                    <a href='index.php'>
                        <img src='../template/images/logo-ctu.png' class='d-inline-block'
                            style='width:60px; height:auto;'>
                    </a>
                    <a href="index.php" class="text-capitalize text-success text-decoration-none active ms-3">Trang
                        chủ</a>
                </div>
                <!-- header / navigate   -->
                <?php echo isset($_SESSION['student'])
                    ?
                    '<div class="pt-1 mt-1">
                    <p class="me-3" style="font-weight:700; font-size:18px; display:inline-block">' . $_SESSION['student'] . '</p>
                    <button type="submit" class=" border btn btn-danger py-2 px-4 text-center ">
                        <a href="../pages/logout.php" class="text-white text-decoration-none text-capitalize text-button">Đăng xuất</a>
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
    <div class="p-5">
        <form method="POST" action="searchScore.php" class="mt-5">
            <div class="form-group">
                <label for="" class="form-label fw-bold mb-3" style="font-size:16px;">Tìm kiếm sinh
                    viên: </label>
                <input id="form" type="text" placeholder="Nhập họ tên sinh viên hoặc mã số sinh viên.."
                    class="w-50 form-control p-2" name="student-search">
                <a href="searchScore.php">
                    <button class="my-3 btn btn-primary px-3 pt-2 text-center" name="search" type="submit">Tìm sinh
                        viên</button>
                </a>
                <p class="text-danger"><?php echo isset($error) ? $error : "" ?></p>
            </div>
            <hr>
        </form>
        <h3 class="my-5 text-center text-uppercase">Thông tin sinh viên</h3>
        <table class="table table-striped table-bordered text-center align-middle bg-light my-5">
            <thead class="text-uppercase text-black lh-lg">
                <tr>
                    <th scope="col" class="p-3">Tên sinh viên</th>
                    <th scope="col" class="p-3">Mã số sinh viên</th>
                    <th scope="col" class="p-3">Lớp</th>
                    <th scope="col" class="p-3">Chuyên ngành</th>
                    <th scope="col" class="p-3">Niên Khóa</th>
                    <th scope="col" class="p-3">Điểm học tập</th>
                    <th scope="col" class="p-3">Điểm rèn luyện</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $search = $_POST['student-search'];
                    $sql = "SELECT scores.training_score, scores.learning_score,students.name, students.stcode, students.class, students.major, students.yearofStudy 
                    FROM `students`  
                    JOIN scores ON scores.student_id = students.id
                    WHERE name like '%$search%' OR students.stcode like '%$search%'";
                    $scores = executeResult($sql);
                    if ($search === '') {
                        echo '<script type="text/javascript">
                            window.alert("Bạn phải nhập tên sinh viên !!");
                            window.location.href="searchScore.php"
                            </script>';
                    }
                    if (empty($scores)) {
                        echo '<script type="text/javascript">
                            window.alert("Không tìm thấy sinh viên !!");
                            window.location.href="searchScore.php"
                            </script>';
                    }
                    foreach ($scores as $score) {
                        echo '
                <tr>
                    <td class="text-capitalize p-3">' . $score['name'] . '</td>
                    <td class="text-capitalize p-3">' . $score['stcode'] . '</td>
                    <td class="text-uppercase p-3">'  . $score['class'] . '</td>
                    <td class="text-capitalize p-3">' . $score['major'] . '</td>
                    <td class="text-capitalize p-3">' . $score['yearofStudy'] . '</td>
                    <td class="text-capitalize p-3">' . $score['learning_score'] . '</td>
                    <td class="text-capitalize p-3">' . $score['training_score'] . '</td>
                </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $("input").focus();
})
</script>

</html>