<?php
     require_once('student-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5 section">
        <div class="container">
            <h2 class="mb-4">Informacion Personal</h2>
            <table class="table bg-light-alpha">
                <?php 
                         if(isset($message))
                              echo $message; 
                    ?>
                <thead>
                    <!--que metemos aca??? ... Nada :D -->
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Nombre:</strong> <?php echo $student->getFirstName() ?></td>
                    <tr>
                    <tr>
                        <td><strong>Apellido:</strong><?php echo $student->getLastName()  ?></td>
                    <tr>
                    <tr>
                        <td><strong>DNI:</strong> <?php echo $student->getDni() ?></td>
                    <tr>
                    <tr>
                        <td><strong>Genero:</strong> <?php echo $student->getGender()     ?></td>
                    <tr>
                    <tr>
                        <td><strong>Fecha de nacimiento: </strong> <?php echo $student->getBirthDate()     ?></td>
                    <tr>
                    <tr>
                        <td><strong>Mail: </strong><?php echo $student->getEmail()     ?></td>
                    <tr>
                    <tr>
                        <td><strong>Numero de telefono:</strong> <?php echo $student->getPhoneNumber()?></td>
                    <tr>
                    <tr>
                        <td><strong>Carrera:</strong><?php echo $careerDAO->getCareerByID($student->getCareerId())?>
                        </td>
                    <tr>

                        </td>
                    <tr>
                    <tr>
                        <td><strong>Estado:</strong>
                            <?php
                                   echo $student->isActive();
                              ?>
                        </td>
                    <tr>
                </tbody>
            </table>

            <div>
                <?php
                    if(isset($dropMessage))
                         echo $dropMessage; 
               ?>
                <h2 class="mb-4">Postulacion vigente</h2>
            </div>


            <table class="table bg-light-alpha">
                <thead>
                    <!--que metemos aca???-->
                </thead>
                <tbody>
                    <?php if(is_null($offer)){ ?>
                    <tr>
                        <td><strong> Usted no se encuentra postulado a ninguna oferta. </strong></td>
                    <tr>
                        <?php }else{ ?>
                    <tr>
                        <td><strong>Titulo:</strong> <?php echo $offer->getTittle()  ?></td>
                    <tr>
                    <tr>
                        <td><strong>Compa??ia:</strong><?php echo ($companyDAO->GetByID(intval($offer->getIdCompany())))->getName();?>
                        </td>
                    <tr>
                    <tr>
                        <td><strong>Salario:</strong> <?php echo $offer->getSalary() ?></td>
                    <tr>
                    <tr>
                        <td><strong>Jornada laboral: </strong> <?php echo $offer->getWorkDay()  ?></td>
                    <tr>
                    <tr>
                        <td><strong>Puesto requerido: </strong>
                            <?php echo $jobPositionDAO->GetNameByID($offer->getReference()) ?></p>
                    <tr>
                        <td><strong>Descripcion del puesto:</strong> <?php echo $offer->getDescription()  ?></td>
                    <tr>
                </tbody>
            </table>
                <form action="<?php echo FRONT_ROOT ?>Postulation/DropOffer" method="POST">
                    <input type="text" name="idUser" value="<?php echo $_SESSION['loggedUser']->getId()?>" class="form-control" hidden>
                    <button type="submit" name="button" value="" class="button">Darse de baja</button>
                </form>
            <?php } ?>
        </div>
    </section>
</main>