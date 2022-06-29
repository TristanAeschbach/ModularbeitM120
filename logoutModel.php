<?php

class logoutModel
{
    public function __construct()
    {
        session_start();
        session_destroy();
        new reroute("index.php");
    }
}