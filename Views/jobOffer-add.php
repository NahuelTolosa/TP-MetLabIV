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

                <div style="width:65%; margin:auto;">
                
                    <div class="input-area">
                        <label for="tittle">Titulo</label>
                        <input type="text" name="tittle" value="" class="input" placeholder='Titulo' required>
                    </div>
                    
                    <div class="input-area">
                        <label for="company">Compania</label>
                        <select name="company" id="company" class="input">
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

                    <div class="input-area">
                        <label for="salary">Salario</label>
                        <input type="number" name="salary" value="0" class="input" min="0" placeholder=''>
                    </div>
                    
                    <div class="input-area">
                        <label for="salary">Puesto solicitado</label>
                        <select id="reference" class="input" name="reference">
                            <?php foreach ($jobPositionDAO->GetAll() as $jobPosition) {?>
                            <option value="<?php echo $jobPosition->getJobPositionId()?>"><?php echo $jobPosition->getDescription()?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="input-area">
                        <label for="description">Descripcion</label>
                        <textarea id="description" class="input" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="input-area">
                        <p>Modalidad</p>
                        <label><input type="radio" name="workDay" class="radioSize" value="Part-Time"> Part-Time</label>
                        <label><input type="radio" name="workDay" class="radioSize" value="Full-Time"> Full-Time</label>
                    </div>
                    
                    <div class="input-area--button">
                        <button type="submit" name="button" class="button">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<?php } ?>