<?php
session_start();
include_once '../config/connect.php';
include_once '../config/functionStatement.php';
// get id
$parentID = $_GET['updateparentid'] ?? $_POST['updateparentid'] ?? null;
// sql to show value into update input
$sql = "SELECT * FROM `parents` WHERE `parent_id` = '$parentID'";
$result = executeStatement($sql);
$row = $result->fetch_assoc();
$name = $row['name'];
$parentcode = $row['parentcode'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $name = validData($_POST['name']);
        $parentcode = $_POST['parentcode'];
        $sql
            = "UPDATE `parents` SET `parent_id` ='$parentID', `name`='$name' WHERE `parent_id` = '$parentID'";
        $result  = executeStatement($sql);
        if ($result) {
            echo "<script language='javascript' type='text/javascript'>
                window.alert('Chỉnh sửa phụ huynh thành công');
                window.location.href='parentlist.php';   
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
        <a href="parentlist.php" class="text-decoration-none text-light">Xem danh sách</a>
    </button>
    <h2 class="text-center text-uppercase my-5" style="font-weight:900;">Chỉnh sửa thông tin phụ
        huynh
    </h2>
    <div class="container mt-3 mb-5 mx-auto shadow " style="max-width:40vw; background:#fff; border-radius: 30px;">
        <form method="POST" class="p-5">
            <div class="mb-3">
                <label class="form-label fw-bold">Tên phụ huynh:</label>
                <input type="text" class="form-control" placeholder="Nguyễn Văn A..." name="name" autocomplete="off"
                    value="<?php echo (isset($name)) ? $name : '' ?>">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mã số phụ huynh:</label>
                <input type="text" class="form-control" placeholder="1000" name="parentcode" autocomplete="off"
                    value=<?php echo (isset($parentcode)) ? $parentcode : '' ?>>
            </div>
            <div>
                <button class="btn btn-success w-100 px-4 mt-3 text-capitalize rounded-pill w-100" name="update"
                    style="font-size:18px">Hoàn
                    tất
                    chỉnh
                    sửa</button>
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