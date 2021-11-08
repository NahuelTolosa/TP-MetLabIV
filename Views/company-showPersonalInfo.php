<?php
     require_once('company-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5 section">
        <div class="container">
            <h2 class="mb-4">Informacion de la Empresa</h2>
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
                        <td><strong>Razon Social: </strong> <?php echo $_SESSION['company']->getName() ?></td>
                    <tr>
                    <tr>
                        <td><strong>Cuit: </strong><?php echo $_SESSION['company']->getCuit() ?></td>
                    <tr>
                    <tr>
                        <td><strong>Número: </strong> <?php echo $_SESSION['company']->getPhoneNumber() ?></td>
                    <tr>
                    <tr>
                        <td><strong>Email: </strong> <?php echo $_SESSION['company']->getEmail() ?></td>
                    <tr>
                </tbody>
            </table>

            <div>
                <?php
                    if(isset($dropMessage))
                         echo $dropMessage; 
               ?>
                <h2 class="mb-4">Ofertas de trabajo vigente</h2>
            </div>

            <?php if(is_null($_SESSION['company']->getJobOffers())){ ?>

            <table class="table bg-light-alpha">
                <thead>
                </thead>
                    <tbody>
                        <tr>
                            <td><strong> No hay Ofertas laborales emitidas por este empresa. </strong></td>
                        <tr>
                    </tbody>
            </table>
                
            <?php }else{ foreach ($_SESSION['company']->getJobOffers() as $offer) {?>

                <table class="table bg-light-alpha">
                    <thead>
                    </thead>
                        <tbody>
                            <tr>
                                <td><strong>Titulo: </strong> <?php echo $offer->getTittle()?></td>
                            <tr>
                            <tr>
                                <td><strong>Fecha de Creación: </strong><?php echo $offer->getDate() ?></td>
                            <tr>
                            <tr>
                                <td><strong>Descripción: </strong><?php echo $offer->getDescription() ?></td>
                            <tr>
                            <tr>
                                <td><strong>Salario: </strong> <?php echo $offer->getSalary() ?></td>
                            <tr>
                            <tr>
                                <td><strong>Jornada laboral: </strong> <?php echo $offer->getWorkDay()  ?></td>
                            <tr>
                            <tr>
                                <td><strong>Puesto requerido: </strong><?php echo $jobPositionDAO->GetNameByID($offer->getReference()) ?></td>
                            <tr>
                        </tbody>
                </table>
                <form action="<?php echo FRONT_ROOT ?>Postulation/DropOffer" method="POST">
                    <input type="text" name="idUser" value="<?php echo $_SESSION['loggedUser']->getId()?>" class="form-control" hidden>
                    <button type="submit" name="button" value="" class="button">Dar de baja</button>
                </form>
            <?php }} ?>
        </div>
    </section>
</main>