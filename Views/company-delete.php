<?php
    require_once('admin-nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">¿Está seguro que desea eliminar a la Empresa "<?php echo $companyName?>"?</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/DeleteCompany" method="get" class="bg-light-alpha p-5">
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block" value="<?php echo $companyID ?>">Aceptar</button><br>
                    <button type="button" class="btn btn-dark ml-auto d-block">
                         <a href="<?php echo FRONT_ROOT."Company/ShowListView"?>" style="text-decoration: none;color: #fff;">Cancelar</a>
                    </button>
               </form>
          </div>
     </section>
</main>