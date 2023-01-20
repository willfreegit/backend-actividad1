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
             
    ?>