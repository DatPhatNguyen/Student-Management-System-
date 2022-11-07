<?php
include "../script.php";
include_once '../operator.php';
if ($_SERVER['REQUEST_URI'] === '/parent/index.php') {
    menuScore('Tìm Kiếm Sinh Viên', 'Xem Điểm Sinh Viên', '../parent/searchName.php', '../parent/searchScore.php');
} else {
    menuScore('Tìm Kiếm Sinh Viên', 'Xem Điểm Sinh Viên', '../student/searchName.php', '../student/searchScore.php');
}