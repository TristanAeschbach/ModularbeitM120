<?php
session_start();
include_once "includer.php";
class loginModel
{
    public function __construct($email, $password)
    {
        $dbConnector = new dbConnector();
        $mysql = $dbConnector->getThing();
        $result = $mysql->query("SELECT * from modularbeitm120.benutzer where email = '$email'");
        if ($result->num_rows == 1) {
            while($row = $result->fetch_assoc()) {
                if(password_verify($password, $row['passwort']) && !empty($row['benutzername'])){
                    $_SESSION['username'] = $row['benutzername'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['admin'] = $row['admin'];
                    $_SESSION['name'] = $row['vorname'].", ".$row['name'];

                    echo "correct";
                    new reroute("index.php");
                }else{
                    echo "wrong password";
                    new reroute("loginView.php?error=wrongPassword");
                }
            }
        }
    }
}