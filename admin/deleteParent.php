<?php
include './config/connect.php';
include './config/functionStatement.php';
if (isset($_GET['deleteparentid'])) {
    $parentID = $_GET['deleteparentid'];
}
$sql = "DELETE FROM `parents` WHERE parent_id = $parentID";
$result = executeStatement($sql);
if ($result) {
    echo
    "<script language='javascript'>
            window.confirm('Bạn có muốn xóa phụ huynh này không?');
            window.location.href='parentlist.php';
    </script>";
}