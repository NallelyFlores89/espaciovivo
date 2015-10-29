              <form id="editSliderForm" action="<?=base_url()?>administrador/new_slider_submit" class="grayForm col-sm-6 col-sm-offset-3" method="post" enctype="multipart/form-data">
                <div class="col-sm-12"><span>La medida de la imagen debe ser de 1200 x 700 pixeles</span><br><br></div>
                <div class="col-sm-12 text-center">
                  <input type="file" accept="image/*" onchange="loadFile(event)" class="btn btn-default" name="photo" required>
                  <div class="col-sm-12 noPaddingLeft"><?php echo form_error('size'); ?></div>
                  <br><br>
                  <img id="output" class="col-sm-12" height="300px" />
                </div><br><br><br><br>
                <div class="col-sm-12 form-add-inmovable">
                  <br><br>
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