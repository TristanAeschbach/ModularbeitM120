<?php
include_once "includer.php";
$category = $condition = array();
$available = $search = $searchBy = $sortBy = $direction = false;
if (isset($_POST)){
    if (!empty($_POST['search'])){
        $search = $_POST['search'];
    }
    if (isset($_POST['available'])){
        $available = true;
    }
    foreach ($_POST as $each){
        if (preg_match("/category/", $each)){
            array_push($category, ltrim($each, "category"));
        }
        if (preg_match("/condition/", $each)){
            array_push($condition, ltrim($each, "condition"));
        }
        if (preg_match("/searchBy/", $each)){
            $searchBy = ltrim($each, "searchBy");
            switch ($searchBy){
                case "Author":
                    $searchBy = "b.autor";
                    break;
                case "Title":
                    $searchBy = "b.kurztitle";
                    break;
                case "Content":
                    $searchBy = "b.title";
                    break;
            }
        }
        if (preg_match("/sortBy/", $each)){
            $sortBy = ltrim($each, "sortBy");
            switch ($sortBy){
                case "ID":
                    $sortBy = "b.id";
                    break;
                case "Author":
                    $sortBy = "b.autor";
                    break;
                case "Category":
                    $sortBy = "k.kategorie";
                    break;
                case "Title":
                    $sortBy = "b.kurztitle";
                    break;
                case "Condition":
                    $sortBy = "z.beschreibung";
                    break;
            }
        }
        if (preg_match("/direction/", $each)){
            $direction = ltrim($each, "direction");
            switch($direction){
                case "Ascending":
                    $direction = "asc";
                    break;
                case "Descending":
                    $direction = "desc";
                    break;

            }
        }
    }
    echo "<br>";

    $link = "index.php";
    if ($category || $condition || $available){
        $link .= "?filter=";
    }
    if ($category){
        $link .= urlencode("(k.kategorie = '".$category[0]."'");
        if (count($category) > 1){
            for ($i = 1;count($category) > $i;$i++){
                $link .= urlencode(" or k.kategorie = '".$category[$i]."'");
            }
        }
        if ($condition || $available){
            $link .= urlencode(") and ");
        }
    }
    if ($condition){
        $link .= urlencode("(z.beschreibung = '".$condition[0]."'");
        if (count($condition) > 1){
            for ($i = 1;count($condition) > $i;$i++){
                $link .= urlencode(" or z.beschreibung = '".$condition[$i]."'");
            }
        }
        $link .= urlencode(")");
    }
    if ($available){
        $link .= urlencode(" and b.verkauft = 0");
    }
    if ($category || $condition || $available){
        $link .= "&";
    }
    if ($search){
        $link .= "search=".urlencode(htmlspecialchars(trim($search)));
    }
    if ($searchBy){
        $link .= "&searchBy=".urlencode($searchBy);
    }
    if ($sortBy){
        $link .= "&sortBy=".urlencode($sortBy);
    }
    if ($direction){
        $link .= "&direction=".urlencode($direction);
    }
    new reroute($link);
}
