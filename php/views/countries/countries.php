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
 require_once('../../controllers/country_controller.php');
 ?>
  <div class="container">
    <h1 class="text-center" >Listado de Paises</h1>
      <a href="create.php" class='btn btn-outline-dark mb-2'> <i class="bi bi-person-plus"></i> Crear nuevo país</a>
      <?php
           $countries = listcountries();
           if(count($countries)> 0) {
      ?>
           <table class="table table-striped table-bordered table-hover">
           <thead class="table-dark">
             <tr>
               <th  scope="col">ID</th>
               <th  scope="col">País</th>
               <th  scope="col">Código ISO</th>
               <th  scope="col" colspan="2" class="text-center">Operaciones CRUD</th>
             </tr>  
           </thead>
             <tbody>
               <tr>
   
           <?php

            foreach($countries as $country){
             echo "<tr >";
             echo " <th scope='row'>{$country->getId()}</th>";
             echo " <td >{$country->getCountry_name()}</td>";
             echo " <td >{$country->getCountry_isocode()}</td>";
             echo " <td class='text-center' > <a href='update.php?id={$country->getId()}' class='btn btn-primary'><i class='bi bi-pencil'></i> EDITAR</a> </td>";
             echo " <td  class='text-center'>  <a onclick='return confirmacion()' href='delete.php?id={$country->getId()}' class='btn btn-danger'> <i class='bi bi-trash'></i> BORRAR</a> </td>";
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
      Aún no existen paises.
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