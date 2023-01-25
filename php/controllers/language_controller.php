<?php
require_once('../../models/Language.php');
require_once('../../db/connection_db.php');

function listlanguages()
{
    $languages= new Language();
    $languageList= $languages->getall();
    $languageObjectArray =[];

    foreach ($languageList as $languageitem) {
        $languageObject=new Language($languageitem->getId(),$languageitem->getLanguage_name(),$languageitem->getLanguage_isocode());
        array_push($languageObjectArray, $languageObject);
    }
    return $languageObjectArray;
}


function storeLanguage($language_name, $language_isocode)
{
    $languageCreated=true;
    if (empty($language_name))
    {
        echo nl2br("Falta el dato de nombre del idioma\n");
        $languageCreated=false;
    }
    
    if (empty($language_isocode))
    {
        echo nl2br("Falta el dato de apellido del idioma\n");
        $languageCreated=false;
    }

    if ($languageCreated)
    {
    $newLanguage = new Language (null,$language_name, $language_isocode);
    $languageCreated = $newLanguage->saveLanguage();
    }
    
    return $languageCreated;
}

function updateLanguage($languageId,$language_name, $language_isocode)
{
    $languageEdited=true;
    
    if (empty($languageId))
    {
        echo nl2br("Falta el id del idioma\n");
        $languageEdited=false;
    }

    if (empty($language_name))
    {
        echo nl2br("Falta el dato de nombre del idioma\n");
        $languageEdited=false;
    }
    
    if (empty($language_isocode))
    {
        echo nl2br("Falta el dato de código ISO del idioma\n");
        $languageEdited=false;
    }

    if ($languageEdited)
    {
        $languageEditor = new Language ($languageId,$language_name, $language_isocode);
        $languageEdited = $languageEditor->updateLanguage();
    }
    
    return $languageEdited;
}

function getLanguageData($languageId)
{
    $language = new Language($languageId);
    $languageObject = $language->getItem();

    return $languageObject;
}

function deleteLanguage($languageId)
{
    $language = new Language($languageId);
    $languageDeleted = $language->delete();

    return $languageDeleted;
}

?>