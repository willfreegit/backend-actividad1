<?php
require_once('../../models/actor.php');
require_once('../../db/connection_db.php');

function listactors()
{
    $actors= new Actor();
    $actorList= $actors->getall();
    $actorObjectArray =[];

    foreach ($actorList as $actoritem) {
        $actorObject=new Actor($actoritem->getId(),$actoritem->getFirstname(),$actoritem->getLastname(),$actoritem->getDOB(),$actoritem->getIdcountry(),$actoritem->getnationality());
        array_push($actorObjectArray, $actorObject);
    }
    return $actorObjectArray;
}


function storeActor($firstname, $lastname, $DOB, $idcountry)
{
    $actorCreated=true;
    if (empty($firstname))
    {
        echo nl2br("Falta el dato de nombre del actor\n");
        $actorCreated=false;
    }
    
    if (empty($lastname))
    {
        echo nl2br("Falta el dato de apellido del actor\n");
        $actorCreated=false;
    }

    if (empty($DOB))
    {
        echo nl2br("Falta el dato de fecha de nacimiento del actor\n");
        $actorCreated=false;
    }

    if ($DOB=="00/00/0000")
    {
        echo nl2br("Falta el dato de fecha de nacimiento del actor\n");
        $actorCreated=false;
    }

    if (empty($idcountry))
    {
        echo nl2br("Falta la nacionalidad del actor\n");
        $actorCreated=false;
    }

    if ($actorCreated)
    {
    $newActor = new Actor (null,$firstname, $lastname, $DOB, $idcountry );
    $actorCreated = $newActor->saveActor();
    }
    
    return $actorCreated;
}

?>
