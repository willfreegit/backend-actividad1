<!-- Header -->
<?php  include "header.php" ?>
 
<?php 
  require_once('../../controllers/serie_controller.php');
  require_once('../../controllers/actor_controller.php');

  $actors = listactors();

  if(isset($_POST['create'])) 
    {      
      $title = $_POST['title'];
      $seasons = $_POST['seasons'];
      $episodes = $_POST['episodes'];
      $idplatform = $_POST['idplatform'];
      $iddirector = $_POST['iddirector'];
      $actors = $_POST['actors'];
      $add = saveSerie($title, $seasons, $episodes, $idplatform, $iddirector, $actors);   
      if($add){
        echo "<script type='text/javascript'>alert('Serie creada correctamente!')</script>";
        $actors = listactors();
      } else {
        echo "A ocurrido un error al crear la serie ";
      }
    }
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
      <div class="form-group">
        <label for="idplatform" class="form-label">Plataforma</label>
        <input type="text" name="idplatform"  class="form-control">
      </div>
      <div class="form-group">
        <label for="iddirector" class="form-label">Director</label>
        <input type="text" name="iddirector"  class="form-control">
      </div>
      <h4>Director</h4>
      <select name="director" class="form-control">
      <option value=""disabled selected>Choose option</option>
        <?php
        foreach($actors as $row) { ?>
					<option value="<?php echo $row->getId(); ?>"><?php echo $row->getFirstName(); ?></option>
				<?php } ?>
      </select>
      <h4>Actores</h4>
      <select name="actors[]" multiple class="form-control">
        <?php
        foreach($actors as $row) { ?>
					<option value="<?php echo $row->getId(); ?>"><?php echo $row->getFirstName(); ?></option>
				<?php } ?>
      </select>

      <div class="form-group">
        <input type="submit"  name="create" class="btn btn-primary mt-2" value="submit">
      </div>
    </form> 
  </div>
 
  <div class="container text-center mt-5">
    <a href="series.php" class="btn btn-warning mt-5"> Regresar </a>
  <div>
 
<!-- Footer -->
<?php include "footer.php" ?>