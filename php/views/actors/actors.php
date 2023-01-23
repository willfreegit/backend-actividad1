<!-- Header -->
<?php include "header.php"?>
 <?php
 require_once('../../controllers/actor_controller.php');
 ?>
  <div class="container">
    <h1 class="text-center" >Listado de Actores</h1>
      <a href="create.php" class='btn btn-outline-dark mb-2'> <i class="bi bi-person-plus"></i> Crear nuevo Actor</a>
      <?php
           $actores = listActors();
           if(count($actores)> 0) {
      ?>
           <table class="table table-striped table-bordered table-hover">
           <thead class="table-dark">
             <tr>
               <th  scope="col">ID</th>
               <th  scope="col">Nombre</th>
               <th  scope="col">Apellido</th>
               <th  scope="col">Fecha de Nacimiento</th>
               <th  scope="col">Nacionalidad</th>
               <th  scope="col" colspan="2" class="text-center">Operaciones CRUD</th>
             </tr>  
           </thead>
             <tbody>
               <tr>
   
           <?php

            foreach($actores as $actor){
             echo "<tr >";
             echo " <th scope='row'>{$actor->getId()}</th>";
             echo " <td >{$actor->getfirstname()}</td>";
             echo " <td >{$actor->getlastname()}</td>";
             echo " <td >{$actor->getDOB()}</td>";
             echo " <td >{$actor->getidcountry()}</td>";

             //echo " <td class='text-center'> <a href='view.php?user_id={$serie->getId()}' class='btn btn-primary'> <i class='bi bi-eye'></i> View</a> </td>";
             echo " <td class='text-center' > <a href='update.php?edit&serie_id={$actor->getId()}' class='btn btn-primary'><i class='bi bi-pencil'></i> EDITAR</a> </td>";
             echo " <td  class='text-center'>  <a href='delete.php?delete={$actor->getId()}' class='btn btn-danger'> <i class='bi bi-trash'></i> BORRAR</a> </td>";
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
      Aún no existen actores.
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