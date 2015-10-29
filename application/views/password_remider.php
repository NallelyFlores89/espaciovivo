<!doctype html>
<html>
    <?php include("layaouts/header.php");  ?>
    <body>
        <title>Gracias por tu mensaje</title>
        <div class="container text-center" style="">
          <?php include("layaouts/navbar.php");  ?>
          <br><br><br>
          <?php if(!isset($admin)){?>
          <form class="col-sm-6 col-sm-offset-3 grayForm" method="post" action="<?= base_url()?>cuenta/password_remider_submit">
          <?php }else{ ?> 
          <form class="col-sm-6 col-sm-offset-3 grayForm" method="post" action="<?= base_url()?>administrador/password_remider_submit">
          <?php } ?>
            <p class="title">Ingresa tu correo con el que te registraste para que te enviemos tu contraseña</p>
            <div class="col-sm-12 form-add-inmovable">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
                <?php echo form_error('email'); ?>
            </div>
            <div class="col-sm-12 form-add-inmovable">
                <div class="col-sm-12 text-right" >
                  <button type="submit" class="btn btn-default">Enviar</button>
                </div>
            </div>               
          </form>
          <?php include("layaouts/footer.php");  ?>
        </div> <!--container-->

    </body>
</html>
