<?php
require_once('../../models/actor.php');
/*include "../../db/connection_db.php";*/

function listActors()
    {    
        $model = new Actor();
        $actorList = $model->getAll();
        $actorObjectArray = [];
        
        foreach ($actorList as $actorItem) {
        $actorObject = new Actor($actorItem->getId(), $actorItem->getfirstname(),
        $actorItem->getlastname(), $actorItem->getDOB(),$actorItem->getidcountry());
        array_push( $actorObjectArray, $actorObject) ;
        }
        return $actorObjectArray;
    }

 

?>