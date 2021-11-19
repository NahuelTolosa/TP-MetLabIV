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
            <h2 class="mb-4">Postulaciones activas "<?php echo $tittle?>"</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowDropOfferUserView" method="post" class="bg-light-alpha p-5">
                        <table class="table bg-light-alpha">
                <?php foreach ($userList as $user) {?>
                    <tbody>
                    <tr>
                        <td style="display: flex; flex-direction: row; justify-content: space-between;">
                            <div style="display: flex; flex-direction: row; align-items: center;">
                                <strong>Usuario Postulado:</strong>
                                <?php echo $user; ?> 
                            </div> 
                            <input type='text' name='user' value="<?php echo $user ?>" class='form-control' hidden>
                            <button class="btn btn-danger" type="submit">Rechazar</button>
                        </td>
                    <tr>
                    
                           
                <?php } ?>
                </tbody>
            </form>
        </div>
    </section>
</main>
<?php } ?>