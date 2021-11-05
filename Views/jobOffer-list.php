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
            <h2 class="mb-4">Listado de Ofertas Laborales</h2>
            <?php echo $message; ?>
            <table class="table bg-light-alpha">
                <thead>
                    <!-- <th style="text-align: center;">Nombre</th> -->
                </thead>
                <tbody>
                    <?php
                        foreach($jobOfferList as $jobOffer)
                        {
                            if($jobOffer->getActive())
                            {
                    ?>
                    <tr>
                        <td style="text-align: center;">
                            <details>
                                <summary>
                                    <?php
                                        echo $jobOffer->getTittle();

                                        if(substr($_SESSION['loggedUser']->getId(),0,2) == "AD")
                                        {
                                            echo "<a href='".FRONT_ROOT."JobOffer/ShowModify/".$jobOffer->getOfferID()."'> Modificar </a>";
                                            echo "<a href='".FRONT_ROOT."JobOffer/ShowDeleteView/".$jobOffer->getTittle()."/".$jobOffer->getOfferID()."'> Dar de baja </a>";
                                        }
                                        if(substr($_SESSION['loggedUser']->getId(),0,2) == "ST")
                                        {
                                            echo "<a href='".FRONT_ROOT."Postulation/ApplyOffer/".$jobOffer->getOfferID().$_SESSION['loggedUser']->getId()."'> Postularse </a>";
                                            
                                        }
                                    ?>
                                </summary><br>
                                <p>Empresa: <?php echo $jobOffer->getName()?></p>
                                <p>Fecha: <?php echo $jobOffer->getDate()?></p>
                                <p>Descripcion: <?php echo $jobOffer->getDescription()?></p>
                                <p>Disponibilidad: <?php echo $jobOffer->getWorkDay()?></p>
                                <p>Salario: <?php echo $jobOffer->getSalary()?></p>
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
<?php } ?>