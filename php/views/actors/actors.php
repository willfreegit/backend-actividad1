<!-- Header -->
<?php include "header.php"?>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

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
             echo " <td >{$actor->getnationality()}</td>";
             //echo " <td style='visibility:hidden'>{$actor->getidcountry()}</td>";

             //echo " <td class='text-center'> <a href='view.php?user_id={$serie->getId()}' class='btn btn-primary'> <i class='bi bi-eye'></i> View</a> </td>";
             echo " <td class='text-center' > <a href='update.php?id={$actor->getId()}' class='btn btn-primary'><i class='bi bi-pencil'></i> EDITAR</a> </td>";
             echo " <td  class='text-center'>  <a onclick='return confirmacion()' href='delete.php?id={$actor->getId()}' class='btn btn-danger'> <i class='bi bi-trash'></i> BORRAR</a> </td>";
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