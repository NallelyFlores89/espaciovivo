<!doctype html>
<html>
    <title>Espacio Vivo - Administrador - Panel</title>
    <?php include("layaouts/header.php");  ?>
    <body>
        <div class="container">
          <?= $navbar ?>        
          <div class="row">
            <h1 class="title">BIENVENIDO/A</h1>
            <p><?= $user['name']." ". $user['last_name']?>, aquí podrás administrar las publicaciones.</p>
          </div>          
          <div class="row">
            <div class="boxEspacioVivo col-sm-5">
                <p class="col-sm-12">Tus datos personales</p>
                <form id="updateAdminData" class="form col-sm-12" method="post" action="<?= base_url()?>administrador/editData">                  
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
                    <input id="bef_password" type="hidden" class="form-control" readonly value="<?= $user['password']?>">
                      <button field="password" class="editAdminDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>
                    </span>
                  </div> 
                  <?php echo form_error('password'); ?>          

                  <div class="form-group text-right">
                    <button id="saveAdminDataChange" class="btn btn-default" disabled>Guardar</button>
                  </div>
              </form>
            </div> <!--sm-5-->
            <div class="col-sm-3 text-center">
              <a href="<?= base_url()?>administrador/nuevo_inmueble"><button class="col-sm-12 btn btn-default btn-lg">
                  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                    Agregar inmueble
              </button></a>
              <a href="<?= base_url()?>administrador/slider"><button class="col-sm-12 btn btn-default btn-lg">
                  <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                    Administrar Sliders
              </button></a>              

            </div>
          </div> <!--row-->

          <div class="col-sm-12"><hr></div>
          <div class="row"> 
<!--             <div class="row">
              <div class="col-sm-8 noPaddingLeft noPaddingRight">
                <form id="searchForm" action="<?= base_url()?>inmueble/search" method="post">
                  <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Búsqueda por código o título">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                      </button>
                    </span>
                  </div>
                </form>
              </div>
            </div> -->
            <div class="row">
              <div id="immovables-list" class="col-sm-8">
                <?php if($immovables != -1){foreach ($immovables as $key => $value) { ?>
                <a href="<?= base_url()?>inmueble/detalle/<?= $value['code']?>">
                <div id="<?= $value['code'] ?>" class="immovables-box row">
                  <div class="col-sm-12"><h4 class="title"><?= $value['title']?> / <?= $value['code']?></h4></div>
                  <div class="col-sm-4">
                    <?php if(isset($value['images'][0]['url'])){?>
                    <div class="col-sm-12" style="background-image:url(<?= base_url()?>public/uploads/<?= $value['images'][0]['url']?>); height:100px; background-size:cover; background-repeat:no-repeat;"></div>
                    <?php } ?>
                  </div>
                  <div class="col-sm-4">
                    <p><?= $value['immovables_type'] ?></p>
                    <p>Col. <?= $value['suburb']?></p>
                    <p><?= $value['street']?> <?= $value['number_int']?></p>
                  </div>
                  <div class="col-sm-4">
                    <p><?= $value['bedroom']?> Recamaras</p>
                    <p><?php if($value['parking'] == 1){echo "Estacionamiento";}else{ echo "No Estacionamiento";}?></p>
                    <div class="col-sm-12 text-right">
<!--                       <a href="<?= base_url()?>inmueble/detalle/<?= $value['code']?>"><button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                      </button></a> -->
                      <a href="<?= base_url()?>inmueble/editar/<?= $value['code']?>"><button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      </button></a>                  
                      <button type="button" immovablecode="<?= $value['code']?>" class="delete-immovable-btn btn btn-default">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                      </button>                   
                    </div>
                  </div>
                </div> <!--immovables-box-->
                </a>
                <?php  }}?>
              </div>
              <div id="filters" class="col-sm-4">
                <div class="col-sm-12">
                  <h3 class="title"><b>Búsqueda por</b></h3>
                  <div class="col-sm-12"><label for="trade_agreements">Tipo de acuerdo</label></div>
                  <div class="col-sm-12">
                    <select class="form-control searchOption" id="trade_agreements">
                      <option value="-1">Todos</option>
                    <?php foreach ($alltradeagreements as $key => $value) { ?>
                      <option value="<?= $value['id']?>"><?= $value['name'] ?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="col-sm-12"><label for="immovable_types">Tipo de inmueble</label></div>
                  <div class="col-sm-12">
                    <select class="form-control searchOption" id="immovable_types">
                      <option value="-1">Todos  </option>
                    <?php foreach ($allimmovablestype as $key => $value) { ?>
                      <option value="<?= $value['id']?>"><?= $value['name'] ?></option>
                    <?php } ?>
                    </select>  
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="col-sm-12"><label for="states">Estado</label></div>
                  <div class="col-sm-12">
                    <select class="form-control searchOption" id="states">
                      <option value="-1">Todos</option>
                    <?php foreach ($allstates as $key => $value) { ?>
                      <option value="<?= $value['id']?>"><?= $value['name'] ?></option>
                    <?php } ?>
                    </select>  
                  </div>
                </div>   
                <!-- <div class="col-sm-12">
                  <div class="col-sm-12"><label for="cities">Delegación/Municipio</label></div>
                  <div class="col-sm-12">
                    <select class="form-control searchOption" id="cities">
                      <option value="-1">Todos</option>
                    </select>  
                  </div>
                </div>     
                <div class="col-sm-12">
                  <div class="col-sm-12"><label for="suburbs_select">Colonia</label></div>
                  <div class="col-sm-12">
                    <select class="form-control searchOption" id="suburbs_select">
                      <option value="-1">Todos</option>
                    </select>  
                  </div> -->
                </div>                                          
              </div>  <!--filters-->             
              </div>
            </div>
        </div> <!--container-->
    </body>
    <?php include("layaouts/footer.php");  ?>
</html>
