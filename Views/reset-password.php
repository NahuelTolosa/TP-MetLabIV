<div>
    <form action="<?php echo FRONT_ROOT ?>ResetPassword/ResetPassword" method="post" class="bg-light-alpha p-5">
        <?php if (isset($message)) echo $message ?>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email"><strong>Ingrese su mail</strong></label>
                <input type="email" name="email" value="" class="form-control" require>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Enviar</button>
            </div>
        </div>
    </form>
</div>