<?php
require_once('../../models/Platform.php');
require_once('../../db/connection_db.php');

function listplatforms()
{
    $platforms= new Platform();
    $platformList= $platforms->getall();
    $platformObjectArray =[];

    foreach ($platformList as $platformitem) {
        $platformObject=new Platform($platformitem->getId(),$platformitem->getName());
        array_push($platformObjectArray, $platformObject);
    }
    return $platformObjectArray;
}


function storePlatform($name)
{
    $platformCreated=true;
    if (empty($name))
    {
        echo nl2br("Falta el dato de nombre de la plataforma\n");
        $platformCreated=false;
    }

    if ($platformCreated)
    {
		$newPlatform = new Platform (null,$name);
		$platformCreated = $newPlatform->savePlatform();
    }
    
    return $platformCreated;
}

function updatePlatform($platformId,$name)
{
    $platformEdited=true;
    
    if (empty($platformId))
    {
        echo nl2br("Falta el id de la plataforma\n");
        $platformEdited=false;
    }

    if (empty($name))
    {
        echo nl2br("Falta el dato de nombre de la plataforma\n");
        $platformEdited=false;
    }

    if ($platformEdited)
    {
        $platformEditor = new Platform ($platformId,$name);
        $platformEdited = $platformEditor->updatePlatform();
    }
    
    return $platformEdited;
}

function getPlatformData($platformId)
{
    $platform = new Platform($platformId);
    $platformObject = $platform->getItem();

    return $platformObject;
}

function deletePlatform($platformId)
{
    $platform = new Platform($platformId);
    $platformDeleted = $platform->delete();

    return $platformDeleted;
}

?>


