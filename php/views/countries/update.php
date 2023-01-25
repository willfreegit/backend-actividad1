<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/country_controller.php');
    
  $countryId = $_GET['id'];
  $countryObject = getcountryData($countryId);
  
  $sendData = false;
  $countryEdited= false;
   


  if(isset($_POST['editBtn'])) 
    {   //Se valida si vino del boton crear;   
      $sendData = true;

    }
 
  if ($sendData)
    {

      $country_name = $_POST['country_name'];
      $country_isocode = $_POST['country_isocode'];
       
        $countryEdited = updatecountry($countryId,$country_name, $country_isocode);
  
    }
    if (!$sendData)
    {
      
?>
 
<h1 class="text-center">Actualizar país</h1>
  <div class="container">
    <form name="edit_country" action="" method="POST">
      <div class="form-group">
        <label for="country_name" class="form-label">País</label>
        <input id="country_name" type="text" name="country_name"  class="form-control" required placeholder="Ingrese un nombre"
        oninvalid="this.setCustomValidity('Ingrese el nombre del país')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($countryObject)){echo $countryObject->getCountry_name();}?>"
        />
      </div>
 
      <div class="form-group">
        <label for="country_isocode" class="form-label">Código ISO</label>
        <input id="country_isocode" type="text" name="country_isocode"  class="form-control" required placeholder="Ingrese un código ISO eg. 'es'"
        oninvalid="this.setCustomValidity('Ingrese el código ISO del país')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($countryObject)){echo $countryObject->getCountry_isocode();}?>" />
      </div>

      <div class="form-group">
        <input id="id" type="hidden" name="id"  class="form-control" 
         value="<?php echo $countryId;?>" />
      </div>

      <div class="form-group">
        <input type="submit"  name="editBtn" class="btn btn-primary mt-2" value="Actualizar">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="countries.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
<?php
    } else { 
      if ($countryEdited) {
     
  ?>
      <div class=row>
        <div class="alert alert-success" role="alert">
          País actualizado correctamente.<br> 
            <a href="countries.php"> Volver al listado de paises</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El país no se ha actualizado correctamente.<br> 
            <a href="countries.php"> Volver a intentarlo</a> 
        </div>
      </div>

      <?php
      }
    }
    ?>   

<!-- Footer -->
<?php include "footer.php" ?>