<!doctype html>
<html>
    <title>Espacio Vivo - Login</title>
    <?php include("layaouts/header.php");  ?>
    <body>
        <div class="container">
          <?= $navbar ?>        
          <div class="col-sm-12">
            <h1 class="title">INICIO DE SESIÓN</h1>
          </div>          
          <div class="col-sm-12">
            <div class="col-sm-6">
              <form class="col-sm-12 grayForm" method="post" action="<?= base_url()?>cuenta/login">
                  <div class="col-sm-12 form-add-inmovable">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <?php echo form_error('email'); ?>
                  </div>
                  <div class="col-sm-12 form-add-inmovable">
                    <label for="email">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?php echo form_error('password'); ?>
                  </div>                
                  <div class="col-sm-12 form-add-inmovable">
                      <div class="col-sm-12 text-right" >
                        <button type="submit" class="btn btn-default">Entrar</button>
                        <a href="<?= base_url()?>cuenta/recuperar_contrasena"><label class="col-sm-12 text-center passwordRemider">¿Olvidaste tu contraseña?</label></a>
                      </div>
                  </div>                  
              </form>
            </div>
            <div class="col-sm-6">
              <!--<?= $loginFacebookBtn?>-->
            </div>
          </div>

        </div> <!--container-->
    </body>
    <?php include("layaouts/footer.php");  ?>
</html>
