<?php

use Helpers\Utils;

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
                        
            <form method="get" action="<?php echo FRONT_ROOT ?>JobOffer/ShowListView" class="form-filter">
                <select id="reference" class="form-control-sm select-filter" name="reference">
                    <option value="<?php null ?>">--</option>
                    <?php foreach ($jobPositionDAO->GetAll() as $jobPosition) {?>
                    
                        <option value="<?php echo $jobPosition->getJobPositionId()?>">
                            <?php echo $jobPosition->getDescription()?>
                        </option>

                    <?php } ?>
                </select>
                <div class="buttons-filter">
                    <button type="submit" name="button" class="button">Buscar</button>
                    <button type="submit" name="clear" class="button" value="1">Vaciar</button>
                </div>
                
                
            </form>


            <table class="table bg-light-alpha">
                <thead>
                    <!-- <th style="text-align: center;">Nombre</th> -->
                </thead>
                <tbody>
                    <?php
                        
                        foreach($jobOfferList as $jobOffer)
                        {
                            if($jobOffer->getActive()){
                            
                    ?>
                    <tr>
                        <td style="text-align: center;">
                            <details>
                                <summary class="summary">
                                    <div class="tittle">
                                        <?php
                                            echo "<strong>".$jobOffer->getTittle()."</strong><p>(Tocar para mas info)</p>";
                                        ?>
                                    </div>
                                    <div class="tittle">
                                        <?php
                                            if(Utils::isAdminLogged()) //hacer un form
                                            { ?>
                                                <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowModify" method="POST">
                                                    <input type="text" name="offerID" value="<?php echo $jobOffer->getOfferID() ?>" style="display:none">
                                                    <button style="margin:0 5px" type="submit" name="button" value="" class="button">Modificar</button>
                                                </form>
                                                <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowDeleteView" method="POST">
                                                    <input type="text" name="tittle" value="<?php echo $jobOffer->getTittle() ?>" style="display:none">
                                                    <input type="text" name="offerID" value="<?php echo $jobOffer->getOfferID() ?>" style="display:none">
                                                    <button style="margin:0 5px" type="submit" name="button" value="" class="button">Dar de baja</button>
                                                </form>
                                                <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowAllUserOfferView" method="POST">
                                                    <input type="text" name="tittle" value="<?php echo $jobOffer->getTittle() ?>" style="display:none">
                                                    <input type="text" name="offerID" value="<?php echo $jobOffer->getOfferID() ?>" style="display:none">
                                                    <button style="margin:0 5px" type="submit" name="button" value="" class="button">Postulantes</button>
                                                </form>
                                        <?php }
                                            if(Utils::isStudentLogged() && $hasApplied==false)
                                            {?>
                                                <form action="<?php echo FRONT_ROOT ?>Postulation/ApplyOffer" method="POST">
                                                    <input type="text" name="idJobOffer" value="<?php echo $jobOffer->getOfferID()?>" class="" hidden>
                                                    <input type="text" name="idUser" value="<?php echo $_SESSION['loggedUser']->getId()?>" class="" hidden>
                                                    <button style="margin:0 5px" type="submit" name="button" value="" class="button">Postularse</button>
                                                </form>
                                        <?php } ?>
                                    </div>
                                </summary>
                                <div class="summary-description">
                                    <div class="company-image">
                                        <div>
                                            <p><strong>Empresa:</strong> <?php echo $jobOffer->getTittle()?></p><!--Esto está mal-->
                                        </div>
                                    </div>
                                    <div class="summary-info">
                                        <p><strong>Fecha:</strong> <?php echo $jobOffer->getDate()?></p>
                                        <p><strong>Descripcion:</strong> <?php echo $jobOffer->getDescription()?></p>
                                        <p><strong>Disponibilidad:</strong> <?php echo $jobOffer->getWorkDay()?></p>
                                        <p><strong>Puesto requerido:</strong> <?php echo $jobPositionDAO->GetNameByID($jobOffer->getReference()) ?></p>
                                        <p><strong>Salario:</strong> <?php echo $jobOffer->getSalary()?></p>
                                    </div>
                                    
                                </div>
                                
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