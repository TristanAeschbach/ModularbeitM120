<?php
class dbConnector
{
    private $mysqli = "";
    public function __construct()
    {
        $host     = 'localhost';
        $username = "root";
        $password = '';
        $database = 'modularbeitm120';

        $this->mysqli = new mysqli($host, $username, $password, $database);
        if ($this->mysqli->connect_error) {
            die("Verbindung misslungen: " . $this->mysqli->connect_error);
        }
    }
    function getThing(){
        return $this->mysqli;
    }
}