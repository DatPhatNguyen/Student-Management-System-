<?php
// function freshData($value)
// {
//     $value = trim($value);
//     $value = htmlspecialchars($value);
//     return $value;
// }
function checkEmpty($name, $stcode, $class, $yearofStudy)
{
    $result = false;
    if (empty($name) || empty($stcode) || empty($class) || empty($yearofStudy)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function checkName($name)
{
    $result = false;
    if (!preg_match("^[a-zA-Z]", $name)) {
        return true;
    } else {
        $result = false;
    }
    return $result;
}

function checkStudentCode($stcode)
{
    $result = false;
    if (!preg_match("/^(?:B|C)\d{7}/", $stcode)) {
        return true;
    } else {
        $result = false;
    }
    return $result;
}
function checkClass($class)
{
    $result = false;
    if (!preg_match("/^\d{2}[a-zA-Z]\d{1}[a-zA-Z]\d{1}/", $class)) {
        return true;
    } else {
        $result = false;
    }
    return $result;
}
function checkYearOfStudy($yearofStudy)
{
    $result = false;
    if (!preg_match("/^[0-9]{4}\-[0-9]{4}$/", $yearofStudy)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function stcodeExists($conn, $stcode)
{
    $sql = "SELECT * FROM `students` WHERE stcode = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ./adduser.php?error="useralreadyexists"');
    }
    mysqli_stmt_bind_param($stmt, "sss", $stcode);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $stcode, $class, $yearofStudy)
{
    $sql = "INSERT INTO `students` (name,stcode,class,yearofStudy) VALUES ('$name' ,'$stcode','$class','$yearofStudy'); ";
    $stmt = mysqli_stmt_init($conn);
    // mysqli oop
    // $result = $conn->query($sql);
    // if(!$result) {
    // }

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: adduser.php?error="useralreadyadded"');
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $name, $stcode, $class, $yearofStudy);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:addadmin.php?error=createrror');
    exit();
}