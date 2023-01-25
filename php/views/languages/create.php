<!-- Header -->

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
<script type = "text / javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"> </script> 


<!-- fin del cambio -->

<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/language_controller.php');
  
  
  $sendData = false;
  $languageCreated= false;
  
  if(isset($_POST['createBtn'])) 
    {   //Se valida si vino del boton crear;   
      $sendData = true;

    }
 
  if ($sendData)
    {

        $language_name = $_POST['language_name'];
        $language_isocode = $_POST['language_isocode'];

        
        $languageCreated = storelanguage($language_name, $language_isocode);
  
    }
    if (!$sendData)
    {
      
?>
 
<h1 class="text-center">Agregar nuevo Idioma</h1>
  <div class="container">
    <form name="create_language" action="" method="post">
      <div class="form-group">
        <label for="language_name" class="form-label">Idioma</label>
        <input type="text" name="language_name"  class="form-control" required placeholder="Ingrese un nombre"
        oninvalid="this.setCustomValidity('Ingrese el nombre del idioma')"
        oninput="this.setCustomValidity('')"/>
      </div>
 
      <div class="form-group">
        <label for="language_isocode" class="form-label">ISO Code</label>
        <input type="text" name="language_isocode"  class="form-control" required placeholder="Ingrese un código ISO eg. 'es'"
        oninvalid="this.setCustomValidity('Ingrese el código ISO del Idioma')"
        oninput="this.setCustomValidity('')"/>
      </div>
     
   
      <div class="form-group">
        <input type="submit"  name="createBtn" class="btn btn-primary mt-2" value="Crear">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="language.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
<?php
    } else { 
      if ($languageCreated) {
     
  ?>
      <div class=row>
        <div class="alert alert-success" role="alert">
          Idioma creado correctamente.<br> 
            <a href="language.php"> Volver al listado de idiomas</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El idioma no se ha creado correctamente.<br> 
            <a href="create.php"> Volver a intentarlo</a> 
            </div>
      </div>

      <?php
      }
    }
    ?>   

<!-- Footer -->
<?php include "footer.php" ?>
