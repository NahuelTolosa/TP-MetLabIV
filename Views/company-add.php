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
               <h2 class="mb-4">Agregar una nueva empresa al sistema</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post" class="bg-light-alpha p-5">
                    <div style="width:65%; margin:auto;">
                         
                         <div class="input-area">
                              <label for="">Razon Social</label>
                              <input type="text" name="name" value="" class="input" placeholder="" required>
                         </div>

                         <div class="input-area">
                              <label for="">CUIT</label>
                              <input type="number" name="cuit" value="" class="input" placeholder="" required>
                         </div>

                         <div class="input-area">
                              <label for="">Telefono</label>
                              <input type="number" name="phoneNumber" value="" class="input" placeholder="" required>
                         </div>                         

                         
                         <div class="input-area">
                              <label for="">Contacto</label>
                              <input type="email" name="email" value="" class="input" placeholder="" required>
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