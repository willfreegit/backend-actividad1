<?php
    require_once('../../php/models/actor.php');
    require_once('../../php/db/connection_db.php');

    function listActors() {
    
    
    $model = new Actor() ;
    $actorList = $model->getAll();
    $actorObjectArray = [];
    
    foreach ($actorList as $actorItem) {
    $actorObject = new Actor($actorItem->getId(), $actorItem->getfirstname(),$actorItem->getlastname(), $actorItem->getDOB(),$actorItem->getidcountry());
    array_push( $actorObjectArray, $actorObject) ;
    }
    return $actorObjectArray;
}

    public function getAll( )
    {

    $mysqli = $this->initConnectionDb() ;
    $query = $mysqli->query("SELECT * FROM actors") ;
    $listData = [];
    foreach ($query as $item) {
    $itemObject = new Actor($item['id'], $item['firstname'], $item['lastname'], $item['DOB'], $item['idcountry'] ) ;
    array_push( $listData, $itemObject) ;
    }
    $mysqli ->close( ) ;
    return $listData;
}

?>