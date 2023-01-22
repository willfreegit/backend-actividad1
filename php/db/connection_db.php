<?php
function initConnectionDb(){
  $dbhost = 'localhost';
  $dbuser = 'root';   
  $dbpass = "root";   
  $dbdatabase = 'actividad1';
  
  $mysqli = (new mysqli($dbhost,$dbuser,$dbpass,$dbdatabase));   
  if ($mysqli->connect_error) {                                               
      die("Connection failed: " .$mysqli->connect_error);     
  }
  return $mysqli;
}

?>