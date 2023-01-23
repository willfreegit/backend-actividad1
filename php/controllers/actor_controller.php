<?php
require_once('../../models/Actor.php');
require_once('../../db/connection_db.php');

function listactors()
{
    $actors= new Actor();
    $actorList= $actors->getall();
    $actorObjectArray =[];

    foreach ($actorList as $actoritem) {
        $actorObject=new Actor($actoritem->getId(),$actoritem->getFirstname(),$actoritem->getLastname(),$actoritem->getDOB(),$actoritem->getIdcountry());
        array_push($actorObjectArray, $actorObject);
    }
    return $actorObjectArray;
}


function storeActor($firstname, $lastname, $DOB, $idcountry)
{

    $newActor = new Actor (null,$firstname, $lastname, $DOB, $idcountry );
    $actorCreated = $newActor->saveActor();
    return $actorCreated;
}

?>