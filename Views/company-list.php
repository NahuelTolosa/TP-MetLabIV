<?php
    require_once('student-nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Compañias</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th style="text-align: center;">Nombre</th>
                    </thead>
                    <tbody>
                            <?php
                                foreach($companyList as $company)
                                {
                                    ?>
                                        <tr>
                                            <td style="text-align: center;">
                                                <details>
                                                    <summary>
                                                        <?php echo $company->getName()?>
                                                    </summary><br>
                                                        <p>CUIT:  <?php echo $company->getCuit()?></p>
                                                        <p>Numero:<?php echo $company->getPhoneNumber()?></p>
                                                        <p>Email: <?php echo $company->getEmail()?></p>
                                                </details>
                                            </td>
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