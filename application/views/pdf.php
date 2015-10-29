<style "type=text/css">
    #detail th{color: #fff; font-weight: bold; background-color: #e6e6e6;}
    #detail td{background-color: #e6e6e6; color: #000;}
</style>
    <div>
       <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
       <!-- <a href="www.espaciovivomexico.com"><img id="#logo" src="<?= base_url()?>public/images/logo.png"/></a> -->
    </div>
    <table style="">       
        <tr>
            <td><img id="#logo" width="200px" src="<?= base_url()?>public/images/vivopdf.jpg"/></td>
            <!-- <td><img id="#logo" width="150px" src="<?= base_url()?>public/images/logo.png"/></td> -->
            <td>
                www.espaciovivomexico.com<br>
                Tel. 55.54.36.36.70<br>
                info.espaciovivo@gmail.com
            </td>            
        </tr>
    </table>
    <h2 style="text-decoration:underline"><?= $title ?></h2><br>
    <?= $street ?>
    <?php if(isset($number_ext) && $number_ext != null ){ ?>
        N. Ext. <?= $number_ext ?>
    <?php } ?>
    <?php if(isset($number_int) && $number_int != null ){ ?>
        Int. <?= $number_int ?> 
    <?php } ?>
    <?php if(isset($suburb) && $suburb != null ){ ?>
        , <?= $suburb ?>
    <?php } ?>  
    <?php if(isset($city) && $city != null ){ ?>
    , <?= $city ?> 
    <?php } ?> <br><br><br>
    <table id="detail" width='50%'>
        <tr>
            <td style="background-color:#bababa; padding:20px;">
                <!-- <b>Código: </b> <?= $code ?><br> -->
                
                <?php if(isset($bedroom) && $bedroom != null ){ ?>
                    Habitaciones: <?= $bedroom ?> <br>
                <?php } ?>
                <?php if(isset($toilet) && $toilet != null ){ ?>
                    Baños: <?= $toilet ?><br>
                <?php } ?>
                <?php if(isset($parking) && $parking != null ){ ?>
                    Estacionamientos: <?= $parking ?><br>
                <?php } ?>
                <?php if(isset($price) && $price != null ){ ?>
                    Precio: $ <?= $price ?> <?= $currency ?> <br>
                <?php } ?>

                <?php if(isset($extra_costs) && $extra_costs != null ){ ?>
                    Costos Extras: <?= $extra_costs ?> <?= $currency ?>  (<?= $concept ?>) <br>
                <?php } ?>
                
                <?php if(isset($description) && $description != null ){ ?>
                <br><br><?= $description ?>
                <?php } ?>

            </td>
            <td style="text-align:center" >
                <?php foreach ($images as $key => $value) { 
                    $img_route =rtrim("public/uploads/thumbs/".$value['url']);
                    if($key < 3){ ?>
                    <!-- <tr> -->
                        <img style="max-width=100%" src="<?= base_url(). $img_route ?>"/><br><br>
                    <!-- </tr> -->
                <?php  }} ?>
            </td>
        </tr>
    </table>
