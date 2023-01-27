<!-- Header -->
<?php  include "header.php" ?>
 
<?php
   error_reporting (E_ALL ^ E_NOTICE);
   require_once('../../controllers/serie_controller.php');
   require_once('../../controllers/actor_controller.php');
   if(isset($_GET['serie_id']))
    {
    $serie_id = $_GET['serie_id']; 
    $serie = getSerieById($serie_id); 
    $title = $serie->getTitle();
    $seasons = $serie->getSeasons();
    $episodes = $serie->getEpisodes();
  
    $actors = listactors();
    $actors_serie = listActorsSerie($serie_id);
    $actors = cleanActors($actors, $actors_serie);

    if(isset($_POST['update'])) 
    {
      $title = $_POST['title'];
      $seasons = $_POST['seasons'];
      $episodes = $_POST['episodes'];
      $add_actors = [];
      $delete_actors = [];
      if($_POST['add_actors']){
        $add_actors = $_POST['add_actors'];
      }
      if($_POST['delete_actors']){
        $delete_actors = $_POST['delete_actors'];
      }
      $update = updateSerie($serie_id, $title, $seasons, $episodes, $add_actors, $delete_actors);
      echo "<script type='text/javascript'>alert('Serie actualizada correctamente!')</script>";
      $actors = listactors();
      $actors_serie = listActorsSerie($serie_id);
      $actors = cleanActors($actors, $actors_serie);
    }          
}
?>
 
<h1 class="text-center">Actualizar Series</h1>
  <div class="container ">
    <form action="" method="post">
      <div class="form-group">
        <label for="title" >Titulo</label>
        <input type="text" name="title" class="form-control" value="<?php echo $title  ?>">
      </div>
 
      <div class="form-group">
        <label for="seasons" >Temporadas</label>
        <input type="text" name="seasons"  class="form-control" value="<?php echo $seasons  ?>">
      </div>
      <div class="form-group">
        <label for="episodes" >Episodios</label>
        <input type="text" name="episodes"  class="form-control" value="<?php echo $episodes  ?>">
      </div>    
      <h4>Agregar Actores</h4>
      <select name="add_actors[]" multiple class="form-control">
        <?php
        foreach($actors as $row) { ?>
					<option value="<?php echo $row->getId(); ?>"><?php echo $row->getFirstName().' '.$row->getLastName(); ?></option>
				<?php } ?>
      </select>
      <h4>Eliminar Actores</h4>
      <select name="delete_actors[]" multiple class="form-control">
        <?php
        foreach($actors_serie as $row) { ?>
					<option value="<?php echo $row->getId(); ?>"><?php echo $row->getFirstName().' '.$row->getLastName(); ?></option>
				<?php } ?>
      </select>
      <div class="form-group">
         <input type="submit"  name="update" class="btn btn-primary mt-2" value="Actualizar">
      </div>
    </form>  
    <br/>  
  </div>

    <div class="container text-center mt-5">
      <a href="series.php" class="btn btn-warning mt-5"> Regresar </a>
    <div>
 
    <?php include "footer.php" ?>