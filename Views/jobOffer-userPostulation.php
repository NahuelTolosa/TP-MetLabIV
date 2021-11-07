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
            <h2 class="mb-4">Postulaciones activas "<?php echo $tittle?>"?</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/DropOfferUser" method="get" class="bg-light-alpha p-5">
                        <table class="table bg-light-alpha">
                <?php foreach ($userList as $user) {?>
                    <tbody>
                    <tr>
                        <td><strong>Usuario Postulado:</strong> <?php echo $user ?></td>
                    <tr>
                    <?php echo "<a href='".FRONT_ROOT."JobOffer/ShowDropOfferUserView/".$user."/".$offerID."'> Dar de baja </a>";?>
                           
                <?php } ?>

            </form>
        </div>
    </section>
</main>
<?php } ?>