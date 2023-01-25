<?php
require_once('../../models/Country.php');
require_once('../../db/connection_db.php');

function listcountries()
{
    $countries= new Country();
    $countryList= $countries->getall();
    $countryObjectArray =[];

    foreach ($countryList as $countryitem) {
        $countryObject=new Country($countryitem->getNum_code(),$countryitem->getAlpha_3_code(),$countryitem->getEn_short_name(),$countryitem->getNationality());
        array_push($countryObjectArray, $countryObject);
    }
    return $countryObjectArray;
}

function storeCountry($country_name, $country_isocode)
{
    $countryCreated=true;
    if (empty($country_name))
    {
        echo nl2br("Falta el dato de nombre del país\n");
        $countryCreated=false;
    }
    
    if (empty($country_isocode))
    {
        echo nl2br("Falta el dato de apellido del país\n");
        $countryCreated=false;
    }

    if ($countryCreated)
    {
    $newCountry = new Country (null,$country_name, $country_isocode);
    $countryCreated = $newCountry->saveCountry();
    }
    
    return $countryCreated;
}

function updateCountry($countryId,$country_name, $country_isocode)
{
    $countryEdited=true;
    
    if (empty($countryId))
    {
        echo nl2br("Falta el id del país\n");
        $countryEdited=false;
    }

    if (empty($country_name))
    {
        echo nl2br("Falta el dato de nombre del país\n");
        $countryEdited=false;
    }
    
    if (empty($country_isocode))
    {
        echo nl2br("Falta el dato de código ISO del país\n");
        $countryEdited=false;
    }

    if ($countryEdited)
    {
        $countryEditor = new Country ($countryId,$country_name, $country_isocode);
        $countryEdited = $countryEditor->updateCountry();
    }
    
    return $countryEdited;
}

function getCountryData($countryId)
{
    $country = new Country($countryId);
    $countryObject = $country->getItem();

    return $countryObject;
}

function deleteCountry($countryId)
{
    $country = new Country($countryId);
    $countryDeleted = $country->delete();

    return $countryDeleted;
}

?>