<?php
// define value for connection
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASENAME', 'users');

// connect
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASENAME);
// check connect
if ($conn->connect_error) {
    echo "Connect to database failed" . $conn->connect_error;
}