<?php  include "header.php" ?>
<?php 
     require_once('../../controllers/serie_controller.php');
     echo 'ingresa a borrar';
     if(isset($_GET['delete']))
     {
         $serie_id= $_GET['delete'];
         deleteSerie($serie_id);
         header("Location: series.php");
     }
    ?>
<?php include "footer.php" ?>