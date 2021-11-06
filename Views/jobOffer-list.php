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
                        
            <form method="get" action="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">
                <select id="reference" class="form-control-sm" name="reference">
                    <option value="<?php null ?>">--</option>
                    <?php foreach ($jobPositionDAO->GetAll() as $jobPosition) {?>
                    
                        <option value="<?php echo $jobPosition->getJobPositionId()?>">
                            <?php echo $jobPosition->getDescription()?>
                        </option>

                    <?php } ?>
                </select>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-inline-block">Buscar</button>
                <button type="submit" name="clear" class="btn btn-dark ml-auto d-inline-block" value="<?php echo "<input type='reset' name='reset'  value='reset'>" ?>">Vaciar</button>
                
            </form>


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

                                        if(substr($_SESSION['loggedUser']->getId(),0,2) == "ST" && $hasApplied==false )
                                        {?>
                                            <form action="<?php echo FRONT_ROOT ?>Postulation/ApplyOffer" method="POST">
                                                <input type="text" name="idPostulation" value="<?php echo $jobOffer->getOfferID()?>" class="" hidden>
                                                <input type="text" name="idUser" value="<?php echo $_SESSION['loggedUser']->getId()?>" class="" hidden>
                                                <button type="submit" name="button" value="" class="btn btn-dark">Postularse</button>
                                            </form>

                                       <?php } ?>
                                    
                                </summary><br>
                                <p>Empresa: <?php echo $jobOffer->getTittle()?></p><!--Esto está mal-->
                                <p>Fecha: <?php echo $jobOffer->getDate()?></p>
                                <p>Descripcion: <?php echo $jobOffer->getDescription()?></p>
                                <p>Disponibilidad: <?php echo $jobOffer->getWorkDay()?></p>
                                <p>Puesto requerido: <?php echo $jobPositionDAO->GetNameByID($jobOffer->getReference()) ?></p>
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