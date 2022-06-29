<?php

include_once "includer.php";
include 'head.html';
if(empty($_SESSION['username'])){
    new reroute("loginView.php");
}
if (!isset($_GET['show'])){
    $_GET['show'] = 1;
}
if (!isset($_GET['sortBy'])){
    $_GET['sortBy'] = "b.id";
}
if (!isset($_GET['direction'])){
    $_GET['direction'] = "asc";
}
if (!isset($_GET['filter'])){
    $_GET['filter'] = "";
}
if (!isset($_GET['filterBy'])){
    $_GET['filterBy'] = "b.id";
}
if (!isset($_GET['search'])){
    $_GET['search'] = "";
}
if (!isset($_GET['searchBy'])){
    $_GET['searchBy'] = "b.id";
}
$show = $_GET['show']*50;


$bucher = new bucherModel($show, $_GET['sortBy'], $_GET['direction'], $_GET['filter'], $_GET['filterBy'], $_GET['search'], $_GET['searchBy']);
$bucher = $bucher->getBucher();
$out = "<div class='bucherListe'>";
foreach ($bucher as $each){
    $out .= "<div class='buch'>";

    $out .= "</div>";
}
$out .= "</div>";

include 'foot.html';