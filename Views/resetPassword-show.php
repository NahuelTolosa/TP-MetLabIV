<div>
    <form action="<?php echo FRONT_ROOT ?>ResetPassword/UpdatePassword" method="post" class="bg-light-alpha p-5">
        <?php if (isset($message)) echo $message ?>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email"><strong>Ingrese su mail</strong></label>
                <input type="email" name="email" value="" class="form-control" require>
                <label for="password"><strong>Ingrese nueva contraseña</strong></label>
                <input type="password" name="password" value="" class="form-control" require>
                <label for="password"><strong>Repita la contraseña</strong></label>
                <input type="password" name="repeatPassword" value="" class="form-control" require>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Guardar</button>
            </div>
        </div>
    </form>
</div>