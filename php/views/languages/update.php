<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/director_controller.php');
  require_once('../../controllers/country_controller.php');
  
  $directorId = $_GET['id'];
  $directorObject = getDirectorData($directorId);
  
  $sendData = false;
  $directorEdited= false;
   


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
        
        $directorEdited = updateDirector($directorId,$firstname, $lastname, $DOB, $idcountry);
  
    }
    if (!$sendData)
    {
      
?>
 
<h1 class="text-center">Actualizar language</h1>
  <div class="container">
    <form name="edit_director" action="" method="POST">
      <div class="form-group">
        <label for="firstname" class="form-label">Nombre</label>
        <input id="firstname" type="text" name="firstname"  class="form-control" required placeholder="Ingrese un nombre"
        oninvalid="this.setCustomValidity('Ingrese el nombre del Language')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($directorObject)){echo $directorObject->getFirstname();}?>"
        />
      </div>
 
      <div class="form-group">
        <label for="lastname" class="form-label">Apellido</label>
        <input id="lastname" type="text" name="lastname"  class="form-control" required placeholder="Ingrese un apellido"
        oninvalid="this.setCustomValidity('Ingrese el apellido del Language')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($directorObject)){echo $directorObject->getLastname();}?>" />
      </div>

      <div class="form-group">
        <label for="DOB" class="form-label">Fecha de Nacimiento</label>

        <div class="input-group date" id="datepicker">
                        <input type="text" name="DOB" value="<?php if(isset($directorObject)){echo $directorObject->getDOB();}?>" class="form-control"  required 
        oninvalid="this.setCustomValidity('Escoja la fecha de nacimiento del language')"
        oninput="this.setCustomValidity('')" >
        <span class="input-group-append">
              <span class="input-group-text bg-white">
                  <i class="fa fa-calendar"></i>
              </span>
          </span>
        </div>

      
         
      <div class="form-group">
        <label for="idcountry" class="form-label">Nacionalidad</label>

        <select name="idcountry" id="idcountry"  class="form-control" required placeholder="Escoja una nacionalidad"
        oninvalid="this.setCustomValidity('Escoja una nacionalidad')"
        oninput="this.setCustomValidity('')"/> >


        <?php

        //validamos cual de los ids es el que tiene que estar seleccionado en el combo box
        $validarcombo=false;
        if(isset($directorObject)){
          $validarcombo=true;
          $idnacionalidad=$directorObject->getIdcountry();
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
         value="<?php echo $directorId;?>" />
      </div>

      <div class="form-group">
        <input type="submit"  name="editBtn" class="btn btn-primary mt-2" value="Actualizar">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="directors.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
<?php
    } else { 
      if ($directorEdited) {
     
  ?>
      <div class=row>
        <div class="alert alert-success" role="alert">
          Language actualizado correctamente.<br> 
            <a href="directors.php"> Volver at listado de languages</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El language no se ha actualizado correctamente.<br> 
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