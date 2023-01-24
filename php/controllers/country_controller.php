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

?>