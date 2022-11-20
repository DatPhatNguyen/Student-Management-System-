<?php
include_once 'connect.php';
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASENAME);
function executeStatement($sql): mixed
{
    global $conn;
    $result = $conn->query($sql);
    return $result;
}
function executeResult($sql): mixed
{
    global $conn;
    $result = $conn->query($sql);
    $data   = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}
function executeSingleRecord($sql): mixed
{
    global $conn;
    $result = $conn->query($sql);
    $row    = $result->fetch_assoc();
    return $row;
}

function validData($data)
{
    global $conn;
    $data = mysqli_real_escape_string($conn, $data);
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
function sqlSelectAll($tableName)
{
    $sql = "SELECT * FROM $tableName";
    return $sql;
}
function sqlSelectAllCondition($tableName, $condition): string
{
    $sql = "SELECT * FROM $tableName WHERE $condition";
    return $sql;
}
function insertIntoDatabase($tableName,  $attributes = [], $values = [])
{
    $sql = "INSERT INTO $tableName $attributes VALUES $values";
    return $sql;
}
function update($tableName, $setValue, $condition)
{
    $sql = "UPDATE $tableName SET $setValue WHERE $condition";
    return $sql;
}