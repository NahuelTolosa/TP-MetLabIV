<?php
// if(substr($_SESSION['loggedUser']->getId(),0,2) == "ST")
//     require_once('admin-nav.php');
// else 
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
               <h2 class="mb-4">Listado de Compañias</h2>
               <?php echo $message; ?>
               <table class="table bg-light-alpha">
                    <thead>
                         <!-- <th style="text-align: center;">Nombre</th> -->
                    </thead>
                    <tbody>
                        <form action="<?php echo FRONT_ROOT ?>Company/ShowFiltered" method= "get" class="bg-light-alpha p-5">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="logInMail"><strong>Busqueda por nombre</strong></label>
                                    <input type="text" name="filtro" value="" class="form-control">
                                    <button type="submit" name="button" style="display: block;" class="btn btn-dark ml-auto d-block" >Mostrar</button>
                                    
                                </div>
                            </div>
                        </form>
                            <?php
                                foreach($companyList as $company)
                                {
                                    if($company->getIsActive()){
                                    ?>
                                        <tr>
                                            <td style="text-align: center;">
                                                <details>
                                                    <summary class="summary">
                                                        <div class="tittle">
                                                            <?php
                                                                echo "<strong>".$company->getName()."</strong><p>(Tocar para mas info)</p>";
                                                            ?>
                                                        </div>
                                                        <div>
                                                            <?php
                                                            //hacer form para que pase los datos por post
                                                                if(substr($_SESSION['loggedUser']->getId(),0,2) == "AD"){
                                                                    echo "<a href='".FRONT_ROOT."Company/ShowModify/".$company->getIdCompany()."'> Modificar </a>";
                                                                    echo "<a href='".FRONT_ROOT."Company/ShowDeleteView/".$company->getName()."/".$company->getIdCompany()."'> Dar de baja </a>";
                                                                }
                                                                
                                                            ?>
                                                        </div>
                                                    </summary>
                                                    <div class="summary-description">
                                                        <div class="company-image">
                                                            <p><strong>Imagen</strong></p>
                                                        </div>
                                                        <div class="summary-info">
                                                            <p>CUIT:   <?php echo $company->getCuit()?></p>
                                                            <p>Numero: <?php echo $company->getPhoneNumber()?></p>
                                                            <p>Email:  <?php echo $company->getEmail()?></p>
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
<?php
}
?>