<!-- Header -->
<?php  include "header.php" ?>
 
<?php
   require_once('../controllers/serie_controller.php');
   if(isset($_GET['serie_id']))
    {
      $serie_id = $_GET['serie_id']; 
    $serie = getSerieById($serie_id); 
    $title = $serie->getTitle();
    $seasons = $serie->getSeasons();
    $episodes = $serie->getEpisodes();
    if(isset($_POST['update'])) 
    {
      $title = $_POST['title'];
      $seasons = $_POST['seasons'];
      $episodes = $_POST['episodes'];
      $update = updateSerie($serie_id, $title, $seasons, $episodes);
      echo "<script type='text/javascript'>alert('Serie actualizada correctamente!')</script>";
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
      <div class="form-group">
         <input type="submit"  name="update" class="btn btn-primary mt-2" value="Actualizar">
      </div>
    </form>    
  </div>
 
    <div class="container text-center mt-5">
      <a href="series.php" class="btn btn-warning mt-5"> Regresar </a>
    <div>
 
    <?php include "footer.php" ?>