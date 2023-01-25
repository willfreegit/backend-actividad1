<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/language_controller.php');
    
  $languageId = $_GET['id'];
  $languageObject = getlanguageData($languageId);
  
  $sendData = false;
  $languageEdited= false;
   


  if(isset($_POST['editBtn'])) 
    {   //Se valida si vino del boton crear;   
      $sendData = true;

    }
 
  if ($sendData)
    {

      $language_name = $_POST['language_name'];
      $language_isocode = $_POST['language_isocode'];
       
        $languageEdited = updatelanguage($languageId,$language_name, $language_isocode);
  
    }
    if (!$sendData)
    {
      
?>
 
<h1 class="text-center">Actualizar idioma</h1>
  <div class="container">
    <form name="edit_language" action="" method="POST">
      <div class="form-group">
        <label for="language_name" class="form-label">Idioma</label>
        <input id="language_name" type="text" name="language_name"  class="form-control" required placeholder="Ingrese un nombre"
        oninvalid="this.setCustomValidity('Ingrese el nombre del idioma')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($languageObject)){echo $languageObject->getLanguage_name();}?>"
        />
      </div>
 
      <div class="form-group">
        <label for="language_isocode" class="form-label">Código ISO</label>
        <input id="language_isocode" type="text" name="language_isocode"  class="form-control" required placeholder="Ingrese un código ISO eg. 'es'"
        oninvalid="this.setCustomValidity('Ingrese el código ISO del Idioma')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($languageObject)){echo $languageObject->getLanguage_isocode();}?>" />
      </div>

      <div class="form-group">
        <input id="id" type="hidden" name="id"  class="form-control" 
         value="<?php echo $languageId;?>" />
      </div>

      <div class="form-group">
        <input type="submit"  name="editBtn" class="btn btn-primary mt-2" value="Actualizar">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="languages.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
<?php
    } else { 
      if ($languageEdited) {
     
  ?>
      <div class=row>
        <div class="alert alert-success" role="alert">
          Idioma actualizado correctamente.<br> 
            <a href="languages.php"> Volver al listado de idiomas</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El idioma no se ha actualizado correctamente.<br> 
            <a href="update.php"> Volver a intentarlo</a> 
        </div>
      </div>

      <?php
      }
    }
    ?>   

<!-- Footer -->
<?php include "footer.php" ?>