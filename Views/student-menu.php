<?php
    require_once('student-nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"><?php echo $_SESSION["firstName"]." ".$_SESSION["lastName"] ?></h2>
          </div>
     </section>
</main>