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
                         <th style="text-align: center;">Listado de ofertas</th>
                    </thead>
                    <tbody>
                            <?php
                                foreach($jobOfferList as $jobOffer)
                                {
                                    if($jobOffer->getIsActive()){
                                    ?>
                                        <tr>
                                            <td style="text-align: center;">
                                                <details>
                                                    <summary>
                                                        <?php
                                                            // echo $jobOffer->getName();                                                            
                                                        ?>
                                                    </summary><br>
                                                        <p>Titulo:    <?php /*echo $jobOffer->*/?></p>
                                                        <p>Compania:  <?php /*echo $jobOffer->*/?></p>
                                                        <p>Fecha:     <?php /*echo $jobOffer->*/?></p>
                                                        <p>Propuesta: <?php /*echo $jobOffer->*/?></p>
                                                        <p>Salario:   <?php /*echo $jobOffer->*/?></p>
                                                        <p>Tiempo:    <?php /*echo $jobOffer->*/?></p>
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