<?php
include "../../php/db/connection_db.php";
require_once('../models/Serie.php');

    function getSeries(){
    $conn = OpenConn();    
    $list_series = [];
    $query="SELECT * FROM series";               
    $series= mysqli_query($conn,$query);    
    while($row= mysqli_fetch_assoc($series)){
        $item = new Serie($row['id'], $row['title']);
        array_push($list_series, $item);
    } 
    CloseConn($conn);
    return $list_series;
   }

   function saveSerie($title, $seasons, $episodes, $idplatform, $iddirector){
    $conn = OpenConn();
   
    $query= "INSERT INTO series(title, seasons, episodes, idplatform, iddirector) VALUES('{$title}','{$seasons}','{$episodes}','{$idplatform}','{$iddirector}')";
    $add_serie = mysqli_query($conn,$query);
    CloseConn($conn);
    if($add_serie){
        return true;
    } else {
        echo "Error insert series: ". mysqli_error($conn);
        return false;
    }
   }
             
    ?>