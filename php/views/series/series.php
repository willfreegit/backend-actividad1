<!-- Header -->
<?php include "header.php"?>
 
<script>
    function confirmacion() {
        var respuesta = confirm("¿Desea realmente borrar el registro?");
        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

  <div class="container">
    <h1 class="text-center" >Operaciones CRUD Series</h1>
      <a href="create.php" class='btn btn-outline-dark mb-2'> <i class="bi bi-person-plus"></i> Crear nueva serie</a>

      <?php
           require_once('../../controllers/serie_controller.php');
           require_once('../../controllers/director_controller.php');
           require_once('../../controllers/platform_controller.php');
           
           $series = getSeries();

           if(count($series)> 0) {
?>      
        <table class="table table-striped table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th  scope="col">ID</th>
              <th  scope="col">Titulo</th>
              <th  scope="col">Temporadas</th>
              <th  scope="col">Episodios</th>
              <th  scope="col">Plataforma</th>
              <th  scope="col">Director</th>
              <th  scope="col">Actores</th>
              <th  scope="col">Lenguajes</th>
              <th  scope="col">Subtítulos</th>
              <th  scope="col" colspan="2" class="text-center">Operaciones CRUD</th>
            </tr>  
          </thead>
            <tbody>
              <tr>
        <?php
  
           foreach($series as $serie){
            $directorName = '';
            $platformName = '';
            $languages = getLanguageById($serie->getId());
            $actores = getActoresSerie_plane($serie->getId());
            if($serie->getIddirector()){
              $director = getDirectorData($serie->getIddirector());
              if($director && $director->getFirstName() && $director->getLastName()){
                $directorName = $director->getFirstName().' '.$director->getLastName();
              }
            }
            if($serie->getIdplatform()){
              $platform = getPlatformData($serie->getIdplatform());
              if($platform){
                $platformName = $platform->getName();
              }
            }
            echo "<tr >";
            echo " <th scope='row'>{$serie->getId()}</th>";
            echo " <td >{$serie->getTitle()}</td>";
            echo " <td >{$serie->getSeasons()}</td>";
            echo " <td >{$serie->getEpisodes()}</td>";
            echo " <td >{$platformName}</td>";
            echo " <td >{$directorName}</td>";
            echo " <td >{$actores}</td>";
            echo " <td >{$languages}</td>";
            echo " <td >{$languages}</td>";
            echo " <td class='text-center' > <a href='update.php?edit&serie_id={$serie->getId()}' class='btn btn-primary'><i class='bi bi-pencil'></i> EDITAR</a> </td>";
            echo " <td  class='text-center'>  <a onclick='return confirmacion()' href='delete.php?delete={$serie->getId()}'  class='btn btn-danger'> <i class='bi bi-trash'></i> BORRAR</a> </td>";
            echo " </tr> ";
           }
                ?>
              </tr>  
            </tbody>
        </table>
        <?php
        } else {
    ?>

    <div class="alert alert-warning" role="alert">
      Aún no existen series.
    </div> 

    <?php
        }
    ?>

  </div>
 
<div class="container text-center mt-5">
      <a href="../../../index.html" class="btn btn-warning mt-5"> Regresar </a>
    <div>
 
<!-- Footer -->
<?php include "footer.php" ?>