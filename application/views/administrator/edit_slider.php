<!doctype html>
<html>
    <title>Espacio Vivo - Administrador - Panel</title>
    <?php include("layaouts/header.php");  ?>
    <body>
        <div class="container">
          <?= $navbar ?>        
          <div class="row">
            <div class="col-sm-12 text-center">
              <br><br>
              <div class="col-sm-12">
                <img class="col-sm-6 col-sm-offset-3" src="<?= base_url()?><?=$sliders['url']?>">
              </div>
              <form id="editSliderForm" action="<?=base_url()?>administrador/edit_slider_submit" class="grayForm col-sm-6 col-sm-offset-3" method="post">
                <div class="col-sm-12 form-add-inmovable">
                  <div class="col-sm-4"><label>Título</label></div>
                  <div class="col-sm-8"><input type="text" name="title" class="form-control" value="<?=set_value('title', isset($sliders['title']) ? $sliders['title'] : '')?>" ></div>
                  <div class="col-sm-8"><input type="hidden" name="id" class="form-control" value="<?=set_value('id', isset($sliders['id']) ? $sliders['id'] : '')?>" ></div>
                </div>
                <div class="col-sm-12 form-add-inmovable">
                  <div class="col-sm-4"><label>Descripción</label></div>
                  <div class="col-sm-8"><textarea name="description" class="form-control"><?=set_value('description', isset($sliders['description']) ? $sliders['description'] : '')?></textarea></div>
                </div>
                <div class="col-sm-12 form-add-inmovable">
                  <div class="col-sm-4"><label>Ruta</label></div>
                  <div class="col-sm-8"><input type="text" name="dir" class="form-control" value="<?=set_value('dir', isset($sliders['dir']) ? $sliders['dir'] : '')?>"></div>
                </div>

              <div class="col-sm-12 form-add-inmovable text-right">
                <button type="submit" class="btn btn-default">Guardar cambios</button>
              </div>
                              
              </form>
            </div>
          </div>
        </div> <!--container-->
    </body>
    <?php include("layaouts/footer.php");  ?>
</html>
