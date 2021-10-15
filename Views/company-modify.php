<?php
   require_once('admin-nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Modificacion de Compañia</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/Update/" method="post" class="bg-light-alpha p-5">
                    <div class="row"> 
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <input type="text" name="idCompany" value="<?php echo $company->getIdCompany() ?>" class="form-control" hidden>
                              </div>
                         </div>                        
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Razon Social</label>
                                   <input type="text" name="name" value="<?php echo $company->getName() ?>" class="form-control" >
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">CUIT</label>
                                   <input type="number" name="cuit" value="<?php echo $company->getCuit() ?>" class="form-control"  >
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Telefono</label>
                                   <input type="number" name="phoneNumber" value="<?php echo $company->getPhoneNumber() ?>" class="form-control" >
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="email" value="<?php echo $company->getEmail() ?>" class="form-control"  >
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>