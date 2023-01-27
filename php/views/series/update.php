<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
global $comboact1;
global $comboact2;
global $comboplat;
global $combodire;
global $comboact;



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
      $idactors = $_POST['actores'];
      $idlanguages = $_POST['idiomas'];
      $idsubtitles = $_POST['subtitulos'];
      
      $serieEdited = updateSerie($serieId,$title, $seasons, $episodes, $idplatform, $iddirector, $idactors, $idlanguages,$idsubtitles);   
  
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
      <div>
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
      <div>
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
      <div>      
      <select name="actores[]"  multiple class="form-control" required placeholder="Escoja un actor"
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
<div>
<select name="idiomas[]"  multiple class="form-control" required placeholder="Escoja un idioma"
  oninvalid="this.setCustomValidity('Escoja un idioma')"
  oninput="this.setCustomValidity('')" >

  <?php
  //validamos cual de los ids es el que tiene que estar seleccionado en el combo box
  $validarcombo=false;
  if(isset($serieObject)){
    $validarcombo=true;
    $language_serie = listlanguagesSerie($serieId);
  }
  //fin de validacion

  $languages = listlanguages();		

    if(count($languages)> 0) 
    { 
      foreach($languages as $language)
      {
        $idlanguage=$language->getId();
        $deslanguage=$language->getLanguage_name();  
        
        if (!$validarcombo)
          {//si no viene de actualizar se carga normal
            $comboact1 .=" <option value=\"{$idlanguage}\">{$deslanguage}</option>"; 
          }
  else {
  
  
    foreach($language_serie as $languagesel) { 
      $idlanguagesel=$languagesel->getId();
  
      if($idlanguage==$idlanguagesel){//si viene de actualizar y es el valor anterior se selecciona
        $comboact1 .=" <option value=\"{$idlanguage}\" selected>{$deslanguage}</option>"; 
        }
      else{//si viene de actualizar y no es el valor anterior se carga normal
        $comboact1 .=" <option value=\"{$idlanguage}\">{$deslanguage}</option>"; 
        }
        }
            }
  }
      }
      echo $comboact1;
    
    ?>     
  </select>
</div>      

      
<h4>Subtítulos</h4>
<div>
<select name="subtitulos[]"   multiple class="form-control" required placeholder="Escoja un subtitulo"
  oninvalid="this.setCustomValidity('Escoja un subtitulo')"
  oninput="this.setCustomValidity('')" >

  <?php
  $comboact2="";
  //validamos cual de los ids es el que tiene que estar seleccionado en el combo box
  $validarcombo=false;
  if(isset($serieObject)){
    $validarcombo=true;
    $subtitles_serie = listsubtitlesSerie($serieId);
  }
  //fin de validacion

  $subtitles = listlanguages();		

    if(count($subtitles)> 0) 
    { 
      foreach($subtitles as $subtitle)
      {
        $idsubtitle=$subtitle->getId();
        $dessubtitle=$subtitle->getLanguage_name();  
        
        if (!$validarcombo)
          {//si no viene de actualizar se carga normal
            $comboact2 .=" <option value=\"{$idsubtitle}\">{$dessubtitle}</option>"; 
          }
  else {
  
  
    foreach($subtitles_serie as $subtitlesel) { 
      $idsubtitlesel=$subtitlesel->getId();
  
      if($idsubtitle==$idsubtitlesel){//si viene de actualizar y es el valor anterior se selecciona
        $comboact2 .=" <option value=\"{$idsubtitle}\" selected>{$dessubtitle}</option>"; 
        }
      else{//si viene de actualizar y no es el valor anterior se carga normal
        $comboact2 .=" <option value=\"{$idsubtitle}\">{$dessubtitle}</option>"; 
        }
        }
            }
  }
      }
      echo $comboact2;
    
    ?>     
  </select>
</div>      

<div class="form-group">
        <input type="submit"  name="editBtn" class="btn btn-primary mt-2" value="Actualizar">
      </div>
    </form> 
  </div>
   
  <div class="container text-center mt-5">
    <a href="series.php" class="btn btn-warning mt-5"> Regresar </a>
    </div>
 
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