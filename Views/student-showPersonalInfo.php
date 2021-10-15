<?php

use DAO\CompanyDAO;

require_once('student-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
         <div class="container">
              <h2 class="mb-4">Informacion Personal</h2>
              <table class="table bg-light-alpha">
                   <thead>
                       <!--que metemos aca???-->
                   </thead>
                   <tbody>
                        <tr><td><strong>Nombre:</strong> <?php echo $_SESSION["firstName"] ?></td><tr>
                        <tr><td><strong>Apellido:</strong><?php echo $_SESSION["lastName"] ?></td><tr>
                        <tr><td><strong>DNI:</strong> <?php echo $_SESSION["dni"] ?></td><tr>
                        <tr><td><strong>Genero:</strong> <?php echo $_SESSION["gender"] ?></td><tr>
                        <tr><td><strong>Fecha de nacimiento: </strong> <?php echo $_SESSION["birthDate"] ?></td><tr>
                        <tr><td><strong>Mail: </strong><?php echo $_SESSION["email"] ?></td><tr>
                        <tr><td><strong>Numero de telefono:</strong> <?php echo $_SESSION["phoneNumber"] ?></td><tr>
                        <tr><td><strong>Carrera:</strong>
                         <?php
                              use DAO\CarreerDAO as CarreerDAO;
                              $careerDAO = new CarreerDAO();

                              echo $_SESSION["careerId"]." - ". $careerDAO->getCareerByID($_SESSION['careerId'])

                         ?>
                    </td><tr><!--levantar carrera desde json-->
                        <tr><td><strong>Estado:</strong>
                         <?php
                              if($_SESSION["active"])
                              {
                                      echo "Activo";
                              }
                              else{
                                      echo "Inactivo";
                              } 
                          ?>
                    </td><tr>
                   </tbody>
              </table>
         </div>
    </section>
</main>
