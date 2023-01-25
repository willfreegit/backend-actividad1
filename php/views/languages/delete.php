<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/director_controller.php');
  require_once('../../controllers/country_controller.php');
  
  $directorId = $_GET['id'];
  $directordeleted = deleteDirector($directorId);
  
  if($directordeleted)
      {
?>
     <div class=row>
        <div class="alert alert-success" role="alert">
          Director borrado correctamente.<br> 
            <a href="directors.php"> Volver at listado de directores</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El director no se ha borrado correctamente.<br> 
            <a href="directors.php"> Volver a intentarlo</a> 
        </div>
      </div>

      <?php
      }
      ?>