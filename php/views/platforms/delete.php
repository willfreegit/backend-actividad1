<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/platform_controller.php');
  require_once('../../controllers/country_controller.php');
  
  $platformId = $_GET['id'];
  $platformdeleted = deletePlatform($platformId);
  
  if($platformdeleted)
      {
?>
     <div class=row>
        <div class="alert alert-success" role="alert">
          Plataforma borrada correctamente.<br> 
            <a href="platforms.php"> Volver al listado de plataformas</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          La plataforma no se ha borrado correctamente.<br> 
            <a href="platforms.php"> Volver a intentarlo</a> 
        </div>
      </div>

      <?php
      }
      ?>