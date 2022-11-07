<?php
session_start();
include_once "../admin/config/connect.php";
include_once "../admin/config/functionStatement.php";
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
    // include "header.php"
    ?>
    <div class="p-5">
        <form method="POST" action="searchScore.php" class="mt-5">
            <div class="form-group">
                <label for="" class="form-label fw-bold mb-3" style="font-size:16px;">Tìm kiếm sinh
                    viên: </label>
                <input id="form" type="text" placeholder="Nhập tên sinh viên hoặc mã số sinh viên.."
                    class="w-50 form-control p-2" name="student-search">
                <a href="searchScore.php">
                    <button class="my-3 btn btn-primary px-3 pt-2 text-center" name="search" type="submit">Tìm sinh
                        viên
                    </button>
                </a>
                <p class="text-danger"><?php echo isset($error) ? $error : "" ?></p>
            </div>
            <hr>
        </form>
        <!-- search score after -->
        <h2 class="my-5 text-center text-uppercase" style="font-weight:900">Thông tin sinh viên</h2>
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
                    echo
                    '<tbody class="table-group-divider">
                <tr>
                    <td class="text-capitalize p-3">' . $score['name'] . '</td>
                    <td class="text-capitalize p-3">' . $score['stcode'] . '</td>
                    <td class="text-uppercase p-3">' . $score['class'] . '</td>
                    <td class="text-capitalize p-3">' . $score['major'] . '</td>
                    <td >' . $score['yearofStudy'] . '</td>
                    <td class="text-capitalize p-3">' . $score['learning_score'] . '</td>
                    <td class="text-capitalize p-3">' . $score['training_score'] . '</td>
                </tr>
            </tbody>';
                }
            }
            ?>
        </table>

    </div>
</body>

</html>
<script type="text/javascript">
$(document).ready(function() {
    $("#form").focus();
})
</script>