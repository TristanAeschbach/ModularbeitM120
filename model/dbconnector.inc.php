<?php
class dbConnector
{
    public function __construct()
    {
        $host     = 'localhost';
        $username = "root";
        $password = '';
        $database = 'modularbeitm120';

        $mysqli = new mysqli($host, $username, $password, $database);
        if ($mysqli->connect_error) {
            die("Verbindung misslungen: " . $mysqli->connect_error);
        }
        return $mysqli;
    }
}