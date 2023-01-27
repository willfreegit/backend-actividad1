<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/serie_controller.php');
  require_once('../../controllers/actor_controller.php');
  require_once('../../controllers/director_controller.php');
  require_once('../../controllers/platform_controller.php');
  require_once('../../controllers/language_controller.php');

  $serieId = $_GET['id'];
  $serieObject = getSerieById($serieId);
  
  $languages = listlanguages();
  $subtitles = listlanguages();

  $sendData = false;
  $serieEdited= false;


  if(isset($_POST['editBtn'])) 
    {   //Se valida si vino del boton actualizar;   
      $sendData = true;

    }
 
  if ($sendData)
    {
      $title = $_POST['title'];
      $seasons = $_POST['seasons'];
      $episodes = $_POST['episodes'];
      $idplatform = $_POST['platform'];
      $iddirector = $_POST['director'];
      $idactors = $_POST['actors'];
      
      $serieEdited = updateSerie($serieId,$title, $seasons, $episodes, $idplatform, $iddirector);   
  
    }
    if (!$sendData)
    {
      
?>

<h1 class="text-center">Actualizar Serie</h1>



  <div class="container">
    <form action="" method="post">
      <div class="form-group">
      <h4>Título</h4>
      
        <input type="text" name="title"  class="form-control"  required placeholder="Ingrese un nombre para la serie"
        oninvalid="this.setCustomValidity('Ingrese el nombre de la Serie')"
        oninput="this.setCustomValidity('')"/ value="<?php if(isset($serieObject)){echo $serieObject->getTitle();}?>"
      </div>
 
      <div class="form-group">
      <h4>Temporadas</h4>        

        <input type="number" min="0" step="1" name="seasons"  class="form-control"  required placeholder="Ingrese las temporadas"
        oninvalid="this.setCustomValidity('Ingrese las temporadas')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($serieObject)){echo $serieObject->getSeasons();}?>"
      </div>
      
      <div class="form-group">
      <h4>Episodios</h4>               

        <input type="number" min="0" step="1" name="episodes"  class="form-control"   required placeholder="Ingrese los episodios"
        oninvalid="this.setCustomValidity('Ingrese los episodios')"
        oninput="this.setCustomValidity('')" value="<?php if(isset($serieObject)){echo $serieObject->getEpisodes();}?>"
      </div>    


<!-- Combo box Plataforma -->

      <h4>Plataforma</h4>

        <select name="platform" id="platform"  class="form-control" required placeholder="Escoja una Plataforma"
        oninvalid="this.setCustomValidity('Escoja una Plataforma')"
        oninput="this.setCustomValidity('')"/> >
	  
        <?php
        //validamos cual de los ids es el que tiene que estar seleccionado en el combo box
        $validarcombo=false;
        if(isset($serieObject)){
          $validarcombo=true;
          $idplataformaSel=$serieObject->getIdplatform();
        }
        //fin de validacion

          $platforms = listplatforms();

          if(count($platforms)> 0) 
          {
            foreach($platforms as $platform)
            {
              $idplatform=$platform->getId();
              $desplatform=$platform->getName();
              if (!$validarcombo)
                {//si no viene de actualizar se carga normal
                  $comboplat .=" <option value=\"{$idplatform}\">{$desplatform}</option>"; 
                }
              elseif($idplatform==$idplataformaSel){//si viene de actualizar y es el valor anterior se selecciona
                    $comboplat .=" <option value=\"{$idplatform}\" selected>{$desplatform}</option>"; 
                  }
              else{//si viene de actualizar y no es el valor anterior se carga normal
                    $comboplat .=" <option value=\"{$idplatform}\">{$desplatform}</option>"; 
                  }
                }
            }
            echo $comboplat;
          
         ?>     
        </select>
</div>      


<!--  Combo box Director -->

      <h4>Director</h4>

        <select name="director" id="director"  class="form-control" required placeholder="Escoja un director"
        oninvalid="this.setCustomValidity('Escoja un director')"
        oninput="this.setCustomValidity('')"/> >
	  
        <?php
        //validamos cual de los ids es el que tiene que estar seleccionado en el combo box
        $validarcombo=false;
        if(isset($serieObject)){
          $validarcombo=true;
          $iddirectorSel=$serieObject->getIddirector();
        }
        //fin de validacion
		
		$directors = listdirectors();		

          if(count($directors)> 0) 
          {
            foreach($directors as $director)
            {
              $iddirector=$director->getId();
              $desdirector=$director->getFirstname().' '.$director->getLastName();  
              if (!$validarcombo)
                {//si no viene de actualizar se carga normal
                  $combodire .=" <option value=\"{$iddirector}\">{$desdirector}</option>"; 
                }
              elseif($iddirector==$iddirectorSel){//si viene de actualizar y es el valor anterior se selecciona
                    $combodire .=" <option value=\"{$iddirector}\" selected>{$desdirector}</option>"; 
                  }
              else{//si viene de actualizar y no es el valor anterior se carga normal
                    $combodire .=" <option value=\"{$iddirector}\">{$desdirector}</option>"; 
                  }
                }
            }
            echo $combodire;
            
         ?>     
        </select>
</div>      

<!--  Listbox Actores -->

      <h4>Actores</h4>
      
      <select name="actors[]" id="actors"  multiple class="form-control" required placeholder="Escoja un actor"
        oninvalid="this.setCustomValidity('Escoja un actor')"
        oninput="this.setCustomValidity('')"/> >

        <?php
        //validamos cual de los ids es el que tiene que estar seleccionado en el combo box
        $validarcombo=false;
        if(isset($serieObject)){
          $validarcombo=true;
    		  $actors_serie = listActorsSerie($serieId);
        }
        //fin de validacion
		
	    	$actors = listactors();		

          if(count($actors)> 0) 
          { 
            foreach($actors as $actor)
            {
              $idactor=$actor->getId();
              $desactor=$actor->getFirstname().' '.$actor->getLastName();  
              
              if (!$validarcombo)
                {//si no viene de actualizar se carga normal
                  $comboact .=" <option value=\"{$idactor}\">{$desactor}</option>"; 
                }
			  else {
				
				
					foreach($actors_serie as $actorsel) { 
						$idactorSel=$actorsel->getId();
				
					  if($idactor==$idactorSel){//si viene de actualizar y es el valor anterior se selecciona
							$comboact .=" <option value=\"{$idactor}\" selected>{$desactor}</option>"; 
						  }
					  else{//si viene de actualizar y no es el valor anterior se carga normal
							$comboact .=" <option value=\"{$idactor}\">{$desactor}</option>"; 
						  }
					   }
                 }
				}
            }
            echo $comboact;
          
         ?>     
        </select>
</div>      
<h4>Idiomas</h4>
      <select name="languages[]" multiple class="form-control">
        <?php
        foreach($languages as $row) { ?>
					<option value="<?php echo $row->getId(); ?>"><?php echo $row->getLanguage_name(); ?></option>
				<?php } ?>
      </select>
      <h4>Subtítulos</h4>
      <select name="subtitles[]" multiple class="form-control">
        <?php
        foreach($subtitles as $row) { ?>
					<option value="<?php echo $row->getId(); ?>"><?php echo $row->getLanguage_name(); ?></option>
				<?php } ?>
      </select>

      



      <div class="form-group">
        <input type="submit"  name="editBtn" class="btn btn-primary mt-2" value="Actualizar">
      </div>
    </form> 
  </div>
   
  <div class="container text-center mt-5">
    <a href="series.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
 
  <?php
    } else { 
      if ($serieEdited) {
     
  ?>
      <div class=row>
        <div class="alert alert-success" role="alert">
          Serie creada correctamente.<br> 
            <a href="series.php"> Volver al listado de series</a> 
        </div>
      </div>
      <?php
      } else {
     
      ?>
      <div class=row>
        <div class="alert alert-danger" role="alert">
          La serie no se ha creado correctamente.<br> 
            <a href="series.php"> Volver a intentarlo</a> 
        </div>
      </div>


      <?php
      }
    }
    ?>   

<!-- Footer -->
<?php include "footer.php" ?>