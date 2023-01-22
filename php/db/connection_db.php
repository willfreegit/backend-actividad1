<?php

function OpenConn(){
  $host = 'localhost';
  $user = 'root';   
  $pass = "";   
  $database = 'actividad1';
  $conn = mysqli_connect($host,$user,$pass,$database);   
  if (!$conn) {                                             
      die("Connection failed: " . mysqli_connect_error());     
  }
  return $conn;
}

function CloseConn($conn){
  $conn -> close();
}

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