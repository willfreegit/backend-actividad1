<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/actor_controller.php');
  
  $sendData = false;
  $actorCreated= false;
  
  if(isset($_POST['createBtn'])) 
    {   //Se valida si vino del boton crear;   
      $sendData = true;

    //controles en formulario para validar que no esten vacios
    if(!isset($_POST['firstname']))
        {echo "Falta el nombre del Actor";
          $sendData = false;
        }

    if(!isset($_POST['lastname']))
      {echo "Falta el apellido del Actor";
        $sendData = false;
      }

    if(!isset($_POST['DOB']))
      {echo "Falta la fecha de nacimiento del Actor";
        $sendData = false;
      }

      if(!isset($_POST['idcountry']))
      {
          echo "Falta la nacionalidad del Actor";
        $sendData = false;
      }
          

    }
 
  if ($sendData)
    {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $DOB = $_POST['DOB'];
        $idcountry = $_POST['idcountry'];
        
        $actorCreated = storeActor($firstname, $lastname, $DOB, $idcountry);
  
    }
    if (!$sendData)
    {
 
?>
 
<h1 class="text-center">Agregar nuevo actor</h1>
  <div class="container">
    <form name="create_actor" action="" method="post">
      <div class="form-group">
        <label for="firstname" class="form-label">Nombre</label>
        <input type="text" name="firstname"  class="form-control" 
  />
      </div>
 
      <div class="form-group">
        <label for="lastname" class="form-label">Apellido</label>
        <input type="text" name="lastname"  class="form-control" required placeholder="Ingrese un apellido"
        oninvalid="this.setCustomValidity('Ingrese el apellido del Actor')"
        oninput="this.setCustomValidity('')"/>
      </div>
     
      <div class="form-group">
        <label for="DOB" class="form-label">Fecha de Nacimiento</label>
        <input type="date"  placeholder="dd-mm-yyyy" value=""
        min="1925-01-01" max="2022-12-31" name="DOB"  class="form-control" >
      </div>    
      <div class="form-group">
        <label for="idcountry" class="form-label">Nacionalidad</label>
        <input type="text" name="idcountry"  class="form-control"  required placeholder="Escoja una nacionalidad"
        oninvalid="this.setCustomValidity('Escoja una nacionalidad')"
        oninput="this.setCustomValidity('')"/>
      </div>
      <div class="form-group">
        <input type="submit"  name="createBtn" class="btn btn-primary mt-2" value="Crear">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="actors.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
<?php
    } else { 
      if ($actorCreated) {
     
  ?>
      <div class=row>
        <div class="alert alert-success" role="alert">
          Actor creado correctamente.<br> 
            <a href="actors.php"> Volver at listado de actores</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El actor no se ha creado correctamente.<br> 
            <a href="create.php"> Volver a intentarlo</a> 
        </div>
      </div>

      <?php
      }
    }
    ?>   
 
<!-- Footer -->
<?php include "footer.php" ?>