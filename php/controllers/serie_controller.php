<?php
require_once('../../models/Serie.php');

    function getSeries(){
    $list_series = getSeries_model();
    return $list_series;
   }

   function cleanActors($actors, $actors_serie){
       $list = [];
       if(!empty($actors) && !empty($actors_serie)){
        foreach($actors as $actor){
            $existe = false;
            foreach($actors_serie as $serie){
               if($actor->getId() == $serie->getId()){
                   $existe = true;
               }
            }
            if(!$existe){
               array_push($list, $actor);
            }
          }
       } else{
           $list = $actors;
       }
       return $list;
   }

   function listActorsSerie($idserie){
     $list_actorsSerie = getActoresSerie_model($idserie);
     return $list_actorsSerie;
   }

   function saveSerie($title, $seasons, $episodes, $idplatform, $iddirector, $actors, $languages, $subtitles){
    
    if (empty($title)) {
        echo '<p class="error alert alert-danger mt-3">Campo título obligatorio</p>';
        return;
    }
    if (empty($seasons)) {
        echo '<p class="error alert alert-danger mt-3">Campo temporadas obligatorio</p>';
        return;
    }
    if (empty($episodes)) {
        echo '<p class="error alert alert-danger mt-3">Campo episodios obligatorio</p>';
        return;
    }
    if (empty($idplatform)) {
        echo '<p class="error alert alert-danger mt-3">Campo plataforma obligatorio</p>';
        return;
    }
    if (empty($iddirector)) {
        echo '<p class="error alert alert-danger mt-3">Debe seleccionar un director</p>';
        return;
    }
    if (empty($actors)) {
        echo '<p class="error alert alert-danger mt-3">Debe seleccionar por lo menos un actor</p>';
        return;
    }
    if (empty($languages)) {
        echo '<p class="error alert alert-danger mt-3">Debe seleccionar por lo menos un lenguaje</p>';
        return;
    }
    
    if (empty($subtitles)) {
        echo '<p class="error alert alert-danger mt-3">Debe seleccionar por lo menos un lenguaje como subtitulo</p>';
        return;
    }
    if (!is_numeric($seasons)) {
        echo '<p class="error alert alert-danger mt-3">El campo seasons debe ser numérico</p>';
        return;
    }
    if (!is_numeric($episodes)) {
        echo '<p class="error alert alert-danger mt-3">El campo episodios debe ser numérico</p>';
        return;
    }
    $id = saveSerie_model($title, $seasons, $episodes, $idplatform, $iddirector);
    if ($id > 0) {
        foreach ($actors as $selected) {
            saveSeriesCast_model($selected, $id, 'actor');
        }
    } 
    if ($id > 0) {
        foreach ($languages as $selected) {
            saveSeriesLanguaje_model($selected, $id);
        }
    } 
    if ($id > 0) {
        foreach ($subtitles as $selected) {
            saveSeriesSubtitle_model($selected, $id);
            echo $selected;
        }
    } 

    return true;
   }

   function updateSerie($id, $title, $seasons, $episodes, $add_actors, $delete_actors){
    if (empty($title)) {
        echo '<p class="error alert alert-danger mt-3">Campo título obligatorio</p>';
        return;
    }
    if (empty($seasons)) {
        echo '<p class="error alert alert-danger mt-3">Campo temporadas obligatorio</p>';
        return;
    }
    if (empty($episodes)) {
        echo '<p class="error alert alert-danger mt-3">Campo episodios obligatorio</p>';
        return;
    }
    if (!is_numeric($seasons)) {
        echo '<p class="error alert alert-danger mt-3">El campo seasons debe ser numérico</p>';
        return;
    }
    if (!is_numeric($episodes)) {
        echo '<p class="error alert alert-danger mt-3">El campo episodios debe ser numérico</p>';
        return;
    }   
    updateSerie_model($id, $title, $seasons, $episodes);
    if(!empty($add_actors)){
        foreach ($add_actors as $selected) {
            saveSeriesCast_model($selected, $id, 'actor');
        }
    }
    if(!empty($delete_actors)){
        foreach ($delete_actors as $selected) {
            deleteSeriesCast_model($selected, $id);
        }
    }
   }

   function getSerieById($id){
    $serie = getSerieById_model($id);
    return $serie;
   }
       
   function deleteSerie($id){
    //Borrado en cascada
    deleteSeriesCast($id);
    deleteSeriesLanguage($id);
    deleteSeriesSubtitles($id);
    deleteSerie_model($id);
   }
    ?>