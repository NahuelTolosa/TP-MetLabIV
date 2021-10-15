<?php
if($_SESSION['user']=='admin')
    require_once('admin-nav.php');
else
    require_once('student-nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Compañias</h2>
               <?php echo $message; ?>
               <table class="table bg-light-alpha">
                    <thead>
                         <th style="text-align: center;">Nombre</th>
                    </thead>
                    <tbody>
                            <?php
                                foreach($companyList as $company)
                                {
                                    if($company->getIsActive()){
                                    ?>
                                        <tr>
                                            <td style="text-align: center;">
                                                <details>
                                                    <summary>
                                                        <?php
                                                            echo $company->getName();

                                                            if($_SESSION['user']=='admin'){
                                                                echo "<a href='".FRONT_ROOT."Company/ShowModify/".$company->getIdCompany()."'> Modificar </a>";
                                                                echo "<a href='".FRONT_ROOT."Company/ShowDeleteView/".$company->getName()."/".$company->getIdCompany()."'> Dar de baja </a>";
                                                            }
                                                            
                                                        ?>
                                                    </summary><br>
                                                        <p>CUIT:   <?php echo $company->getCuit()?></p>
                                                        <p>Numero: <?php echo $company->getPhoneNumber()?></p>
                                                        <p>Email:  <?php echo $company->getEmail()?></p>
                                                </details>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                            ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>