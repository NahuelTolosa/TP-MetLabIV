<?php
         if (!isset($_SESSION['loggedUser']))
         require_once('logIn.php');
       else {
          if(substr($_SESSION['loggedUser']->getId(),0,2) == "AD")
             require_once('admin-nav.php');
    
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar una nueva oferta de trabajo</h2>
            <?php   if(isset($message)){
                        echo $message;
                    }
            ?>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="tittle">Titulo</label>
                            <input type="text" name="tittle" value="" class="form-control" placeholder='Titulo'
                                required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="company">Compania</label>
                            <select name="company" id="company">
                                <?php
                                    foreach($companyDAO->GetAll() as $company){
                                        if($company->getIsActive()){
                                        
                                        ?>
                                        

                                        <option value="<?php echo $company->getIdCompany()?>">
                                            <?php echo $company->getName()?>
                                        </option>
                                    <?php } } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="salary">Salario</label>
                            <input type="number" name="salary" value="0" class="form-control" placeholder=''>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <p>Modalidad</p>
                            <label><input type="radio" name="workDay" class="radioSize" value="Part-Time">
                                Part-Time</label>
                            <label><input type="radio" name="workDay" class="radioSize" value="Full-Time">
                                Full-Time</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="salary">Puesto solicitado</label>
                            <div class="form-group">
                                <select id="reference" class="form-control" name="reference">
                                    <?php foreach ($jobPositionDAO->GetAll() as $jobPosition) {?>
                                        
                                        <option value="<?php echo $jobPosition->getJobPositionId()?>">
                                            <?php echo $jobPosition->getDescription()?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                  <div class="col-lg-4">
                            <div class="form-group">
                                <label for="description">Descripcion</label>
                                <div class="form-group">
                                    <textarea id="description" class="form-control" name="description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                 </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>
<?php } ?>