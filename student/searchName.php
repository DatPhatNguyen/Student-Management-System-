<?php
session_start();
include "../admin/config/connect.php";
include "../admin/config/functionStatement.php";
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
    <!-- search student first -->
    <?php
    include "header.php"
    ?>
    <div class="p-5">
        <form method="POST" action="searchName.php" class="mt-5">
            <div class="form-group">
                <label for="" class="form-label fw-bold mb-3" style="font-size:16px;">Tìm kiếm sinh
                    viên: </label>
                <input type="text" placeholder="Nhập tên sinh viên hoặc mã số sinh viên.."
                    class="w-50 form-control p-2" name="student-search">
                <a href="searchScore.php">
                    <button class="my-3 btn btn-primary px-3 pt-2 text-center" name="search" type="submit">Tìm sinh
                        viên</button>
                </a>
                <p class="text-danger"><?php echo isset($error) ? $error : "" ?></p>
            </div>
            <hr>
        </form>
        <!-- search score after -->
        <h3 class="my-5 text-center text-uppercase">Thông tin sinh viên</h3>
        <table class="table table-striped table-bordered text-center align-middle bg-light my-5">
            <thead class="text-uppercase text-black lh-lg">
                <tr>
                    <th scope="col" class="p-3">Tên sinh viên</th>
                    <th scope="col" class="p-3">Mã số sinh viên</th>
                    <th scope="col" class="p-3">Lớp</th>
                    <th scope="col" class="p-3">Chuyên ngành</th>
                    <th scope="col" class="p-3">Niên Khóa</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $search = $_POST['student-search'];
                    $sql = "SELECT * FROM `students` WHERE name like '%$search%' OR stcode like '%$search%'";
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
                </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
        <button class="btn btn-danger text-capitalize">
            <a href="searchScore.php" class="text-decoration-none text-white">Xem điểm sinh viên</a>
        </button>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $("input").focus();


})
</script>

</html>