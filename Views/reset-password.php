<div>
    <form action="<?php echo FRONT_ROOT ?>ResetPassword" method= "post" class="bg-light-alpha p-5">
        <div class="col-lg-4">
            <div class="form-group">
                 <label for="email"><strong>Ingrese su mail</strong></label>
                 <input type="text" name="email" value="" class="form-control">
                 <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Enviar</button>
                 <h4 style="color: red;"> <?php echo $message ?> </h4>
            </div>
       </div>
    </form>
</div>