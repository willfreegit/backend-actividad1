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

?>