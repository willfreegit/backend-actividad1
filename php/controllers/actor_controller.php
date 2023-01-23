<?php
require_once('../../models/Actor.php');
require_once('../../db/connection_db.php');

function listActors(){
    $mysqli = (new CconexionDB)->initConnectionDb();

    $actorList = [];
    $query="SELECT * FROM actors";               

    $actores= mysqli_query($mysqli,$query);   
    
    
	while($row = mysqli_fetch_array($actores)){
        $iactor = new Actor($row['id'], $row['firstname'], $row['lastname'], $row['DOB'], $row['idcountry']);
 /*Depuracion de valores que se envian a las vistas
        echo $iactor->getId().'<br>';
        echo $row['firstname'].'<br>';
 */       
        array_push($actorList, $iactor);
    }

    $mysqli ->close( ) ;
    return $actorList;
   }

 
    function saveActor($firstname, $lastname, $DOB, $idcountry){
        $mysqli = (new CconexionDB)->initConnectionDb();
       
        $query= "INSERT INTO actors(firstname, lastname, DOB, idcountry) VALUES('{$firstname}','{$lastname}','{$DOB}','{$idcountry}')";
        $add_actor = mysqli_query($mysqli,$query);
        $mysqli ->close( ) ;
        if($add_actor){
            return true;
        } else {
            echo "Error insert actor: ". mysqli_error($mysqli);
            return false;
        }
       }
    
    

?>