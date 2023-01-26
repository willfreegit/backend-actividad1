<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/language_controller.php');
  
  
  $languageId = $_GET['id'];
  $languagedeleted = deletelanguage($languageId);
  
  if($languagedeleted)
      {
?>
     <div class=row>
        <div class="alert alert-success" role="alert">
          Idioma borrado correctamente.<br> 
            <a href="languages.php"> Volver al listado de idiomas</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El idioma no se ha borrado correctamente.<br> 
            <a href="languages.php"> Volver a intentarlo</a> 
        </div>
      </div>

      <?php
      }
      ?>