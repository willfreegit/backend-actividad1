<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/platform_controller.php');
  require_once('../../controllers/country_controller.php');
  
  $platformId = $_GET['id'];
  $platformObject = getPlatformData($platformId);
  
  $sendData = false;
  $platformEdited= false;
   


  if(isset($_POST['editBtn'])) 
    {   //Se valida si vino del boton crear;   
      $sendData = true;

    }
 
  if ($sendData)
    {

        $name = $_POST['name'];
        $platformEdited = updatePlatform($platformId,$name);
  
    }
    if (!$sendData)
    {
      
?>
 
<h1 class="text-center">Actualizar plataforma</h1>
  <div class="container">
    <form name="edit_platform" action="" method="POST">
      <div class="form-group">
        <label for="name" class="form-label">Nombre</label>
        <input id="name" type="text" name="name"  class="form-control" required placeholder="Ingrese un nombre"
        oninvalid="this.setCustomValidity('Ingrese el nombre de la plataforma')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($platformObject)){echo $platformObject->getName();}?>"
        />
      </div>
 
      <div class="form-group">
        <input id="id" type="hidden" name="id"  class="form-control" 
         value="<?php echo $platformId;?>" />
      </div>

      <div class="form-group">
        <input type="submit"  name="editBtn" class="btn btn-primary mt-2" value="Actualizar">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="platforms.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
<?php
    } else { 
      if ($platformEdited) {
     
  ?>
      <div class=row>
        <div class="alert alert-success" role="alert">
          Plataforma actualizada correctamente.<br> 
            <a href="platforms.php"> Volver al listado de plataformas</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          La plataforma no se ha actualizado correctamente.<br> 
            <a href="update.php"> Volver a intentarlo</a> 
        </div>
      </div>

      <?php
      }
    }
    ?>   

<script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker(
				{format: 'dd/mm/yyyy' ,
        clearBtn: true,
        language: "es"});
        });
  </script>

<!-- Footer -->
<?php include "footer.php" ?>