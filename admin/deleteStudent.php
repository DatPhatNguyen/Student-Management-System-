<?php
include './config/connect.php';
include './config/functionStatement.php';
if (isset($_GET['deletestudentid'])) {
    $studentID = $_GET['deletestudentid'];
}
$sql = "DELETE FROM `students` WHERE `id` = '$studentID'";
$result = executeStatement($sql);
if ($result) {
    echo
    "<script language='javascript'>
            window.confirm('Bạn có muốn xóa sinh viên này không?');
            window.location.href='studenlist.php';
         </script>";
} else {
    echo
    "<script language='javascript' type='text/javascript'>
            window.alert('Xóa thất bại');
            window.location.href='deleteStudent.php';   
     </script>";
}
?>

<script type="text/javascript">
function deleteStudent(id) {
    const option = confirm('Bạn có muốn xóa sinh viên này không?');
    if (!option) {
        return;
    }
    console.log(id);
    $.ajax()
}
</script>