<!-- Header -->
<!-- para probar hacer un picker con formato dd/mm/yyyy ya que input no deja-->
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
<script type = "text / javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"> </script> 


<!-- fin del cambio -->

<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/director_controller.php');
  require_once('../../controllers/country_controller.php');
  
  $sendData = false;
  $directorCreated= false;
  
  if(isset($_POST['createBtn'])) 
    {   //Se valida si vino del boton crear;   
      $sendData = true;

    }
 
  if ($sendData)
    {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $DOB = $_POST['DOB'];
        $idcountry = $_POST['idcountry'];
        
        $directorCreated = storeDirector($firstname, $lastname, $DOB, $idcountry);
  
    }
    if (!$sendData)
    {
      
?>
 
<h1 class="text-center">Agregar nuevo director</h1>
  <div class="container">
    <form name="create_director" action="" method="post">
      <div class="form-group">
        <label for="firstname" class="form-label">Nombre</label>
        <input type="text" name="firstname"  class="form-control"       required placeholder="Ingrese un nombre"
        oninvalid="this.setCustomValidity('Ingrese el nombre del Director')"
        oninput="this.setCustomValidity('')"/>
      </div>
 
      <div class="form-group">
        <label for="lastname" class="form-label">Apellido</label>
        <input type="text" name="lastname"  class="form-control" required placeholder="Ingrese un apellido"
        oninvalid="this.setCustomValidity('Ingrese el apellido del Director')"
        oninput="this.setCustomValidity('')"/>
      </div>
     
      <div class="form-group">
        <label for="DOB" class="form-label">Fecha de Nacimiento</label>
<!-- para probar hacer un picker con formato dd/mm/yyyy ya que input no deja

        <input type="date"   value="" required pattern="\d{2}-\d{2}-\d{4}" 
        min="1925-01-01" max="2022-12-31" name="DOB"  class="form-control" required 
        oninvalid="this.setCustomValidity('Escoja la fecha de nacimiento del actor')"
        oninput="this.setCustomValidity('')"/>
 -->
        <div class="input-group date" id="datepicker">
                        <input type="text" name="DOB" value="" class="form-control"  required 
        oninvalid="this.setCustomValidity('Escoja la fecha de nacimiento del actor')"
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
        oninput="this.setCustomValidity('')"/>>


        <?php

          $countries = listcountries();
          if(count($countries)> 0) 
          {
            foreach($countries as $country)
            {
              $combobit .=" <option value=\"{$country->getnum_code()}\">{$country->getnationality()}</option>"; 
            }
            echo $combobit;
          }
         ?>     
        </select>
</div>      

      <div class="form-group">
        <input type="submit"  name="createBtn" class="btn btn-primary mt-2" value="Crear">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="directors.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
<?php
    } else { 
      if ($directorCreated) {
     
  ?>
      <div class=row>
        <div class="alert alert-success" role="alert">
          Director creado correctamente.<br> 
            <a href="directors.php"> Volver al listado de directores</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          El director no se ha creado correctamente.<br> 
            <a href="directors.php"> Volver a intentarlo</a> 
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
