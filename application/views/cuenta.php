<!doctype html>
<html>
    <title>Espacio Vivo - Cuenta</title>
    <?php include("layaouts/header.php");  ?>
    <body>
        <div class="container">
          <?= $navbar ?>        
          <div class="row">
            <h1 class="title">BIENVENIDO/A</h1>
            <p><?= $user['name']." ". $user['last_name']?></p>
          </div>          
          <div class="row">
            <div class="boxEspacioVivo col-sm-4">
                <p class="col-sm-12">
                <h3 class="text-center"><span class="glyphicon glyphicon-user gold" aria-hidden="true"></span>
                  Perfil
                </h3>
                </p><br><br>
                <form id="updateAdminData" class="form col-sm-12" method="post" action="<?= base_url()?>cuenta/editData">                  
                  <div class="input-group">
                    <span class="input-group-btn">
                    <input id="name" name="name" type="text" class="form-control" readonly value="<?= $user['name']?>">
                    <input id="bef_name" type="hidden" class="form-control" readonly value="<?= $user['name']?>">
                      <button field="name" class="editAdminDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>
                    </span>
                  </div>
                  <?php echo form_error('name'); ?>                  

                  <div class="input-group">
                    <span class="input-group-btn">
                    <input id="last_name" name="last_name" type="text" class="form-control" readonly value="<?= $user['last_name']?>">
                    <input id="bef_last_name" type="hidden" class="form-control" readonly value="<?= $user['last_name']?>">
                      <button field="last_name" class="editAdminDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>
                    </span>
                  </div>  
                  <?php echo form_error('last_name'); ?>

                  <div class="input-group">
                    <span class="input-group-btn">
                    <input id="email" name="email" type="text" class="form-control" readonly value="<?= $user['email']?>">
                    <input id="bef_email" type="hidden" class="form-control" readonly value="<?= $user['email']?>">
                      <button field="email" class="editAdminDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>
                    </span>
                  </div>     
                  <?php echo form_error('email'); ?>

                  <div class="input-group">
                    <span class="input-group-btn">
                    <input id="password" name="password" type="password" class="form-control" readonly value="<?= $user['password']?>">
                    <input id="bef_password" type="hidden" class="form-control" readonly value="<?= $user['password'] ?>">
                      <button field="password" class="editAdminDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>
                    </span>
                  </div> 
                  <?php echo form_error('password'); ?>          

                  <div class="input-group">
                    <span class="input-group-btn">
                    <input id="phone" name="phone" type="text" class="form-control" readonly value="<?= $user['phone']?>">
                    <input id="bef_phone" type="hidden" class="form-control" readonly value="<?= $user['phone'] ?>">
                      <button field="phone" class="editAdminDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>
                    </span>
                  </div> 
                  <?php echo form_error('phone'); ?>   


                  <div class="input-group">
                    <span class="input-group-btn">
                    <?php if(isset($user['address']) && $user['address'] != null && $user['address'] != ""){ ?>
                      <input id="address" name="address" type="text" class="form-control" readonly value="<?= $user['address']?>">
                    <?php }else{ ?>
                      <input id="address" name="address" type="text" class="form-control" readonly value="<?= $user['address']?>" placeholder="Dirección">
                    <?php } ?>
                    <input id="bef_address" type="hidden" class="form-control" readonly value="<?= $user['address'] ?>">
                      <button field="address" class="editAdminDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>
                    </span>
                  </div> 
                  <?php echo form_error('address'); ?>  

                  <div class="col-sm-12 form-add-inmovable noPaddingLeft">
                    <input class="col-sm-1" type="checkbox" name="notifications" id="notifications" <?php if($user['notifications'] == 1){ echo "checked";} ?> >
                    <label class="col-sm-11">Quiero recibir notificaciones de nuevos inmuebles</label>
                  </div>  

                  <div class="form-group text-right">
                    <button id="saveAdminDataChange" class="btn btn-default">Guardar</button>
                  </div>
              </form>
            </div> <!--sm-4-->

            <div id="userFavorites" class="boxEspacioVivo col-sm-4 noPaddingLeft noPaddingRight">
              <p class="col-sm-12 text-center">
                <h3 class="text-center"><span class="glyphicon glyphicon-star gold" aria-hidden="true"></span>
                Tus favoritos</h3>
              </p><br><br>

              <?php if($favorites != -1){ foreach ($favorites as $key => $value) { ?>
                <div id="user_favorite_<?=$value['id']?>" class="immovables-box col-sm-12 noPaddingLeft noPaddingRight">
                  <div class="col-sm-6">
                    <div class="col-sm-12" style="background-image:url(<?= base_url()?>public/uploads/thumbs/<?= $value['images']['url']?>); height:100px; background-size:cover; background-repeat:no-repeat;"></div>
                  </div>
                  <div class="col-sm-6 noPaddingLeft noPaddingRight">
                    <p><?= $value['immovables_type'] ?></p>
                    <p>Col. <?= $value['suburb']?></p>
                    <p><?= $value['street']?> <?= $value['number_int']?></p>
                    <div class="col-sm-12 text-right">
                      <a href="<?= base_url()?>inmueble/detalle/<?= $value['code']?>"><button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                      </button></a>
                      <button type="button" class="btn btn-default" onclick="delete_favorite(<?= $value['id'] ?>)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                      </button>
                    </div>                    
                  </div>
                </div>
              <?php }}else{
                echo "<h3 class='text-center'>Aún no has agregado favoritos</h3>";
                } ?>
            </div>

            <div id="userAlerts" class="boxEspacioVivo col-sm-4">
                <h3 class="text-center"><span class="glyphicon glyphicon-flag gold" aria-hidden="true"></span>
                Notificaciones</h3>
                <?php if(isset($notifications) && $notifications != -1){ foreach ($notifications as $key => $value) { ?>
                  <div id="user_favorite_<?=$value['id']?>" class="immovables-box col-sm-12 noPaddingLeft noPaddingRight">
                    <div class="col-sm-6">
                      <div class="col-sm-12" style="background-image:url(<?= base_url()?>public/uploads/thumbs/<?= $value['images']['url']?>); height:100px; background-size:cover; background-repeat:no-repeat;"></div>
                    </div>
                    <div class="col-sm-6 noPaddingLeft noPaddingRight">
                      <p><?= $value['immovables_type'] ?></p>
                      <p>Col. <?= $value['suburb']?></p>
                      <p><?= $value['street']?> <?= $value['number_int']?></p>
                      <div class="col-sm-12 text-right">
                        <a href="<?= base_url()?>inmueble/detalle/<?= $value['code']?>"><button type="button" class="btn btn-default">
                          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button></a>
                      </div>                    
                    </div>
                  </div>
                <?php }}else{
                  echo "<h3 class='text-center'>NOTIFICACIONES DESACTIVADAS</h3>";
                  } ?>

            </div>            

          </div> <!--row-->

        </div> <!--container-->
    </body>
    <?php include("layaouts/footer.php");  ?>
</html>
