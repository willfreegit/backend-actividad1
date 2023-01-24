<?php
require_once('../../models/Serie.php');

    function getSeries(){
    $list_series = getSeries_model();
    return $list_series;
   }

   function saveSerie($title, $seasons, $episodes, $idplatform, $iddirector){
    $add_serie = saveSerie_model($title, $seasons, $episodes, $idplatform, $iddirector);
    if($add_serie){
        return true;
    } else {
        echo "Error insert series: ";
        return false;
    }
   }

   function updateSerie($id, $title, $seasons, $episodes){
    updateSerie_model($id, $title, $seasons, $episodes);
   }

   function getSerieById($id){
    $serie = getSerieById_model($id);
    return $serie;
   }
       
   function deleteSerie($id){
    deleteSerie_model($id);
   }
    ?>