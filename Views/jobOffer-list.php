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
                    <button type="submit" name="clear" class="button" value="<?php echo "<input type='reset' name='reset'  value='reset'>" ?>">Vaciar</button>
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
                                    <div>
                                        <?php
                                        //hacer form para que pase los datos por post
                                            if(substr($_SESSION['loggedUser']->getId(),0,2) == "AD") //hacer un form
                                            {
                                                echo "<a href='".FRONT_ROOT."JobOffer/ShowModify/".$jobOffer->getOfferID()."'> Modificar </a>";
                                                echo "<a href='".FRONT_ROOT."JobOffer/ShowDeleteView/".$jobOffer->getTittle()."/".$jobOffer->getOfferID()."'> Dar de baja </a>";
                                                echo "<a href='".FRONT_ROOT."JobOffer/ShowAllUserOfferView/".$jobOffer->getTittle()."/".$jobOffer->getOfferID()."'> Postulaciones </a>";
                                            }
                                            if(substr($_SESSION['loggedUser']->getId(),0,2) == "ST" && $hasApplied==false)
                                            {?>
                                                <form action="<?php echo FRONT_ROOT ?>Postulation/ApplyOffer" method="POST">
                                                    <input type="text" name="idPostulation" value="<?php echo $jobOffer->getOfferID()?>" class="" hidden>
                                                    <input type="text" name="idUser" value="<?php echo $_SESSION['loggedUser']->getId()?>" class="" hidden>
                                                    <button type="submit" name="button" value="" class="button">Postularse</button>
                                                </form>
                                        <?php } ?>
                                    </div>
                                </summary>
                                <div class="summary-description">
                                    <div class="company-image">
                                        <div>
                                            <p><strong>Imagen</strong></p>
                                        </div>
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
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>
<?php } ?>