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
                        <tr><td><strong>Nombre:</strong> <?php echo $student->getFirstName() ?></td><tr>
               <tr><td><strong>Apellido:</strong><?php echo $student->getLastName()  ?></td><tr>
                        <tr><td><strong>DNI:</strong> <?php echo $student->getDni() ?></td><tr>
                        <tr><td><strong>Genero:</strong> <?php echo $student->getGender()     ?></td><tr>
                        <tr><td><strong>Fecha de nacimiento: </strong> <?php echo $student->getBirthDate()     ?></td><tr>
                        <tr><td><strong>Mail: </strong><?php echo $student->getEmail()     ?></td><tr>
                        <tr><td><strong>Numero de telefono:</strong> <?php echo $student->getPhoneNumber()?></td><tr>
                        <tr><td><strong>Carrera:</strong><?php echo $careerDAO->getCareerByID($student->getCareerId())?></td><tr>
                         
                    </td><tr>
                        <tr><td><strong>Estado:</strong>
                         <?php
                              echo $student->isActive();
                          ?>
                    </td><tr>
                   </tbody>
              </table>


              <h2 class="mb-4">Postulacion vigente</h2>
              <table class="table bg-light-alpha">
                   <thead>
                       <!--que metemos aca???-->
                   </thead>
                   <tbody>
                         <tr><td><strong>Titulo:</strong> <?php echo $student->getFirstName() ?></td><tr>
                         <tr><td><strong>Compania:</strong><?php echo $companyDAO->getCareerByID($offer->getIdCompany())?></td><tr>
                         <tr><td><strong>Descripcion del puesto:</strong> <?php echo $student->getDni() ?></td><tr>
                         <tr><td><strong>Salario:</strong> <?php echo $student->getGender()     ?></td><tr>
                         <tr><td><strong>Jornada laboral: </strong> <?php echo $student->getBirthDate()     ?></td><tr>
                                                  
                    </td><tr>
                        <tr><td><strong>Estado:</strong><!--qmsotramos solo si esta activa?-->
                         <?php
                              echo $student->isActive();
                          ?>
                    </td><tr>
                   </tbody>
              </table>
         </div>
    </section>
</main>
