<?php
session_start();
include 'view/head.html';
include "model/includer.php";
new includer(__FILE__);
if(empty($_SESSION)){
    new reroute("loginView.php", __FILE__);
}
echo "index";
include 'view/foot.html';