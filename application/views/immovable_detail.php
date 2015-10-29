<!doctype html>
<html>

    <title>Espacio Vivo - Administrador - Panel</title>
    <?php include("layaouts/header.php");  ?>
    <body>

        <link rel="stylesheet" href="<?=base_url()?>public/lib/owl-carousel/owl.carousel.css">    
        <link rel="stylesheet" href="<?=base_url()?>public/lib/owl-carousel/owl.theme.css">    
        <script src="<?=base_url()?>public/lib/owl-carousel/owl.carousel.js"></script>
        <script type="text/javascript" src="<?=base_url()?>public/lib/fancybox/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="<?=base_url()?>public/lib/fancybox/helpers/jquery.fancybox-buttons.js"></script>
        <script type="text/javascript" src="<?=base_url()?>public/lib/fancybox/helpers/jquery.fancybox-media.js"></script>

        <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
        <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-image-gallery.css">
        <link rel="stylesheet" href="<?=base_url()?>public/lib/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?=base_url()?>public/lib/fancybox/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?=base_url()?>public/lib/fancybox/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />

        <script type="text/javascript" src="<?=base_url()?>public/lib/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {
            $("#owl-example").owlCarousel({
              items:3
            });      
            $(".fancybox").fancybox();
 
            $("#imgShowed").click(function() {
                jumpto = parseInt($(this).attr("key"));
                console.log(jumpto);
                data = <?= $gallery ?>;
                $.fancybox.open(data,{
                    index:jumpto,
                    padding : 0
                });
                
                return false;
                
            });
          });
        </script>           
        <div class="container">
          <?= $navbar ?>        

          <div class="row">
            <div id="gallery" class="col-sm-6">
              <div id="blueimp-gallery" class="blueimp-gallery">
                  <!-- The container for the modal slides -->
                  <div class="slides"></div>
                  <a class="prev">‹</a>
                  <a class="next">›</a>
                  <a class="close">×</a>
                  <a class="play-pause"></a>
                  <ol class="indicator"></ol>
                  <!-- The modal dialog, which will be used to wrap the lightbox content -->
                  <div class="modal fade">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title"></h4>
                              </div>
                              <div class="modal-body next"></div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default pull-left prev">
                                      <i class="glyphicon glyphicon-chevron-left"></i>
                                      Previous
                                  </button>
                                  <button type="button" class="btn btn-primary next">
                                      Next
                                      <i class="glyphicon glyphicon-chevron-right"></i>
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-sm-12">
                <h3 class="reference"><?= $immovable['trade_agreements']?> // <?= $immovable['immovables_type'] ?> // <?= $immovable['code']?></h3>
              </div>
              <?php if(isset($immovable['images'][0])){?>
              <div id="bigImage" class="col-sm-12"><br><br>
                  <img id="imgShowed" key="0" style="background-image: url(<?= base_url()?>public/uploads/<?= $immovable['images'][0]['url']?>); background-size:cover; height:300px"/><br><br>
                  <!-- <img id="imgShowed" key="0" src="<?= base_url()?>public/uploads/<?= $immovable['images'][0]['url']?>"/><br><br>-->
              </div>
              <div id="links col-sm-12">
                <div id="owl-example" class="owl-carousel">
                  <?php foreach ($immovable['images'] as $key => $value) { ?>
                    <div>
                      <center>
                            <img img="<?= $value['url']?>" key="<?= $key ?>" class="thumbnail-carousel" style="background-image:url(<?= base_url()?>public/uploads/thumbs/<?= $value['url']?>); background-size:cover; height:120px; width:120px;">
                            <!-- <img img="<?= $value['url']?>" key="<?= $key ?>" class="thumbnail-carousel" src="<?= base_url()?>public/uploads/thumbs/<?= $value['url']?>" alt="Banana"> -->
                      </center>
                    </div>
                  <?php } ?>   
                </div>
              </div>
              <?php }else{?>
              <div id="bigImage" class="col-sm-12"><br><br>
                <h2 class="title text-center">Galería no disponible</h2>
              </div>
              <?php } ?>

            </div>
            <div id="detail" class="col-sm-6 col-xs-12">
              <h3 class="title"><?=$immovable['title']?></h1>
              <?php if(isset($immovable['street']) && $immovable['street'] != null){?>
                <div class="row ArialFont">
                  <div class="col-sm-5"><label class="gray">Dirección</label></div>
                  <div class="col-sm-7"><?= $immovable['street'] ?></div>
                </div>
              <?php }?>
              <?php if(isset($immovable['number_ext']) && $immovable['number_ext'] != null){?>
                <div class="row ArialFont">
                  <div class="col-sm-5"><label class="gray">Número exterior</label></div>
                  <div class="col-sm-7"> <?= $immovable['number_ext']?></div>
                </div>
              <?php }?>
              <?php if(isset($immovable['number_int']) && $immovable['number_int'] != null){?>
                <div class="row ArialFont">
                  <div class="col-sm-5"><label class="gray">Número interior</label></div>
                  <div class="col-sm-7"> <?= $immovable['number_int']?></div>
                </div>
              <?php }?>
              <?php if(isset($immovable['suburb']) && $immovable['suburb'] != null){?>              
                <div class="row ArialFont">
                  <div class="col-sm-5"><label class="gray">Colonia</label></div>
                  <div class="col-sm-7"><?= $immovable['suburb'] ?></div>
                </div>
              <?php }?>
              <?php if(isset($immovable['city']) && $immovable['city'] != null){?>              
                <div class="row ArialFont">
                  <div class="col-sm-5"><label class="gray">Ciudad</label></div>
                  <div class="col-sm-7"><?= $immovable['city'] ?></div>
                </div>
              <?php }?>  
              <?php if(isset($immovable['construction']) && $immovable['construction'] != null){?>                         
                <div class="row ArialFont">
                  <div class="col-sm-5"><label class="gray">Construcción</label></div>
                  <div class="col-sm-7">
                    <?= $immovable['construction'] ?> 
                    <?php 
                      if($immovable['construction_type'] == 1){ echo "M2 de construcción";} 
                      if($immovable['construction_type'] == 2){ echo "M2 de terreno";} 
                      if($immovable['construction_type'] == 3){ echo "Hectáreas";} 

                    ?>
                  </div>
                </div>
              <?php } ?>
              <?php if(isset($immovable['bedroom']) && $immovable['bedroom'] != null && $immovable['immovables_type_id'] != 7){?>                                       
                <div class="row ArialFont">
                  <div class="col-sm-5"><label class="gray">Recámaras</label></div>
                  <div class="col-sm-7"><?= $immovable['bedroom'] ?></div>
                </div>
              <?php } ?>
              <?php if(isset($immovable['toilet']) && $immovable['toilet'] != null && $immovable['immovables_type_id'] != 7){?>                                                     
                <div class="row ArialFont">
                  <div class="col-sm-5"><label class="gray">Baños</label></div>
                  <div class="col-sm-7"><?= $immovable['toilet'] ?></div>
                </div>
              <?php } ?>
              <?php if( $immovable['immovables_type_id'] != 7){?>               
              <div class="row ArialFont">
                <div class="col-sm-5"><label class="gray">Estacionamientos</label></div>
                <div class="col-sm-7"><?php if($immovable['parking'] == 0){echo "NO";}else{echo $immovable['parking'];} ?></div>
              </div>
              <?php } ?>              
              <div class="row ArialFont">
                <div class="col-sm-5"><label class="gray">Precio</label></div>
                <div class="col-sm-7"><?= $immovable['price'] ?> <?= $immovable['currency']?></div>
              </div>
              <?php if(isset($immovable['extra_costs']) && $immovable['extra_costs'] != null){?>                                                                   
                <div class="row ArialFont">
                  <div class="col-sm-5"><label class="gray">Costos Extra</label></div>
                  <div class="col-sm-7"><?= $immovable['extra_costs'] ?> <?= $immovable['currency']?>
                  <?php if(isset($immovable['concept']) && $immovable['concept'] != null){?>
                  ( <?= $immovable['concept']?> )
                  <?php } ?>
                   </div>
                </div>
              <?php } ?>
              <?php if(isset($immovable['description']) && $immovable['description'] != null){?>         
                <div class="row ArialFont">
                  <div class="col-sm-12"><label class="gray">Descripción</label></div>
                  <div class="col-sm-12"><?= $immovable['description'] ?></div>
                </div>  
              <?php } ?>
              <?php if(isset($immovable['comments']) && $immovable['comments'] != null){?>         
                <div class="row ArialFont">
                  <div class="col-sm-12"><label class="gray">Comentarios</label></div>
                  <div class="col-sm-12"><?= $immovable['comments'] ?></div>
                </div>  
              <?php } ?>              
              <div id="detailsBtns" class="row">
                <div class="col-sm-8" id="favorites">
                  <button class="btn btn-default" onclick="check_favorite('<?= $immovable['id']?>')">
                  <?php if(isset($is_favorite) && $is_favorite == 1 ){?>
                    <span id="favorite-icon" class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    <label id="tag-favorite">Favorito</label>
                  <?php } ?>
                  <?php if(isset($is_favorite) && $is_favorite == -1 ){?>
                    <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                    <label id="tag-favorite">Marcar como favorito</label>
                  <?php } ?>       
                  <?php if(!isset($is_favorite)){?>
                    <span id="favorite-icon" class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                    <label id="tag-favorite">Marcar como favorito</label>
                  <?php } ?>                                 
                  </button>
                </div>
                <div class="col-sm-4">
                  <a href="<?= base_url()?>inmueble/generar/<?= $immovable['code']?>"><button id="favorite-icon" class="btn btn-default" onclick="">
                  <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                  <label id="">Descargar Ficha</label></button></a>
                </div>
              </div>                             
            </div>
          </div>
        </div> <!--container-->
    </body>
 
    <?php include("layaouts/footer.php");  ?>
</html>
