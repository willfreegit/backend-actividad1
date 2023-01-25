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

 <?php
 require_once('../../controllers/platform_controller.php');
 ?>
  <div class="container">
    <h1 class="text-center" >Listado de Plataformas</h1>
      <a href="create.php" class='btn btn-outline-dark mb-2'> <i class="bi bi-person-plus"></i> Crear nueva Plataforma</a>
      <?php
           $plataformas = listPlatforms();
           if(count($plataformas)> 0) {
      ?>
           <table class="table table-striped table-bordered table-hover">
           <thead class="table-dark">
             <tr>
               <th  scope="col">ID</th>
               <th  scope="col">Nombre</th>
               <th  scope="col" colspan="2" class="text-center">Operaciones CRUD</th>
             </tr>  
           </thead>
             <tbody>
               <tr>
   
           <?php

            foreach($plataformas as $platform){
             echo "<tr >";
             echo " <th scope='row'>{$platform->getId()}</th>";
             echo " <td >{$platform->getname()}</td>";
             echo " <td class='text-center' > <a href='update.php?id={$platform->getId()}' class='btn btn-primary'><i class='bi bi-pencil'></i> EDITAR</a> </td>";
             echo " <td  class='text-center'>  <a onclick='return confirmacion()' href='delete.php?id={$platform->getId()}' class='btn btn-danger'> <i class='bi bi-trash'></i> BORRAR</a> </td>";
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
      Aún no existen plataformas.
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