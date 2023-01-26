<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/actor_controller.php');
  require_once('../../controllers/country_controller.php');
  
  $actorId = $_GET['id'];
  $actordeleted = deleteActor($actorId);
  
  if($actordeleted)
      {
?>
     <div class=row>
        <div class="alert alert-success" role="alert">
          Actor borrado correctamente.<br> 
            <a href="actors.php"> Volver al listado de actores</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El actor no se ha borrado correctamente.<br> 
            <a href="actors.php"> Volver a intentarlo</a> 
        </div>
      </div>

      <?php
      }
      ?>