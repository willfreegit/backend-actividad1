<?php
require_once('../../models/Serie.php');

    function getSeries(){
    $list_series = getSeries_model();
    return $list_series;
   }

   function saveSerie($title, $seasons, $episodes, $idplatform, $iddirector, $actors){
    
    if (empty($title)) {
        echo '<p class="error alert alert-danger mt-3">Campo título obligatorio</p>';
        return;
    }
    if (empty($title)) {
        echo '<p class="error alert alert-danger mt-3">Campo temporadas obligatorio</p>';
        return;
    }
    if (empty($idplatform)) {
        echo '<p class="error alert alert-danger mt-3">Campo plataforma obligatorio</p>';
        return;
    }
    if (empty($actors)) {
        echo '<p class="error alert alert-danger mt-3">Debe seleccionar por lo menos un actor</p>';
        return;
    }
    $id = saveSerie_model($title, $seasons, $episodes, $idplatform, $iddirector);
    if ($id > 0) {
        foreach ($actors as $selected) {
            saveSeriesCast_model($selected, $id, 'actor');
        }
        return true;
    } else { 
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