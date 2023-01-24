<?php
require_once('../../models/Serie.php');

    function getSeries(){
    $list_series = getSeries_model();
    return $list_series;
   }

   function saveSerie($title, $seasons, $episodes, $idplatform, $iddirector, $actors){
    if (empty($actors)) {
        echo '<p class="error alert alert-danger mt-3">Debe seleccionar por lo menos un actor</p>';
        return;
    }
    $id = saveSerie_model($title, $seasons, $episodes, $idplatform, $iddirector);
    if ($id > 0) {
        foreach ($actors as $selected) {
            saveSeriesCast_model($selected, $id, 'actor');
        }
        echo "<script type='text/javascript'>alert('Serie creada correctamente!')</script>";
    } else { 
        echo "A ocurrido un error al crear la serie ";
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