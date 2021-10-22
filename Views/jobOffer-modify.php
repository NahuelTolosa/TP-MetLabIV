<?php
   require_once('admin-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Modificacion de Oferta Laboral</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Update/" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="text" name="offerID" value="<?php echo $jobOffer->getOfferID() ?>"
                                class="form-control" hidden>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Titulo</label>
                            <input type="text" name="tittle" value="<?php echo $jobOffer->getTittle() ?>"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Descripcion</label>
                            <input type="text" name="description" value="<?php echo $jobOffer->getDescription() ?>"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Salario</label>
                            <input type="number" name="salary" value="<?php echo $jobOffer->getSalary() ?>"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>