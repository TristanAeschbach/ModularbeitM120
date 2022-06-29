<?php
include 'view/head.html';
include "model/includer.php";
new includer(__FILE__);
if(empty($_SESSION) || !$_SESSION['checked']){
    new reroute("loginView.php");
}
echo "index";
include 'view/foot.html';