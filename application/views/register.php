<!doctype html>
<html>

    <title>Espacio Vivo - Administrador - Panel</title>
    <?php include("layaouts/header.php");  ?>
    <body>
        <div class="container">
          <?= $navbar ?>        
          <d  iv class="col-sm-9">
            <h1 class="title">REGÍSTRATE</h1>
            <p class="description">Gracias por registrarte en Espacio Vivo, solo te tomará unos cuantos minutos ser parte de esta experiencia.</p>
            
            <form class="col-sm-12 grayForm" action="<?= base_url()?>registro/doRegister" method="post">
              <div class="col-sm-12 form-add-inmovable">
                <div class="col-sm-6 noPaddingLeft">
                  <div class="row">
                    <div class="col-sm-3 noPaddingLeft"><label for="name">Nombre(s)</label></div>
                    <div class="col-sm-9"><input type="text" value="<?= set_value('name') ?>" class="form-control" id="name" name="name"></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-9 col-sm-offset-3"><?php echo form_error('name'); ?></div>
                  </div>
                </div>
                <div class="col-sm-6 noPaddingLeft">
                  <div class="col-sm-3 noPaddingLeft"><label for="last_name">Apellidos</label></div>
                  <div class="col-sm-9"><input type="text" value="<?= set_value('last_name') ?>" class="form-control" id="last_name" name="last_name"></div>
                  <div class="col-sm-9 col-sm-offset-3"><?php echo form_error('last_name'); ?></div>
                </div>                
              </div> 
              <div class="col-sm-12 form-add-inmovable noPaddingLeft">
                <div class="col-sm-8 noPaddingLeft">
                  <div class="col-sm-3 noPaddingLeft"><label for="email">E-mail</label></div>
                  <div class="col-sm-9"><input type="text" value="<?= set_value('email') ?>" class="form-control" id="email" name="email"></div>
                  <div class="col-sm-9 col-sm-offset-3"><?php echo form_error('email'); ?></div>
                </div>              
              </div>   
              <div class="col-sm-12 form-add-inmovable noPaddingLeft">
                <div class="col-sm-8 noPaddingLeft">
                  <div class="col-sm-3 noPaddingLeft"><label for="email-confirm">Confirmar E-mail</label></div>
                  <div class="col-sm-9"><input type="text" value="<?= set_value('email-confirm') ?>" class="form-control" id="email-confirm" name="email-confirm"></div>
                  <div class="col-sm-9 col-sm-offset-3"><?php echo form_error('email-confirm'); ?></div>
                </div>              
              </div> 
              <div class="col-sm-12 form-add-inmovable noPaddingLeft">
                <div class="col-sm-6 noPaddingLeft">
                  <div class="col-sm-4 noPaddingLeft"><label for="password">Contraseña</label></div>
                  <div class="col-sm-8"><input type="password" value="<?= set_value('password') ?>" class="form-control" id="password" name="password"></div>
                  <div class="col-sm-8 col-sm-offset-4"><?php echo form_error('password'); ?></div>
                </div>
                <div class="col-sm-6 noPaddingLeft">
                  <div class="col-sm-4 noPaddingLeft"><label for="password-confirm">Confirmar contraseña</label></div>
                  <div class="col-sm-8"><input type="password" value="<?= set_value('password-confirm') ?>" class="form-control" id="password-confirm" name="password-confirm"></div>
                  <div class="col-sm-8 col-sm-offset-4"><?php echo form_error('password-confirm'); ?></div>
                </div>                
              </div>  
              <div class="col-sm-12 form-add-inmovable noPaddingLeft"><hr></div>
              <div class="col-sm-12 form-add-inmovable noPaddingLeft">
                <div class="col-sm-6 noPaddingLeft">
                  <div class="col-sm-12 noPaddingLeft noPaddingRight">
                    <div class="col-sm-3 noPaddingLeft"><label for="phone">Teléfono</label></div>
                    <div class="col-sm-9"><input type="text" value="<?= set_value('phone') ?>" class="form-control" id="phone" name="phone"></div>
                    <div class="col-sm-9 col-sm-offset-3"><?php echo form_error('phone'); ?></div>
                  </div><br><br><br>
                  <div class="col-sm-12 noPaddingLeft noPaddingRight">
                    <div class="col-sm-3 noPaddingLeft"><label for="cellphone">Teléfono celular</label></div>
                    <div class="col-sm-9"><input type="text" value="<?= set_value('cellphone') ?>" class="form-control" id="cellphone" name="cellphone"></div>
                    <div class="col-sm-9 col-sm-offset-3"><?php echo form_error('cellphone'); ?></div>
                  </div>                  
                </div>
                <div class="col-sm-6 noPaddingLeft">
                  <div class="col-sm-3 noPaddingLeft"><label for="address">Dirección</label></div>
                  <div class="col-sm-9"><textarea class="form-control" id="address" name="address"><?= set_value('address') ?></textarea></div>
                  <div class="col-sm-9 col-sm-offset-3"><?php echo form_error('address'); ?></div>
                </div>                
              </div> 
              <div class="col-sm-12 form-add-inmovable noPaddingLeft">
                <div class="col-sm-6 noPaddingLeft">
                  <div class="col-sm-3 noPaddingLeft"><label for="states_id">Estado</label></div>
                  <div class="col-sm-9">
                    <select name="states_id" id="states_id" class="form-control">
                      <option value="-1">Estado</option>
                      <?php foreach ($allstates as $key => $value) { ?>
                        <option value="<?= $value['id']?>" <?= set_select('states_id', $value['id']) ?>><?= $value['name']?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-9 col-sm-offset-3"><?php echo form_error('states_id'); ?></div>
                </div>                
              </div> 
              <div class="col-sm-12 form-add-inmovable noPaddingLeft"><hr></div>
              <div class="col-sm-12 form-add-inmovable noPaddingLeft">
                <input class="col-sm-1" type="checkbox" id="notifications" <?= set_checkbox('notifications','0')?> >
                <input class="col-sm-1" type="hidden" name="notifications" id="notifications_hidden" value="0" <?= set_value('notifications')?> >
                <label class="col-sm-11">Quiero recibir notificaciones de nuevos inmuebles</label>
              </div>  
              <div class="col-sm-12 form-add-inmovable noPaddingLeft">
                <input class="col-sm-1" class="form-control" type="checkbox" id="terms" <?= set_checkbox('terms','1')?>>
                <input class="col-sm-1" type="hidden" name="terms" id="terms_hidden" value="-1" <?= set_value('terms')?> >
                <label class="col-sm-11"><a href="#">Acepto términos y condiciones</a></label>
                <div class="col-sm-12"><?php echo form_error('terms'); ?></div>
              </div>  
              <div class="col-sm-12 form-add-inmovable noPaddingLeft">
                <input class="col-sm-1" class="form-control" type="checkbox" id="personal_data" <?= set_checkbox('personal_data','1')?>>
                <input class="col-sm-1" type="hidden" name="personal_data" id="personal_data_hidden" value="-1" <?= set_value('personal_data')?> >
                <label class="col-sm-11">Estoy de acuerdo y acepto el tratamiendo de mis Datos Personales</label>
                <div class="col-sm-12"><?php echo form_error('personal_data'); ?></div>
              </div>  
              <div class="col-sm-12 form-add-inmovable noPaddingLeft"><hr></div>
              <div class="col-sm-12 form-add-inmovable noPaddingLeft text-right">
                <button class="btn btn-default">Registrar</button>
              </div>

            </form>
          </div>
          <div class="col-sm-2"></div>
         
        </div> <!--container-->
    </body>
    <?php include("layaouts/footer.php");  ?>
</html>
