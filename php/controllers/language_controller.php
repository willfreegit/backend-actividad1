<?php
require_once('../../models/Language.php');
require_once('../../db/connection_db.php');

function listactors()
{
    $actors= new Language();
    $actorList= $actors->getall();
    $actorObjectArray =[];

    foreach ($actorList as $actoritem) {
        $actorObject=new Language($actoritem->getId(),$actoritem->getFirstname(),$actoritem->getLastname(),$actoritem->getDOB(),$actoritem->getIdcountry(),$actoritem->getnationality());
        array_push($actorObjectArray, $actorObject);
    }
    return $actorObjectArray;
}


function storeLanguage($firstname, $lastname, $DOB, $idcountry)
{
    $actorCreated=true;
    if (empty($firstname))
    {
        echo nl2br("Falta el dato de nombre del language\n");
        $actorCreated=false;
    }
    
    if (empty($lastname))
    {
        echo nl2br("Falta el dato de apellido del language\n");
        $actorCreated=false;
    }

    if (empty($DOB))
    {
        echo nl2br("Falta el dato de fecha de nacimiento del language\n");
        $actorCreated=false;
    }

    if ($DOB=="00/00/0000")
    {
        echo nl2br("Falta el dato de fecha de nacimiento del language\n");
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
        echo nl2br("Falta la nacionalidad del language\n");
        $actorCreated=false;
    }

    if ($actorCreated)
    {
    $newLanguage = new Language (null,$firstname, $lastname, $datesave, $idcountry );
    $actorCreated = $newLanguage->saveLanguage();
    }
    
    return $actorCreated;
}

function updateLanguage($actorId,$firstname, $lastname, $DOB, $idcountry)
{
    $actorEdited=true;
    
    if (empty($actorId))
    {
        echo nl2br("Falta el id del language\n");
        $actorEdited=false;
    }

    if (empty($firstname))
    {
        echo nl2br("Falta el dato de nombre del language\n");
        $actorEdited=false;
    }
    
    if (empty($lastname))
    {
        echo nl2br("Falta el dato de apellido del language\n");
        $actorEdited=false;
    }

    if (empty($DOB))
    {
        echo nl2br("Falta el dato de fecha de nacimiento del language\n");
        $actorEdited=false;
    }

    if ($DOB=="00/00/0000")
    {
        echo nl2br("Falta el dato de fecha de nacimiento del language\n");
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
        echo nl2br("Falta la nacionalidad del language\n");
        $actorEdited=false;
    }

    if ($actorEdited)
    {
        $actorEditor = new Language ($actorId,$firstname, $lastname, $datesave, $idcountry );
        $actorEdited = $actorEditor->updateLanguage();
    }
    
    return $actorEdited;
}

function getLanguageData($actorId)
{
    $language = new Language($actorId);
    $actorObject = $language->getItem();

    return $actorObject;
}

function deleteLanguage($actorId)
{
    $language = new Language($actorId);
    $actorDeleted = $language->delete();

    return $actorDeleted;
}

?>


