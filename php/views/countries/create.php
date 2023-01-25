<!-- Header -->

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
<script type = "text / javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"> </script> 


<!-- fin del cambio -->

<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/country_controller.php');
  
  
  $sendData = false;
  $countryCreated= false;
  
  if(isset($_POST['createBtn'])) 
    {   //Se valida si vino del boton crear;   
      $sendData = true;

    }
 
  if ($sendData)
    {

        $country_name = $_POST['country_name'];
        $country_alphacode = $_POST['country_alphacode'];
        $country_nacionalidad = $_POST['country_nacionalidad'];
        
        $countryCreated = storeCountry($country_name, $country_alphacode,$country_nacionalidad);
  
    }
    if (!$sendData)
    {
      
?>
 
<h1 class="text-center">Agregar nuevo País</h1>
  <div class="container">
    <form name="create_country" action="" method="post">
      <div class="form-group">
        <label for="country_name" class="form-label">País</label>
        <input type="text" name="country_name"  class="form-control" required placeholder="Ingrese un nombre"
        oninvalid="this.setCustomValidity('Ingrese el nombre del país')"
        oninput="this.setCustomValidity('')"/>
      </div>
 
      <div class="form-group">
        <label for="country_alphacode" class="form-label">Código Alpha</label>
        <input type="text" name="country_alphacode"  class="form-control" required placeholder="Ingrese el código Alpha del país eg. 'ESP'"
        oninvalid="this.setCustomValidity('Ingrese el código Alpha del país')"
        oninput="this.setCustomValidity('')"/>
      </div>
   
      <div class="form-group">
        <label for="country_nacionalidad" class="form-label">Nacionalidad</label>
        <input type="text" name="country_nacionalidad"  class="form-control" required placeholder="Ingrese la nacionalidad."
        oninvalid="this.setCustomValidity('Ingrese la nacionalidad.')"
        oninput="this.setCustomValidity('')"/>
      </div>

      

   
      <div class="form-group">
        <input type="submit"  name="createBtn" class="btn btn-primary mt-2" value="Crear">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="countries.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
<?php
    } else { 
      if ($countryCreated) {
     
  ?>
      <div class=row>
        <div class="alert alert-success" role="alert">
          País creado correctamente.<br> 
            <a href="countries.php"> Volver al listado de paises</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El país no se ha creado correctamente.<br> 
            <a href="create.php"> Volver a intentarlo</a> 
            </div>
      </div>

      <?php
      }
    }
    ?>   

<!-- Footer -->
<?php include "footer.php" ?>
