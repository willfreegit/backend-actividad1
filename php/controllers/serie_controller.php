<?php
include "../../php/db/connection_db.php";
require_once('../models/Serie.php');

    function getSeries(){
    $conn = OpenConn();    
    $list_series = [];
    $query="SELECT * FROM series";               
    $series= mysqli_query($conn,$query);    
    while($row= mysqli_fetch_assoc($series)){
        $item = new Serie($row['id'], $row['title'], $row['seasons'], $row['episodes'], $row['idplatform'], $row['iddirector']);
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

   function updateSerie($id, $title, $seasons, $episodes){
    $conn = OpenConn();
    $query = "UPDATE series SET title = '{$title}', seasons = '{$seasons}', episodes = '{$episodes}' WHERE id = $id";
    $update = mysqli_query($conn, $query);
    CloseConn($conn);
   }

   function getSerieById($id){
    $conn = OpenConn();
    $serie = (object)[];
    $query="SELECT * FROM series WHERE id = $id ";
    $series = mysqli_query($conn,$query);
    while($row= mysqli_fetch_assoc($series)){
        $serie = new Serie($row['id'], $row['title'], $row['seasons'], $row['episodes'], $row['idplatform'], $row['iddirector']);
    } 
    CloseConn($conn);
    return $serie;
   }
             
    ?>