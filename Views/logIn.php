<div>
    <form action="<?php echo FRONT_ROOT ?>LogIn/ValidateLogIn" method="post" class="bg-light-alpha p-5">
        <?php if(isset($message)) echo $message?>
        <div class="col-lg-4" style= "width:85%; margin: auto;">
            <div class="form-group">
                <label for="logInMail"><strong>Ingrese su usuario</strong></label>
                <input type="mail" name="username" value="" class="form-control">
                <label for="password"><strong>Ingrese su contraseña</strong></label>
                <input type="password" name="password" value="" class="form-control">
                <br>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Ingresar</button>
                <br>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">
                    <a href="<?php echo FRONT_ROOT."User/ShowSignInView" ?>" style="text-decoration: none;color: #fff;">Sign In</a>
                </button>
            </div>
            
            
        </div>
    </form>
</div>
<!-- ddouthwaite0@goo.gl -->