<!-- Header -->
<?php include "header.php"?>
 
  <div class="container">
    <h1 class="text-center" >Operaciones CRUD Actores</h1>
      <a href="create.php" class='btn btn-outline-dark mb-2'> <i class="bi bi-person-plus"></i> Crear nuevo Actor</a>
 
        <table class="table table-striped table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th  scope="col">ID</th>
              <th  scope="col">Titulo</th>
              <th  scope="col">Temporadas</th>
              <th  scope="col">Episodios</th>
              <th  scope="col">Plataforma</th>
              <th  scope="col">Director</th>
              <th  scope="col" colspan="2" class="text-center">Operaciones CRUD</th>
            </tr>  
          </thead>
            <tbody>
              <tr>
  
          <?php
           require_once('../../controllers/actor_controller.php');
           $Actors = getActors();
           foreach($Actors as $Actor){
            echo "<tr >";
            echo " <th scope='row'>{$Actor->getId()}</th>";
            echo " <td >{$Actor->getTitle()}</td>";
            echo " <td >{$Actor->getSeasons()}</td>";
            echo " <td >{$Actor->getEpisodes()}</td>";
            echo " <td >{$Actor->getIdplatform()}</td>";
            echo " <td >{$Actor->getIddirector()}</td>";
            //echo " <td class='text-center'> <a href='view.php?user_id={$Actor->getId()}' class='btn btn-primary'> <i class='bi bi-eye'></i> View</a> </td>";
            echo " <td class='text-center' > <a href='update.php?edit&Actor_id={$Actor->getId()}' class='btn btn-primary'><i class='bi bi-pencil'></i> EDITAR</a> </td>";
            echo " <td  class='text-center'>  <a href='delete.php?delete={$Actor->getId()}' class='btn btn-danger'> <i class='bi bi-trash'></i> BORRAR</a> </td>";
            echo " </tr> ";
           }
                ?>
              </tr>  
            </tbody>
        </table>
  </div>
 
<div class="container text-center mt-5">
      <a href="../index.html" class="btn btn-warning mt-5"> Regresar </a>
    <div>
 
<!-- Footer -->
<?php include "footer.php" ?>