<?php
    require_once('admin-nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar una nueva empresa al sistema</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Razon Social</label>
                                   <input type="text" name="name" value="" class="form-control" placeholder="" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">CUIT</label>
                                   <input type="number" name="cuit" value="" class="form-control" placeholder="" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Telefono</label>
                                   <input type="number" name="phoneNumber" value="" class="form-control" placeholder="" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Contacto</label>
                                   <input type="email" name="email" value="" class="form-control" placeholder="" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>