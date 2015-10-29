<!doctype html>
<html>
    <title>Espacio Vivo - Administrador - Login</title>
    <?php include("layaouts/header.php");  ?>
    <body>
        <div class="container">
          <?= $navbar ?>        
          <div class="row">
            <!-- <h1 class="title">LOGIN</h1> -->
          </div>          
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
            <br><br><br>
              <form method="post" class="col-sm-12 grayForm" action="<?= base_url()?>administrador/doLogin">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <?php echo form_error('email'); ?>
                  </div>
                  <div class="form-group">
                    <label for="email">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?php echo form_error('password'); ?>
                  </div>                
                  <div class="form-group">
                      <a href="<?= base_url()?>administrador/recuperar_contrasena"><label class="col-sm-12 text-center passwordRemider">¿Olvidaste tu contraseña?</label></a>
                      <div class="col-sm-12 text-right" >
                        <button type="submit" class="btn btn-default">Entrar</button>
                      </div>
                  </div><br><br>                
              </form>
            </div>
            <div class="col-sm-6"></div>
          </div>

        </div> <!--container-->
    </body>
    <?php include("layaouts/footer.php");  ?>
</html>
