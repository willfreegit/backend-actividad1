<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/actor_controller.php');
  require_once('../../controllers/country_controller.php');
  
  $idActor = $_GET['id'];
  $actorObject = getActorData($idActor);
  
  $sendData = false;
  $actorEdited= false;
   


  if(isset($_POST['editBtn'])) 
    {   //Se valida si vino del boton crear;   
      $sendData = true;

    }
 
  if ($sendData)
    {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $DOB = $_POST['DOB'];
        $idcountry = $_POST['idcountry'];
        
        $actorEdited = updateActor($idActor,$firstname, $lastname, $DOB, $idcountry);
  
    }
    if (!$sendData)
    {
      
?>
 
<h1 class="text-center">Actualizar actor</h1>
  <div class="container">
    <form name="edit_actor" action="" method="POST">
      <div class="form-group">
        <label for="firstname" class="form-label">Nombre</label>
        <input id="firstname" type="text" name="firstname"  class="form-control" required placeholder="Ingrese un nombre"
        oninvalid="this.setCustomValidity('Ingrese el nombre del Actor')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($actorObject)){echo $actorObject->getFirstname();}?>"
        />
      </div>
 
      <div class="form-group">
        <label for="lastname" class="form-label">Apellido</label>
        <input id="lastname" type="text" name="lastname"  class="form-control" required placeholder="Ingrese un apellido"
        oninvalid="this.setCustomValidity('Ingrese el apellido del Actor')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($actorObject)){echo $actorObject->getLastname();}?>" />
      </div>
     
      <div class="form-group">
        <label for="DOB" class="form-label">Fecha de Nacimiento</label>

        <!-- para probar hacer un picker con formato dd/mm/yyyy ya que input no deja-->
        <?php if(isset($actorObject)){
          $fecha=$actorObject->getDOB();
          $dt = new DateTime($fecha);
          $fechastr=$dt->format('Y-m-d');
//          echo $fechastr;
          }?>
        <input type="date"   
        min="1925-01-01" max="2022-12-31" id="DOB" name="DOB"  class="form-control" required 
        oninvalid="this.setCustomValidity('Escoja la fecha de nacimiento del actor')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($actorObject)){
          echo $fechastr;}?>"
        />
        
          
      <div class="form-group">
        <label for="idcountry" class="form-label">Nacionalidad</label>

        <select name="idcountry" id="idcountry"  class="form-control" required placeholder="Escoja una nacionalidad"
        oninvalid="this.setCustomValidity('Escoja una nacionalidad')"
        oninput="this.setCustomValidity('')"/> >


        <?php

        //validamos cual de los ids es el que tiene que estar seleccionado en el combo box
        $validarcombo=false;
        if(isset($actorObject)){
          $validarcombo=true;
          $idnacionalidad=$actorObject->getIdcountry();
        }
        //fin de validacion

          $countries = listcountries();

          if(count($countries)> 0) 
          {
            foreach($countries as $country)
            {
              $idcountry=$country->getnum_code();
              $descountry=$country->getnationality();
              if (!$validarcombo)
                {//si no viene de actualizar se carga normal
                  $combobit .=" <option value=\"{$idcountry}\">{$descountry}</option>"; 
                }
              elseif($idcountry==$idnacionalidad){//si viene de actualizar y es el valor anterior se selecciona
                    $combobit .=" <option value=\"{$idcountry}\" selected>{$descountry}</option>"; 
                  }
              else{//si viene de actualizar y no es el valor anterior se carga normal
                    $combobit .=" <option value=\"{$idcountry}\">{$descountry}</option>"; 
                  }
                }
            }
            echo $combobit;
          
         ?>     
        </select>
</div>      

      <div class="form-group">
        <input id="id" type="hidden" name="id"  class="form-control" 
         value="<?php echo $idActor;?>" />
      </div>

      <div class="form-group">
        <input type="submit"  name="editBtn" class="btn btn-primary mt-2" value="Actualizar">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="actors.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
<?php
    } else { 
      if ($actorEdited) {
     
  ?>
      <div class=row>
        <div class="alert alert-success" role="alert">
          Actor actualizado correctamente.<br> 
            <a href="actors.php"> Volver at listado de actores</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El actor no se ha actualizado correctamente.<br> 
            <a href="update.php"> Volver a intentarlo</a> 
        </div>
      </div>

      <?php
      }
    }
    ?>   
 
<!-- Footer -->
<?php include "footer.php" ?>

