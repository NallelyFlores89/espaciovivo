<!doctype html>
<html>

    <title>Espacio Vivo - Inmuebles</title>
    <?php include("layaouts/header.php");  ?>
    <body>
        <div class="container">
          <?= $navbar ?>        
          <div class="col-sm-4">
            <h3 class="reference"> <?= strtoupper($trade_agreement) ?> // <?= strtoupper($immovable_type) ?></h3>
            <ul id="suburbs" class="col-sm-12 gray-background">
            <?php foreach ($suburbs as $key => $value) { ?>
              <li class="searchBySuburb" idsuburbsearch="<?= $value['id']?>" tradeagreementid="<?= $trade_agreement_id ?>" immovabletypeid="<?= $immovable_type_id ?>"><?= $value['name'] ?></li>
            <?php }?>
            </ul>
          </div>
          <div id="immovables-list" class="col-sm-8">
          <?php foreach ($immovables as $key => $value) { ?>
          <a href="<?= base_url()?>inmueble/detalle/<?= $value['code']?>">
            <div class="immovables-box row">
              <div class="col-sm-12"><h4 class="title"><?=$value['title']?> / <?= $value['code']?></h4></div>
              <div class="col-sm-4">
                <?php if(isset($value['images'][0]['url'])){?>
                <div class="col-sm-12" style="background-image:url(<?= base_url()?>public/uploads/<?= $value['images'][0]['url']?>); height:100px; background-size:cover; background-repeat:no-repeat;"></div>
                <?php }?>
              </div>
              <div class="col-sm-4">
                <p><?= $value['immovables_type'] ?></p>
                <p>Col. <?= $value['suburb']?></p>
                <p><?= $value['street']?> <?= $value['number_int']?></p>
              </div>
              <div class="col-sm-4">
                <p><?= $value['bedroom']?> Recamaras</p>
                <p><?php if($value['parking'] == 1){echo "Estacionamiento";}else{ echo "No Estacionamiento";}?></p>
              </div>
            </div>
          </a>
          <?php  } ?>
          </div> 
         
        </div> <!--container-->
    </body>
    <?php include("layaouts/footer.php");  ?>
</html>
