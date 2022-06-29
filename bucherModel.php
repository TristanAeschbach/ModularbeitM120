<?php
include_once "includer.php";
class bucherModel
{
    private $resultat = array();
    public function __construct($show, $sortBy, $direction, $filter, $filterBy, $search, $searchBy)
    {
        $dbConnector = new dbConnector();
        $mysql = $dbConnector->getThing();
        $result = $mysql->query("SELECT b.id, b.kurztitle, k.kategorie, b.verkauft, CONCAT(ku.vorname, ' ,', ku.name) As kaufername, b.autor, b.title, z.beschreibung As zustand FROM modularbeitm120.buecher b left join modularbeitm120.kategorien k on b.kategorie = k.id left join modularbeitm120.kunden ku on b.kaufer = ku.kid left join modularbeitm120.zustaende z on b.zustand = z.zustand WHERE $filterBy LIKE '%$filter%' and $searchBy LIKE '%$search%' ORDER BY $sortBy $direction LIMIT $show");
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $temp = ['id'=>$row['id'], 'title'=>$row['kurztitle'], 'kategory'=>$row['kategorie'], 'sold'=>$row['verkauft'], 'buyer'=>$row['kaufername'], 'author'=>$row['autor'], 'content'=>$row['title'], 'condition'=>$row['zustand']];
                array_push($this->resultat, $temp);
            }
        }else{
            echo "fuck ";
        }
    }
    function getBucher(){
        return $this->resultat;
    }
}