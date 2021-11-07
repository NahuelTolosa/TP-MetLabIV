<div class="main-container">
    <form action="<?php echo FRONT_ROOT ?>LogIn/ValidateLogIn" method="post" class="container log-in bg-light-alpha">
        <div class="log-in__message">
            <?php if(isset($message)) echo $message?>
        </div>
        <div class="log-in__input">
            <div class="input-area">
                <label for="logInMail"><strong>Ingrese su usuario</strong></label>
                <input type="mail" name="username" value="" class="input">
            </div>
            <div class="input-area">
                <label for="password"><strong>Ingrese su contraseña</strong></label>
                <input type="password" name="password" value="" class="input">
            </div>
            <div class="input-area--buttons">
                <button type="button" name="button" class="button">
                    <a href="<?php echo FRONT_ROOT."User/ShowSignInView" ?>">Sign In</a>
                </button>
                <button type="submit" name="button" class="button">Ingresar</button>
            </div>
        </div>
    </form>
</div>