<nav class="navbar navbar-default noPaddingLeft" role="navigation">
<div class="col-sm-12"><br>
  <div id="do-sesion" class="col-sm-12 text-right">
    <?php if(!isset($user)){ ?>
    <a style="font-size:16px" href="<?= base_url()?>cuenta">Inicia Sesión</a> |
    <a style="font-size:16px" href="<?= base_url()?>registro">Regístrate</a>
    <?php }else{ ?>

    <a href="<?= base_url()?>cuenta">¡Hola <?= $user['name']?>!</a> |
    <a href="<?= base_url()?>cuenta/logout">Cerrar sesión</a>
    <?php }?>
  </div>
  <div class="col-sm-3 col-sm-offset-9">
    <div class="col-sm-6 noPaddinRight"><a href="https://www.facebook.com/espaciovivomx?fref=ts" target="_blank"><i  class="icon-large icon-facebook col-sm-1" aria-hidden="true"></i></a></div>
    <div class="col-sm-6 noPaddinRight"><a href="https://twitter.com/espaciovivomx" target="_blank"><i  class="icon-large icon-twitter col-sm-1" aria-hidden="true"></i></a></div>
  </div>
  <div class="col-sm-12 col-xs-12 text-center">
    <img src="<?= base_url()?>public/images/logo.png">
  </div>
</div>

  <div class="container-fluid col-sm-12 noPaddingLeft">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav col-sm-12">
        <li class="col-sm-2 text-center"><a href="<?= base_url()?>">INICIO <span class="sr-only">(current)</span></a></li>
        <li class="col-sm-2 text-center"><a href="<?= base_url()?>nosotros">NOSOTROS</a></li>
        <?php 
          foreach ($alltradeagreements as $value) {?>
            <li class="col-sm-2 dropdown text-center">
              <a href="<?= base_url().'inmuebles/'.$value['route']?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= mb_strtoupper($value['name'])?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <?php foreach ($allimmovablestype as $value2) { 
                  if((!isset($value2['except']) || $value2['except'] != $value['id']) && $value['id'] != 3 && $value2['id'] != 6){
                ?>
                  <li><a href="<?= base_url().'inmuebles/'.$value['route'].'/'.$value2['route']?>"><b><?= $value2['name'] ?></b></a></li>
                <?php }
                if($value['id'] == 3 && ($value2['id'] == 2 || $value2['id'] == 3)){?>
                  <li><a href="<?= base_url().'inmuebles/'.$value['route'].'/'.$value2['route']?>"><b><?= $value2['name'] ?></b></a></li>
                <?php }?>
                <?php if($value2['id'] == 6){?>
                  <li><a href="<?= base_url().'inmuebles/'.$value['route'].'/'.$value2['route']?>"><img src="<?= base_url()?>public/images/OFICINAS.png"></a></li>
                <?php }}?>
              </ul>
            </li>
        <?php  }   ?>
        <li class="col-sm-2 text-center"><a href="<?= base_url()?>contacto">CONTACTO</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="col-sm-12"><hr></div>
