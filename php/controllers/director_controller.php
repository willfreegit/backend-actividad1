<?php
require_once('../../models/Director.php');
require_once('../../db/connection_db.php');

function listdirectors()
{
    $directors= new Director();
    $directorList= $directors->getall();
    $directorObjectArray =[];

    foreach ($directorList as $directoritem) {
        $directorObject=new Director($directoritem->getId(),$directoritem->getFirstname(),$directoritem->getLastname(),$directoritem->getDOB(),$directoritem->getIdcountry(),$directoritem->getnationality());
        array_push($directorObjectArray, $directorObject);
    }
    return $directorObjectArray;
}


function storeDirector($firstname, $lastname, $DOB, $idcountry)
{
    $directorCreated=true;
    if (empty($firstname))
    {
        echo nl2br("Falta el dato de nombre del director\n");
        $directorCreated=false;
    }
    
    if (empty($lastname))
    {
        echo nl2br("Falta el dato de apellido del director\n");
        $directorCreated=false;
    }

    if (empty($DOB))
    {
        echo nl2br("Falta el dato de fecha de nacimiento del director\n");
        $directorCreated=false;
    }

    if ($DOB=="00/00/0000")
    {
        echo nl2br("Falta el dato de fecha de nacimiento del director\n");
        $directorCreated=false;
    }

    if (empty($idcountry))
    {
        echo nl2br("Falta la nacionalidad del director\n");
        $directorCreated=false;
    }

    if ($directorCreated)
    {
    $newDirector = new Director (null,$firstname, $lastname, $DOB, $idcountry );
    $directorCreated = $newDirector->saveDirector();
    }
    
    return $directorCreated;
}

function updateDirector($directorId,$firstname, $lastname, $DOB, $idcountry)
{
    $directorEdited=true;
    
    if (empty($directorId))
    {
        echo nl2br("Falta el id del director\n");
        $directorEdited=false;
    }

    if (empty($firstname))
    {
        echo nl2br("Falta el dato de nombre del director\n");
        $directorEdited=false;
    }
    
    if (empty($lastname))
    {
        echo nl2br("Falta el dato de apellido del director\n");
        $directorEdited=false;
    }

    if (empty($DOB))
    {
        echo nl2br("Falta el dato de fecha de nacimiento del director\n");
        $directorEdited=false;
    }

    if ($DOB=="00/00/0000")
    {
        echo nl2br("Falta el dato de fecha de nacimiento del director\n");
        $directorEdited=false;
    }

    if (empty($idcountry))
    {
        echo nl2br("Falta la nacionalidad del director\n");
        $directorEdited=false;
    }

    if ($directorEdited)
    {
        $directorEditor = new Director ($directorId,$firstname, $lastname, $DOB, $idcountry );
        $directorEdited = $directorEditor->updateDirector();
    }
    
    return $directorEdited;
}

function getDirectorData($directorId)
{
    $director = new Director($directorId);
    $directorObject = $director->getItem();

    return $directorObject;
}

function deleteDirector($directorId)
{
    $director = new Director($directorId);
    $directorDeleted = $director->delete();

    return $directorDeleted;
}

?>


