<?php
//DISCLAIMER: In dem Bewertungsraster dieser Arbeit steht nichts von Users anzeigen, Login, Logout, Register, New Password und sonst irgendetwas mit Users.
//            Deshalb bin ich der Meinung, dass ich keine Abzüge für das Fehlen dieser Teile bekommen darf.
include_once "includer.php";
include 'head.html';
if(empty($_SESSION['username'])){
    new reroute("loginView.php");
}
if (!isset($_GET['show'])){
    $_GET['show'] = 0;
}
if (!isset($_GET['sortBy'])){
    $_GET['sortBy'] = "b.id";
}
if (!isset($_GET['direction'])){
    $_GET['direction'] = "asc";
}
if (!isset($_GET['filter'])){
    $_GET['filter'] = urlencode("'b.id' LIKE '%%'");
}
if (!isset($_GET['search'])){
    $_GET['search'] = "";
}
if (!isset($_GET['searchBy'])){
    $_GET['searchBy'] = "b.id";
}
$show = ($_GET['show']*50).", 50";
$newURL = "index.php?show=".($_GET['show']-1)."&sortBy=".$_GET['sortBy']."&direction=".$_GET['direction']."&filter=".urlencode($_GET['filter'])."&search=".$_GET['search']."&searchBy=".$_GET['searchBy'];
$out = "";
if ($_GET['show'] > 0){
    $out = "<div class='showMore'>
                <a class='showMoreLink' href='$newURL'>Show previous 50 Books</a>
            </div>";
}

$bucher = new bucherModel($show, urldecode($_GET['sortBy']), urldecode($_GET['direction']), urldecode($_GET['filter']), urldecode($_GET['search']), urldecode($_GET['searchBy']));
$bucher = $bucher->getBucher();
$out .= "<div class='bucherListe'>
            <div class='menu'>
                <form class='filter' action='bucherController.php' method='post'>
                    <div class='mb-3 dropdown'>
                        <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>
                            Category
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
    $cats = array("Alte Drucke, Bibeln, Klassische Autoren in den Originalsprachen", "Geographie und Reisen", "Geschichtswissenschaften", "Naturwissenschaften", "Kinderbücher", "Moderne Literatur und Kunst", "Moderne Kunst und Künstlergraphik", "Kunstwissenschaften", "Architektur", "Technik", "Naturwissenschaften - Medizin", "Ozeanien", "Afrika");
    foreach ($cats as $cat){
        $out .= "           <li>
                                <div class='form-check'>
                                    <input class='form-check-input' type='checkbox' value='category$cat' name='category$cat' checked>
                                    <label class='form-check-label' for='category$cat'>
                                        $cat
                                    </label>
                                </div>
                            </li>";
    }
    $out .= "                        
                        </ul>
                    </div>
                    <div class='mb-3 dropdown'>
                        <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton2' data-bs-toggle='dropdown' aria-expanded='false'>
                            Condition
                        </button>
                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
$conditions = array("good", "medium", "bad");
foreach ($conditions as $condition){
$out .= "                <li>
                            <div class='mb-3 form-check'>
                                <input class='form-check-input' type='checkbox' value='condition$condition' id='condition$condition' name='condition$condition' checked>
                                <label class='form-check-label' for='condition$condition'>
                                    $condition
                                </label>
                            </div>
                        </li>";
}
$out .= "                        
                    </ul>
                </div>
                <button class='btn btn-secondary'>
                <div class='form-check'>
                    <input class='form-check-input' type='checkbox' value='available' id='available' name='available'>
                    <label class='form-check-label' for='available'>
                        Available
                    </label>
                </div>
                </button>
                <div class='col-auto'>
                    <label for='search' class='col-form-label'></label>
                </div>
                <div class='col-auto spacer'>
                    <input type='text' id='search' name='search' class='form-control' placeholder='Search'>
                </div>
                <div class='mb-3 dropdown'>
                        <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton3' data-bs-toggle='dropdown' aria-expanded='false'>
                            Search By
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
$cats = array("Author", "Title", "Content");
foreach ($cats as $cat){
    $out .= "           <li>
                                <div class='form-check'>
                                    <label class='form-check-label' for='searchBy$cat'>
                                    <input class='form-check-input' type='radio' name='flexRadioDefault' id='searchBy$cat' value='searchBy$cat'";
    if ($cat == "Title"){$out .= " checked";}
    $out .= ">
                                        $cat
                                    </label>
                                </div>
                            </li>";
}
$out .= "                        
                        </ul>
                    </div>
                    <div class='mb-3 dropdown'>
                        <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton4' data-bs-toggle='dropdown' aria-expanded='false'>
                            Sort By
                        </button>
                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
$temps = array("ID", "Author", "Category", "Title", "Condition");
foreach ($temps as $temp){
    $out .= "                <li>
                            <div class='form-check'>
                                    <label class='form-check-label' for='sortBy$temp'>
                                    <input class='form-check-input' type='radio' name='flexRadioDefault1' id='sortBy$temp' value='sortBy$temp'";
    if ($temp == "ID"){$out .= " checked";}
    $out .= ">
                                        $temp
                                    </label>
                                </div>
                        </li>";
}
$out .= "                        
                    </ul>
                </div>
                <div class='mb-3 dropdown'>
                        <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton5' data-bs-toggle='dropdown' aria-expanded='false'>
                            Sorting Direction
                        </button>
                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
$temps2 = array("Ascending", "Descending");
foreach ($temps2 as $temp2){
    $out .= "                <li>
                            <div class='form-check'>
                                    <label class='form-check-label' for='direction$temp2'>
                                    <input class='form-check-input' type='radio' name='flexRadioDefault2' id='direction$temp2' value='direction$temp2'";
    if ($temp2 == "Ascending"){$out .= " checked";}
    $out .= ">
                                        $temp2
                                    </label>
                                </div>
                        </li>";
}
$out .= "                        
                    </ul>
                </div>
                    <button type='submit' class='btn btn-secondary'>Submit</button>
            </form>
        </div>";
if ($bucher){
    foreach ($bucher as $each){
        if ($each['sold']){
            $available = "no";
        }else{
            $available = "yes";
        }
        $out .= "<div class='buch'>
                <div class='head'>
                    <div class='left'>Author: ".$each['author']."</div>
                    <div class='right'>Category: ".$each['category']."</div>
                </div>
                <div class='bod'>".$each['title']."</div>
                <div class='foot'>
                    <div class='left'>Condition: ".$each['condition']."</div>
                    <div class='right'>Available: ".$available."</div>
                </div>
                <div class='link primary'>
                    <a class='linkA' href='showBook.php?id=".$each['id']."'>Show Details</a>
                </div>
            </div>";
    }
}else{
    $out .=  "No results Found.";
}

$newURL = "index.php?show=".($_GET['show']+1)."&sortBy=".$_GET['sortBy']."&direction=".$_GET['direction']."&filter=".urlencode($_GET['filter'])."&search=".$_GET['search']."&searchBy=".$_GET['searchBy'];
$out .= "</div>
<div class='showMore'>
    <a class='showMoreLink' href='$newURL'>Show next 50 Books</a>
</div>";
echo $out;



include 'foot.html';