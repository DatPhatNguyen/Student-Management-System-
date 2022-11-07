<?php
session_start();
include "./config/connect.php";
include "./config/functionStatement.php";
if (isset($_GET['deleteadminid'])) {
    $adminID = $_GET['deleteadminid'];
}
$sql = "DELETE FROM `admins` WHERE id = $adminID";
$result = executeStatement($sql);
if ($result) {
    echo "<script language='javascript'>
            window.confirm('Bạn có muốn xóa cán bộ này không?');
            window.location.href='adminlist.php';
     </script>";
}
?>
<script type="text/javascript">
function deleteCategory(id) {
    var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
    if (!option) {
        return;
    }
    console.log(id)
    $.post('ajax.php', {
        'id': id,
        'action': 'delete'
    }, function(data) {
        location.reload()
    })
}
</script>