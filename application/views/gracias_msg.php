<!doctype html>
<html>
    <?php include("layaouts/header.php");  ?>
    <body>
        <title>Gracias por tu mensaje</title>
        <div id="gracias_msg" class="container text-center" style="">
          <?php include("layaouts/navbar.php");  ?>
          <br><br><br>
          <h2 class="title"><?= ucwords($name) ?>, ¡Gracias por tu mensaje!</h2><br><br>
          <h3>Dentro de poco nos pondremos en contacto contigo</h3><br><br><br>
          <?php include("layaouts/footer.php");  ?>
        </div> <!--container-->

    </body>
</html>
