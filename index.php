<?php
session_start();
include_once "includer.php";
include 'head.html';
if(empty($_SESSION)){
    new reroute("loginView.php");
}
echo "index";
include 'foot.html';