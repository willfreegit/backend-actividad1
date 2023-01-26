<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/country_controller.php');
  
  
  $countryId = $_GET['id'];
  $countrydeleted = deletecountry($countryId);
  
  if($countrydeleted)
      {
?>
     <div class=row>
        <div class="alert alert-success" role="alert">
          País borrado correctamente.<br> 
            <a href="countries.php"> Volver al listado de paises</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El país no se ha borrado correctamente.<br> 
            <a href="countries.php"> Volver a intentarlo</a> 
        </div>
      </div>

      <?php
      }
      ?>