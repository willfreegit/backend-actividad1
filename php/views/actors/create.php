<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/actor_controller.php');
  if(isset($_POST['create'])) 
    {      
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $DOB = $_POST['DOB'];
      $idcountry = $_POST['idcountry'];
      
      $add = saveActor($firstname, $lastname, $DOB, $idcountry);
      if (!$add) {
          echo "A ocurrido un error al crear el actor";
      } else { 
          echo "<script type='text/javascript'>alert('Actor creado correctamente!')</script>";
      }         
    }
?>
 
<h1 class="text-center">Agregar nuevo actor</h1>
  <div class="container">
    <form action="" method="post">
      <div class="form-group">
        <label for="firstname" class="form-label">Nombre</label>
        <input type="text" name="firstname"  class="form-control">
      </div>
 
      <div class="form-group">
        <label for="lastname" class="form-label">Apellido</label>
        <input type="text" name="lastname"  class="form-control">
      </div>
     
      <div class="form-group">
        <label for="DOB" class="form-label">Fecha de Nacimiento</label>
        <input type="date" name="DOB"  class="form-control">
      </div>    
      <div class="form-group">
        <label for="idcountry" class="form-label">Nacionalidad</label>
        <input type="text" name="idcountry"  class="form-control">
      </div>
      <div class="form-group">
        <input type="submit"  name="create" class="btn btn-primary mt-2" value="submit">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="actors.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
 
<!-- Footer -->
<?php include "footer.php" ?>