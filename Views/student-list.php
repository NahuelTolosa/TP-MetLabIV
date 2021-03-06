<?php
    if (!isset($_SESSION['loggedUser']))
    require_once('logIn.php');
else {
if (substr($_SESSION['loggedUser']->getId(),0,2) == "ST")
    require_once('student-nav.php');
else if(substr($_SESSION['loggedUser']->getId(),0,2) == "AD")
    require_once('admin-nav.php');


?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de clientes</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Legajo</th>
                         <th>Apellido</th>
                         <th>Nombre</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($studentList as $student)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $student->getRecordId() ?></td>
                                             <td><?php echo $student->getLastName() ?></td>
                                             <td><?php echo $student->getFirstName() ?></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>
<?php } ?>