<?php

function OpenConn(){
  $host = 'localhost';
  $user = 'root';   
  $pass = "";   
  $database = 'php_crud';
  $conn = mysqli_connect($host,$user,$pass,$database);   
  if (!$conn) {                                             
      die("Connection failed: " . mysqli_connect_error());     
  }
  return $conn;
}

function CloseConn($conn){
  $conn -> close();
}

 class CconexionDB{
 
  function initConnectionDb(){
    $dbhost = 'localhost';
    $dbuser = 'root';   
    $dbpass = "";   
    $dbdatabase = 'php_crud';
    
    $mysqli = (new mysqli($dbhost,$dbuser,$dbpass,$dbdatabase));   
    if ($mysqli->connect_error) {                                               
        die("Connection failed: " .$mysqli->connect_error);     
    }
    return $mysqli;
  }

 }
?>