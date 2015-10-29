<!doctype html>
<html>
    <?php include("layaouts/header.php");  ?>
    <body>
        <title>Contacto</title>
        <div class="container">
          <?= $navbar  ?>
          <div id="contactoForm" class="col-sm-5 noPaddingLeft noPaddingRight">
            <h1 class="title">Contacto</h1>
            <form  id="formulario" class="col-sm-12" action="<?= base_url()?>contacto/send" method="post">
              <div class="form-group col-sm-12 noPaddingLeft noPaddingRight">
                <label class="col-sm-3 noPaddingLeft noPaddingRight" for="name">Nombre</label>
                <input type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control">
                <?php echo form_error('name'); ?>
              </div>
              <div class="form-group col-sm-12 noPaddingLeft noPaddingRight">
                <label class="col-sm-3 noPaddingLeft noPaddingRight" for="phone">Teléfono</label>
                <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control">
                <?php echo form_error('phone'); ?>
              </div>
              <div class="form-group col-sm-12 noPaddingLeft noPaddingRight">
                <label class="col-sm-3 noPaddingLeft noPaddingRight" for="email">E-mail</label>
                <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control">
                <?php echo form_error('email'); ?>
              </div>
              <div class="form-group col-sm-12 noPaddingLeft noPaddingRight">
                <label class="col-sm-3 noPaddingLeft noPaddingRight" for="msg">Comentarios</label>
                <textarea name="msg" value="<?php echo set_value('msg'); ?>" class="form-control"></textarea>
                <?php echo form_error('msg'); ?>
              </div>
              <div class="form-group col-sm-12 text-right">
                <input type="submit" value="Enviar" class="col-sm-offset-8 btn btn-default">
              </div>

            </form>
          </div>
          <div class="col-sm-1"></div>
          <div id="contactoDatos" class="col-sm-6">
            <div class="col-sm-12 noPaddinRight"><i class="icon-large icon-phone col-sm-1" aria-hidden="true"></i><span class="contactData col-sm-11 noPaddingRight">  55.54.36.36.70</span></div>
            <div class="col-sm-12 noPaddinRight"><i class="icon-large icon-envelope col-sm-1" aria-hidden="true"></i><span class="contactData col-sm-11 noPaddingRight">  info.espaciovivo@gmail.com</span></div>
            <div class="col-sm-12 noPaddinRight"><i class="icon-large icon-facebook col-sm-1" aria-hidden="true"></i><span class="contactData col-sm-11 noPaddingRight">  facebook/espaciovivo</span></div>
            <div class="col-sm-12 noPaddinRight"><i class="icon-large icon-twitter col-sm-1" aria-hidden="true"></i><span class="contactData col-sm-11 noPaddingRight">  @espaciovivo</span></div>

          </div>
          <?php include("layaouts/footer.php");  ?>

        </div> <!--container-->

    </body>
</html>
