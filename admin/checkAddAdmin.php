<?php
function checkEmptyAddminInput($username, $password)
{
    $result = false;
    if (empty($username) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function checkUserName($username)
{
    $result = false;
    if (!preg_match('/^[a-zA-Z0-9]{1,10}', $username)) {
        return true;
    } else {
        return false;
    }
    return $result;
}
function checkPassWord($password)
{
    $result = false;
    if (!preg_match('/^[a-zA-Z0-9]{6,10}', $password)) {
        return true;
    } else {
        return false;
    }
    return $result;
}
function createAdmin($conn, $username, $password)
{
    $sql = "INSERT INTO admin (name,password) VALUES ('$username' ,$password') ";
    $stmt = mysqli_stmt_init($conn);
    $result = $conn->query($sql);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: addadmin.php?error="useralreadyexists"');
        exit();
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $name, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:addadmin.php?error=createrror');
    exit();
}