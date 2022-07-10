<?php
include_once "includer.php";
include 'head.html';
$bucher = new bucherModel(1, "b.id", "asc", "b.id = ".$_GET['id'], "", "b.id");
$bucher = $bucher->getBucher()[0];
echo "<a href='javascript:history.go(-1)'>Go Back</a><br><br>";
echo "Show previous Book: <a href='showbook.php?id=".($_GET['id']-1)."'>Book ID ".($_GET['id']-1)."</a> (not according to Search or Filter results. Go back to view searched and filtered.)<br><br>";
echo "<h2>Book Info</h2>";
echo "ID: ".$bucher['id']."<br><br>";
echo "Title: ".$bucher['title']."<br><br>";
echo "Category: ".$bucher['category']."<br><br>";
echo "Sold: ".$bucher['sold']."<br><br>";
echo "Buyer (if sold, if exists): ".$bucher['buyer']."<br><br>";
echo "Content: ".$bucher['content']."<br><br>";
echo "Condition: ".$bucher['condition']."<br><br>";
echo "Show next Book: <a href='showbook.php?id=".($_GET['id']+1)."'>Book ID ".($_GET['id']+1)."</a> (not according to Search or Filter results. Go back to view searched and filtered.)<br><br>";
include 'foot.html';