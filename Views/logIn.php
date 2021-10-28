<div>
    <form action="<?php echo FRONT_ROOT ?>LogIn/ValidateLogIn" method="post" class="bg-light-alpha p-5">
        <?php if(isset($message)) echo $message?>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="logInMail"><strong>Ingrese su mail</strong></label>
                <input type="email" name="email" value="" class="form-control">
                <label for="password"><strong>Ingrese su contraseña</strong></label>
                <input type="password" name="password" value="" class="form-control">
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Ingresar</button>
            </div>
            <a href="<?php echo FRONT_ROOT ?>User/ShowSignInView">Sign In</a>
        </div>
    </form>
</div>
<!-- ddouthwaite0@goo.gl -->