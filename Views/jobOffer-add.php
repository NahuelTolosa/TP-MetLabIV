<?php
    require_once('admin-nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar una nueva oferta de trabajo</h2>
               <?php if(isset($message)){
                    echo $message;
               }
               ?>
               <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="tittle">Titulo</label>
                                   <input type="text" name="tittle" value="" class="form-control" placeholder='"titulo"' required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                    <label for="company">Compania</label>
                                   <input type="text" name="company" value="" class="form-control" placeholder="'Compania'" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="description">Descripcion</label>
                                   <input type="text" name="description" value="" class="form-control" placeholder='"Ingrese su texto aqui"' required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="salary">Salario</label>
                                   <input type="text" name="salary" value="0" class="form-control" placeholder=''>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>