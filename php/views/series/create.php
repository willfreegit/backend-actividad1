<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/serie_controller.php');
  require_once('../../controllers/actor_controller.php');
  require_once('../../controllers/director_controller.php');
  require_once('../../controllers/platform_controller.php');
  require_once('../../controllers/language_controller.php');

  $actors = listactors();
  $directors = listdirectors();
  $platforms = listplatforms();
  $languages = listlanguages();
  $subtitles = listlanguages();

  $sendData = false;
  $serieCreated= false;

    
  if(isset($_POST['createBtn'])) 
    {   //Se valida si vino del boton crear;   
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
      $idlanguages = $_POST['languages'];
      $idsubtitles = $_POST['subtitles'];

      $serieCreated = saveSerie($title, $seasons, $episodes, $idplatform, $iddirector, $idactors, $idlanguages,$idsubtitles);   

    }
    if (!$sendData)
    {
      
?>
    
 
<h1 class="text-center">Agregar nueva serie</h1>
  <div class="container">
    <form action="" method="post">
      <div class="form-group">
        <label for="title" class="form-label">Titulo</label>
        <input type="text" name="title"  class="form-control">
      </div>
 
      <div class="form-group">
        <label for="seasons" class="form-label">Temporadas</label>
        <input type="text" name="seasons"  class="form-control">
      </div>
     
      <div class="form-group">
        <label for="episodes" class="form-label">Episodios</label>
        <input type="text" name="episodes"  class="form-control">
      </div>    
      <h4>Plataforma</h4>
      <select name="platform" class="form-control">
      <option value=""disabled selected>Choose option</option>
        <?php
        foreach($platforms as $row) { ?>
					<option value="<?php echo $row->getId(); ?>"><?php echo $row->getName(); ?></option>
				<?php } ?>
      </select>
      <h4>Director</h4>
      <select name="director" class="form-control">
      <option value=""disabled selected>Choose option</option>
        <?php
        foreach($directors as $row) { ?>
					<option value="<?php echo $row->getId(); ?>"><?php echo $row->getFirstName().' '.$row->getLastName(); ?></option>
				<?php } ?>
      </select>
      <h4>Actores</h4>
      <select name="actors[]" multiple class="form-control">
        <?php
        foreach($actors as $row) { ?>
					<option value="<?php echo $row->getId(); ?>"><?php echo $row->getFirstName().' '.$row->getLastName(); ?></option>
				<?php } ?>
      </select>
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
        <input type="submit"  name="createBtn" class="btn btn-primary mt-2" value="Crear">
      </div>
    </form> 
  </div>
   
  <div class="container text-center mt-5">
    <a href="series.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
 
  <?php
    } else { 
      if ($serieCreated) {
     
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