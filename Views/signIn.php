<div>
    <form action="<?php echo FRONT_ROOT ?>User/NewUser" method= "post" class="bg-light-alpha p-5 ">
        <?php
            if(isset($message))
                echo $message;
        ?>
        <div class="col-lg-4" style=" width:85%; margin: auto;">
            <div class="form-group">
                <label for="email"><strong>Ingrese su mail</strong></label>
                <input type="email" name="email" value="" class="form-control">

                <label for="password"><strong>Ingrese su contraseña</strong></label>
                <input type="password" name="password" value="" class="form-control">

                <label for="passwordValidate"><strong>Reingrese su contraseña</strong></label>
                <input type="password" name="passwordValidate" value="" class="form-control">
                <br>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Ingresar</button>
                <br>
                <button type="button" class="btn btn-dark ml-auto d-block">
                        <a href="<?php echo FRONT_ROOT."User/ShowLogInView"?>" style="text-decoration: none;color: #fff;">Cancelar</a>
                </button>
            </div>
       </div>
    </form>
</div>