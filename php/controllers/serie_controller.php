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
    if (empty($iddirector)) {
        echo '<p class="error alert alert-danger mt-3">Debe seleccionar un director</p>';
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

   function updateSerie($id, $title, $seasons, $episodes, $add_actors, $delete_actors){
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
    deleteSerie_model($id);
   }
    ?>