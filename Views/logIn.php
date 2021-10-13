<div>
    <form action="<?php echo FRONT_ROOT ?>LogIn/ValidateLogIn" method= "post" class="bg-light-alpha p-5">
        <div class="col-lg-4">
            <div class="form-group">
                 <label for="logInMail">Legajo</label>
                 <input type="text" name="email" value="" class="form-control">
                 <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Ingresar</button>
                 <h2 color="red"> <?php echo $message ?> </h2>
            </div>
       </div>
    </form>
</div>