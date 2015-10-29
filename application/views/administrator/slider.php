<!doctype html>
<html>
    <?php include("layaouts/header.php");  ?>
    <body>
        <title>Inicio</title>
        <div class="container">
          <?= $navbar ?><br><br>
          <div class="col-sm-12 text-right">
            <a href="<?= base_url()?>administrador/nuevo_slider"><button class="col-sm-3 col-sm-offset-9 btn btn-default btn-lg">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                  Nuevo Slider 
             </button></a>              
          </div>
          
          <div class="col-sm-12" id="">
            <?php if($sliders){
              foreach ($sliders as $key => $value) { ?>
                  <div id="slide-preview-<?=$value['id']?>" class="col-sm-4 slider-preview noPaddingLeft noPaddingRight" style="background-image:url(<?=base_url()?><?=$value['url']?>); height:400px; background-size:cover">
                    <div class="col-sm-12 slider-title "><h4 class="title"><?=$value['title']?></h4></div>
                    <div class="col-sm-12 botones noPaddingLeft noPaddingRight text-right">
                      <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default admin_slide_btn slider_btn_trash" idslide="<?=$value['id']?>">
                          <span class="admin_slide_btn_icon glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                        <a href="<?=base_url()?>administrador/editar_slider/<?=$value['id']?>"><button type="button" class="btn btn-default admin_slide_btn slider_btn_edit" idslide="<?=$value['id']?>">
                          <span class="admin_slide_btn_icon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button></a>
                      </div>
                    </div>
                  </div>
              <?php }?>
            <?php }?>
          </div>
        </div> <!--container-->
        

  </body>
  <?php include("layaouts/footer.php");  ?>
</html>
