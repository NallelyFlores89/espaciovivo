<!doctype html>
<html>
    <?php include("layaouts/header.php");  ?>
    <body>
        <title>Inicio</title>
        <div class="container">
          <?= $navbar ?>
          
         <div id="myCarousel" class="col-sm-12 carousel slide" data-ride="carousel">
    <!-- Indicators -->
<!--         <ol class="carousel-indicators">
          <?php foreach ($allsliders as $key => $value) { 
            if($key == 0){ ?>
              <li data-target="#myCarousel" data-slide-to="<?= $key ?>" class="active"></li>
            <?php  }else{ ?>       
              <li data-target="#myCarousel" data-slide-to="<?= $key ?>"></li>
          <?php }} ?>
        </ol>
 -->
    <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <?php foreach ($allsliders as $key => $value) { 
                if($key == 0){ ?>
                  <div class="item active">
                    <?php if($value['title'] != null || $value['description'] != null || $value['dir'] != null){?>
                    <div class="carousel-caption slider-title-home">
                      <h3><b><?= $value['title']?></b></h3>
                      <p class="title"><?= $value['description']?></p>
                      <?php if($value['dir'] != null){ ?>
                      <a href="<?= $value['dir']?>">Mas info [+]</a>
                      <?php }?>
                    </div>
                    <?php } ?>
                    <img class="active" src="<?= base_url()?><?= $value['url']?>">
                  </div>
                <?php  }else{ ?>       
                  <div class="item">
                    <?php if($value['title'] != null || $value['description'] != null || $value['dir'] != null){?>
                    <div class="carousel-caption slider-title-home">
                      <h3><b><?= $value['title']?></b></h3>
                      <p class="title"><?= $value['description']?></p>
                      <?php if($value['dir'] != null){ ?>
                      <a href="<?= $value['dir']?>">Mas info [+]</a>                    
                      <?php }?>
                    </div>
                    <?php } ?>
                    <img class="active" src="<?= base_url()?><?= $value['url']?>">
                  </div>
              <?php }} ?> 

   </div>

    <!-- Left and right controls -->
<!--     <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>os
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a> -->
  </div>

        </div> <!--container-->

  </body>
  <?php include("layaouts/footer.php");  ?>
</html>