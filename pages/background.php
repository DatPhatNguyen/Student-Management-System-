<?php
include_once '../script.php';
include_once "../operator.php";
if ($_SERVER['REQUEST_URI'] === '/parent/index.php') {

    createBackGround('../template/images/parent-page-background.jpg');
} else if ($_SERVER['REQUEST_URI'] === '/student/index.php') {
    createBackGround('../template/images/student-page-background.jpg');
}