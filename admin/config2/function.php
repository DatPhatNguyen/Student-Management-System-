<?php
class Query extends Database
{

    public function getStudents()
    {
        $sql = "SELECT * FROM students";
        $result = $this->connect()->query($sql);
        while ($row = $result->fetch_assoc()) {
        }
        return;
    }
    public function getAdmins()
    {
        $sql = "SELECT * FROM students";
        $result = $this->connect()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}