<!-- Header -->
<?php include "header.php"?>
 
  <div class="container">
    <h1 class="text-center" >Operaciones CRUD Series</h1>
      <a href="create.php" class='btn btn-outline-dark mb-2'> <i class="bi bi-person-plus"></i> Create New User</a>
 
        <table class="table table-striped table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th  scope="col">ID</th>
              <th  scope="col">Titulo</th>
              <th  scope="col">Email</th>
              <th  scope="col"> Password</th>
              <th  scope="col" colspan="3" class="text-center">CRUD Operations</th>
            </tr>  
          </thead>
            <tbody>
              <tr>
  
          <?php
           require_once('../controllers/serie_controller.php');
           $series = getSeries();
           foreach($series as $serie){
            echo "<tr >";
            echo " <th scope='row'>{$serie->getId()}</th>";
            echo " <td >{$serie->getTitle()}</td>";
            echo " <td >{$serie->getId()}</td>";
            echo " <td >{$serie->getId()}</td>";
            echo " <td class='text-center'> <a href='view.php?user_id={$serie->getId()}' class='btn btn-primary'> <i class='bi bi-eye'></i> View</a> </td>";
            echo " <td class='text-center' > <a href='update.php?edit&user_id={$serie->getId()}' class='btn btn-secondary'><i class='bi bi-pencil'></i> EDIT</a> </td>";
            echo " <td  class='text-center'>  <a href='delete.php?delete={$serie->getId()}' class='btn btn-danger'> <i class='bi bi-trash'></i> DELETE</a> </td>";
            echo " </tr> ";
           }
                ?>
              </tr>  
            </tbody>
        </table>
  </div>
 
<!-- a BACK button to go to the index page -->
<div class="container text-center mt-5">
      <a href="../index.php" class="btn btn-warning mt-5"> Back </a>
    <div>
 
<!-- Footer -->
<?php include "footer.php" ?>