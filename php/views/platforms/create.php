<!-- Header -->
<!-- para probar hacer un picker con formato dd/mm/yyyy ya que input no deja-->
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
<script type = "text / javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"> </script> 


<!-- fin del cambio -->

<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/platform_controller.php');
  require_once('../../controllers/country_controller.php');
  
  $sendData = false;
  $platformCreated= false;
  
  if(isset($_POST['createBtn'])) 
    {   //Se valida si vino del boton crear;   
      $sendData = true;

    }
 
  if ($sendData)
    {
        $name = $_POST['name'];
        $platformCreated = storePlatform($name);
  
    }
    if (!$sendData)
    {
      
?>
 
<h1 class="text-center">Agregar nueva Plataforma</h1>
  <div class="container">
    <form name="create_platform" action="" method="post">
      <div class="form-group">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" name="name"  class="form-control"       required placeholder="Ingrese un nombre"
        oninvalid="this.setCustomValidity('Ingrese el nombre de la plataforma')"
        oninput="this.setCustomValidity('')"/>
      </div>

      <div class="form-group">
        <input type="submit"  name="createBtn" class="btn btn-primary mt-2" value="Crear">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="platforms.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
<?php
    } else { 
      if ($platformCreated) {
     
  ?>
      <div class=row>
        <div class="alert alert-success" role="alert">
          Platforma creada correctamente.<br> 
            <a href="platforms.php"> Volver al listado de plataformas</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          La plataforma no se ha creado correctamente.<br> 
            <a href="platforms.php"> Volver a intentarlo</a> 
        </div>
      </div>

      <?php
      }
    }
    ?>   
 

<!-- Footer -->
<?php include "footer.php" ?>
