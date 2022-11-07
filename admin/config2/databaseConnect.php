<?php
class Database
{
    // define value for connection
    private $host = 'localhost';
    private $username = 'root';
    private $password =  '';
    private $dbname =  'users';

    // connect
    protected function connect()
    {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            echo "Connect to database failed" . $conn->connect_error;
        }
        return $conn;
    }
}