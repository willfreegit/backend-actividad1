<?php
require_once('../../models/Actor.php');
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
    else {
         $from_format = 'd/m/Y';
         $to_format = 'Y/m/d';
         $date_aux = date_create_from_format($from_format, $DOB);
         $datesave = date_format($date_aux,$to_format);
        
    }

    if (empty($idcountry))
    {
        echo nl2br("Falta la nacionalidad del actor\n");
        $actorCreated=false;
    }

    if ($actorCreated)
    {
    $newActor = new Actor (null,$firstname, $lastname, $datesave, $idcountry );
    $actorCreated = $newActor->saveActor();
    }
    
    return $actorCreated;
}

function updateActor($actorId,$firstname, $lastname, $DOB, $idcountry)
{
    $actorEdited=true;
    
    if (empty($actorId))
    {
        echo nl2br("Falta el id del actor\n");
        $actorEdited=false;
    }

    if (empty($firstname))
    {
        echo nl2br("Falta el dato de nombre del actor\n");
        $actorEdited=false;
    }
    
    if (empty($lastname))
    {
        echo nl2br("Falta el dato de apellido del actor\n");
        $actorEdited=false;
    }

    if (empty($DOB))
    {
        echo nl2br("Falta el dato de fecha de nacimiento del actor\n");
        $actorEdited=false;
    }

    if ($DOB=="00/00/0000")
    {
        echo nl2br("Falta el dato de fecha de nacimiento del actor\n");
        $actorEdited=false;
    }
    else {
            $from_format = 'd/m/Y';
            $to_format = 'Y/m/d';
            $date_aux = date_create_from_format($from_format, $DOB);
            $datesave = date_format($date_aux,$to_format);
           
       }

    if (empty($idcountry))
    {
        echo nl2br("Falta la nacionalidad del actor\n");
        $actorEdited=false;
    }

    if ($actorEdited)
    {
        $actorEditor = new Actor ($actorId,$firstname, $lastname, $datesave, $idcountry );
        $actorEdited = $actorEditor->updateActor();
    }
    
    return $actorEdited;
}

function getActorData($actorId)
{
    $actor = new Actor($actorId);
    $actorObject = $actor->getItem();

    return $actorObject;
}

function deleteActor($actorId)
{
    $actor = new Actor($actorId);
    $actorDeleted = $actor->delete();

    return $actorDeleted;
}

?>


