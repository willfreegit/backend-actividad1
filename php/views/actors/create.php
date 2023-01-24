<!-- Header -->
<!-- para probar hacer un picker con formato dd/mm/yyyy ya que input no deja-->
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
<script type = "text / javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"> </script> 


<!-- fin del cambio -->

<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/actor_controller.php');
  require_once('../../controllers/country_controller.php');
  
  $sendData = false;
  $actorCreated= false;
  
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
        <input type="text" name="firstname"  class="form-control"       required placeholder="Ingrese un nombre"
        oninvalid="this.setCustomValidity('Ingrese el nombre del Actor')"
        oninput="this.setCustomValidity('')"/>
      </div>
 
      <div class="form-group">
        <label for="lastname" class="form-label">Apellido</label>
        <input type="text" name="lastname"  class="form-control" required placeholder="Ingrese un apellido"
        oninvalid="this.setCustomValidity('Ingrese el apellido del Actor')"
        oninput="this.setCustomValidity('')"/>
      </div>
     
      <div class="form-group">
        <label for="DOB" class="form-label">Fecha de Nacimiento</label>
<!-- para probar hacer un picker con formato dd/mm/yyyy ya que input no deja-->

        <input type="date"   value="" required pattern="\d{2}-\d{2}-\d{4}" 
        min="1925-01-01" max="2022-12-31" name="DOB"  class="form-control" required 
        oninvalid="this.setCustomValidity('Escoja la fecha de nacimiento del actor')"
        oninput="this.setCustomValidity('')"/>
          
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
<script>
   $(function () {
   var bindDatePicker = function() {
		$(".date").datetimepicker({
        format:'DD-MM-YYYY',
			icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			}
		}).find('input:first').on("blur",function () {
			// check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
			// update the format if it's yyyy-mm-dd
			var date = parseDate($(this).val());

			if (! isValidDate(date)) {
				//create date based on momentjs (we have that)
				date = moment().format('YYYY-MM-DD');
			}

			$(this).val(date);
		});
	}
   
   var isValidDate = function(value, format) {
		format = format || false;
		// lets parse the date to the best of our knowledge
		if (format) {
			value = parseDate(value);
		}

		var timestamp = Date.parse(value);

		return isNaN(timestamp) == false;
   }
   
   var parseDate = function(value) {
		var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
		if (m)
			value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

		return value;
   }
   
   bindDatePicker();
 });
 </script>