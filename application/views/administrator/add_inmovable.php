<!doctype html>
<html>

    <?php include("layaouts/header.php");  ?>
    <title>Espacio Vivo - Administrador - Panel</title>

    <script>
      $(document).ready(function() {

          if($("body").hasClass("hasImages")){
            images_backup = $("input[name='images[]']");
            console.log(images_backup);
          }
          Dropzone.autoDiscover = false;
          var fileList = new Array;
          var i =0;
          $(".dropzone").dropzone({
              addRemoveLinks: true,
              init: function() {

                  // Hack: Add the dropzone class to the element
                  $(this.element).addClass("dropzone");

                  this.on("success", function(file, serverFileName) {
                      $("input[name='images[]']").remove();
                      fileList[i] = {"serverFileName" : serverFileName, "fileName" : file.name,"fileId" : i };
                      i++;
                      string = "";
                      Object.keys(fileList).forEach(function(key) {
                          string = string + "<input type='hidden' name='images[]' value='"+ fileList[key].serverFileName+"'>";
                      });

                      if($("body").hasClass("hasImages")){

                        for(i=0; i<images_backup.length; i++){
                          string = string + "<input type='hidden' name='images[]' value='"+ images_backup[i].value+"'>";
                        }        
                      }           
                      console.log(string);
                      $("#addinmovable_form").append(string)
                  });
                  this.on("removedfile", function(file) {
                      var rmvFile = "";
                      for(f=0;f<fileList.length;f++){

                          if(fileList[f].fileName == file.name)
                          {
                              rmvFile = fileList[f].serverFileName;

                          }

                      }
                      if (rmvFile){
                          $.ajax({
                              url: base + "administrador/delete_upload_images",
                              type: "POST",
                              data: { "name" : rmvFile }
                          });
                      }
                  });

              },
              url: base+"administrador/upload_images"
          });
      });
    </script>
    <body <?php if(isset($images)){ echo 'class="hasImages"'; }?>>
        <div class="container">
          <?= $navbar ?>        
          <div class="row">
            <h1 class="title">AGREGAR INMUEBLE</h1>
            <form id="addinmovable_form" class="col-sm-10 grayForm" method="post" action="<?= base_url()?>administrador/add_inmovable" enctype="multipart/form-data">
              <div class="row form-add-inmovable">
                <div class="col-sm-2"><label for="title">Título</label></div>
                <div class="col-sm-10"><input type="text" value="<?= set_value('title') ?>" class="form-control" id="title" name="title"></div>
                <div class="col-sm-10 col-sm-offset-2"><?php echo form_error('title'); ?></div>
              </div>  

              <div class="col-sm-12"><hr></div>
            
              <div class="row form-add-inmovable">
                <div class="col-sm-2"><label for="street" class="">Calle</label></div>
                <div class="col-sm-6"><input type="text" value="<?=set_value('street')?>" class="form-control " id="street" name="street"></div>
                <div class="col-sm-6 col-sm-offset-2"><?php echo form_error('street'); ?></div>
              </div>   

              <div class="row form-add-inmovable">
                <div class="col-sm-4 noPaddingLeft">
                  <div class="col-sm-6"><label for="number_ext" class="">Num. Ext.</label></div>
                  <div class="col-sm-6"><input type="text" value="<?=set_value('number_ext')?>" class="form-control " id="number_ext" name="number_ext"></div>
                  <div class="col-sm-6 col-sm-offset-6"><?php echo form_error('number_ext'); ?></div>
                </div>
                <div class="col-sm-4 noPaddingRight">
                  <div class="col-sm-6"><label for="number_int" class="">Num. Int.</label></div>
                  <div class="col-sm-6"><input type="text" value="<?= set_value('number_int')?>" class="form-control " id="number_int" name="number_int"></div>
                  <div class="col-sm-6 col-sm-offset-6"><?php echo form_error('number_int'); ?>  </div>
                </div>
              </div>  

              <div class="row form-add-inmovable ui-widget">
                <div class="col-sm-2"><label>Estado</label></div>
                <div class="col-sm-6">
                  <select name="states_id" id="states_id" class="form-control">
                    <option value="-1">Estado</option>
                    <?php foreach ($allstates as $key => $value) { ?>
                      <option value="<?= $value['id']?>" <?= set_select('states_id', $value['id']) ?>><?= $value['name']?></option>
                    <?php } ?>
                  </select>
                </div>
                 <div class="col-sm-6 col-sm-offset-2"><?php echo form_error('states_id'); ?>  </div>
              </div>

              <div class="row form-add-inmovable">
                <div class="col-sm-3"><label for="city_id" class="">Delegación / Municipio</label></div>
                <div class="col-sm-5">
                  <select name="city_id" id="city_id" class="form-control"></select>
                  <input type="hidden" value="<?= set_value('city_id')?>" id="city_selected">
                </div>
                <div class="col-sm-5 col-sm-offset-3"><?php echo form_error('city_id'); ?></div>
              </div>  

              <div class="row form-add-inmovable">
                <div class="col-sm-2"><label for="suburbs_id" class="">Colonia</label></div>
                <div class="col-sm-6" id="suburbs_select">
                  <select name="suburbs_id" id="suburbs_id" class="form-control"></select>                  
                  <input type="hidden" value="<?= set_value('suburbs_id')?>" id="suburb_selected">
                </div>
                <div class="col-sm-6" id="add_suburbs" style="display:none">
                  <input type="text" class="form-control" id="add_suburbs_input_text" name="new_suburb">
                </div>                
                <div class="col-sm-1">
                  <button id="add_suburb_btn" type="button" class="btn btn-default" aria-label="Left Align">
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                  </button>
                </div>
                <div class="col-sm-6 col-sm-offset-2"><?php echo form_error('suburbs'); ?></div>
              </div>                                                             

              <div class="row form-add-inmovable">
                <div class="col-sm-2"><label for="town" class="">Ciudad</label></div>
                <div class="col-sm-6"><input type="text" value="<?= set_value('town')?>" class="form-control " id="town" name="town"></div>
                <div class="col-sm-6 col-sm-offset-2"><?php echo form_error('town'); ?></div>
              </div> 

              <div class="col-sm-12"><hr></div>

              <div class="row form-add-inmovable">
                <div class="col-sm-3"><label for="immovables_type_id" class="">Tipo de inmueble</label></div>
                <div class="col-sm-5">
                  <select name="immovables_type_id" id="immovables_type_id" class="form-control">
                      <option value="-1">Selecciona un tipo de inmueble</option>
                    <?php foreach ($allimmovablestype as $key => $value) { ?>
                      <option value="<?= $value['id']?>"><?= $value['name']?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-sm-5 col-sm-offset-3"><?php echo form_error('immovables_type_id'); ?></div>
              </div> 

              <div class="row form-add-inmovable">
                <div class="col-sm-3"><label for="construction" class="">Construcción</label></div>
                <div class="col-sm-2 noPaddingRight"><input name="construction" id="construction" value="<?= set_value('construction')?>" type="text" class="form-control "></div>
                <div class="col-sm-3">
                  <select name="construction_type" id="construction_type" class="form-control">
                    <?php foreach ($construction_types as $key => $value) { ?>
                      <option value="<?= $key ?>"><?= $value ?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-sm-5 col-sm-offset-3"><?php echo form_error('immovables_type_id'); ?></div>
              </div>               

              <div class="row form-add-inmovable">
                <div class="col-sm-3"><label for="immovables_type_id" class="">Acuerdo comercial</label></div>
                <div class="col-sm-5">
                    <select name="trade_agreements_id" id="" class="form-control">
                      <?php foreach ($alltradeagreements as $key => $value) { ?>
                        <option value="<?= $value['id']?>" <?= set_select('trade_agreements_id',$value['id'])?>><?= $value['name']?></option>
                      <?php }?>
                    </select>
                </div>
                <div class="col-sm-8"><?php echo form_error('trade_agreements_id'); ?></div>
              </div>            

              <div class="row form-add-inmovable">
                <div class="col-sm-4 noPaddingLeft noPaddingRight">
                  <div class="col-sm-4"><label for="price">Precio</label></div>
                  <div class="col-sm-8 noPaddingRight"><input name="price" id="price" value="<?= set_value('price')?>" type="text" class="form-control "></div>
                  <div class="col-sm-8 col-sm-offset-4 noPaddingRight"><?php echo form_error('price'); ?></div>
                </div>
                <div class="col-sm-4">
                  <div class="col-sm-5"><label for="contract_id">Contrato</label></div>
                  <div class="col-sm-7 noPaddingRight">
                    <select name="contract_id" id="contract_id" class="form-control">
                     <option value="-1">Tipo de contrato</option>
                      <?php foreach ($allcontracts as $key => $value) { ?>
                        <option value="<?= $value['id']?>" <?= set_select('contract_id',$value['id'])?>><?= $value['name']?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col-sm-8 col-sm-offset-4 noPaddingRight"><?php echo form_error('contract_id'); ?></div>

                </div>
                <div class="col-sm-4">
                  <div class="col-sm-4"><label for="">Moneda</label></div>
                  <div class="col-sm-8 noPaddingRight">
                    <select class="form-control" id="currency" name="currency">
                      <option value="MXN">MXN</option>
                      <option value="USD">USD</option>
                    </select>
                  </div>
                  <div class="col-sm-8 col-sm-offset-4 noPaddingRight"><?php echo form_error('currency'); ?></div>
                </div>
              </div>

              <div class="row form-add-inmovable">
                <div class="col-sm-4 noPaddingLeft noPaddingRight">
                  <div class="col-sm-6 noPaddingRight"><label for="extra_costs">Costos extras</label></div>
                  <div class="col-sm-6 noPaddingRight noPaddingLeft"><input type="text" value="<?= set_value('extra_costs') ?>" class="form-control" name="extra_costs" id="extra_costs"></div>
                </div>
                <div class="col-sm-8">
                  <div class="col-sm-3"><label for="concept">Concepto</label></div>
                  <div class="col-sm-9 noPaddingRight"><input type="text" value="<?= set_value('concept')?>" class="form-control" name="concept" id="concept"></div>
                  <div class="col-sm-10 col-sm-offset-2 noPaddingRight"><?php echo form_error('concept'); ?></div>                  
                </div>
              </div>

              <div class="col-sm-12"><hr></div>

              <div class="row form-add-inmovable">
                <div class="col-sm-6 noPaddingRight noPaddingLeft">
                  <div class="col-sm-6"><label for="bedroom">Recámaras/Cuartos</label></div>
                  <div class="col-sm-6"><input type="text" class="form-control" value="<?= set_value('bedroom')?>" name="bedroom" id="bedroom"></div>
                  <div class="col-sm-6 col-sm-offset-6"><?php echo form_error('bedroom'); ?></div>                  
                </div>
                <div class="col-sm-4">
                  <div class="col-sm-3"><label for="toilet">Baños</label></div>
                  <div class="col-sm-9"><input type="text" class="form-control" value="<?= set_value('toilet')?>" name="toilet" id="toilet"></div>
                  <div class="col-sm-9 col-sm-offset-3"><?php echo form_error('bedroom'); ?></div>                  
                </div>
              </div>

              <div class="row form-add-inmovable">
                <div class="col-sm-8 noPaddingLeft">
                  <div class="col-sm-4"><label for="parking">Estacionamiento</label></div>
                  <div class="col-sm-8">
                    <div class="col-sm-6">
                      <label class="col-sm-4">Sí</label> 
                      <input class="col-sm-8 parking_op" type="radio" name="parking_op" value="1" <?= set_checkbox('parking_op','1')?>>
                    </div>                    
                    <div class="col-sm-6">
                      <label class="col-sm-4">No</label>
                      <input class="col-sm-8 parking_op" type="radio" name="parking_op" value="0" <?= set_checkbox('parking_op','0')?>>
                    </div>  
                    <div class="col-sm-12"><?php echo form_error('parking_op'); ?></div>                  
                  </div>
                </div>
                <div class="col-sm-4" id="parking-cant">
                  <div class="col-sm-5"><label for="parking">Cantidad</label></div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="parking" id="parking">
                    <div class="col-sm-12 noPaddingLeft noPaddingRight"><?php echo form_error('parking'); ?></div>                  
                  </div>
                </div>                
              </div>

              <div class="row form-add-inmovable">
                <div class="col-sm-8 noPaddingLeft">
                  <div class="col-sm-4"><label for="kitchen">Cocina</label></div>
                  <div class="col-sm-8">
                    <div class="col-sm-6">
                      <label class="col-sm-4">Sí</label>
                      <input class="col-sm-8" type="radio" name="kitchen" id="kitchen" value="1" <?= set_checkbox('kitchen','1')?>>
                    </div>                    
                    <div class="col-sm-6">
                      <label class="col-sm-4">No</label>
                      <input class="col-sm-8" type="radio" name="kitchen" id="kitchen" value="0" <?= set_checkbox('kitchen','0')?>>
                    </div>                      
                  </div>
                </div>           
              </div>
              
              <div class="row form-add-inmovable">
                <div class="col-sm-9 noPaddingLeft">
                  <div class="col-sm-3"><label for="description">Descripción</label></div>
                  <div class="col-sm-9 noPaddingLeft">
                    <textarea class="form-control" name="description" id="description"><?= set_value('description')?></textarea>
                  </div>
                  <div class="col-sm-9 col-sm-offset-3 noPaddingLeft"><?php echo form_error('description'); ?></div>                                    
                </div>
              </div>

              <div class="row form-add-inmovable">
                <div class="col-sm-9 noPaddingLeft">
                  <div class="col-sm-3"><label for="comments">Observaciones</label></div>
                  <div class="col-sm-9 noPaddingLeft">
                    <textarea class="form-control" name="comments" id="comments"><?= set_value('comments')?></textarea>
                  </div>                  
                </div>
              </div>


              <div class="row form-add-inmovable">
                <div class="col-sm-12 noPaddingLeft">
                  <div class="col-sm-2"><label for="images">Imágenes</label></div>
                  <div action="<?= base_url()?>administrador/upload_images" class="dropzone col-sm-10">
                    <div class="fallback noPaddingLeft">
                      <input id="file" name="file" type="file" multiple/>
                    </div>
                    <?php 
                    if(isset($images)){
                    foreach ($images as $key => $value) { ?>
                        <div class="dz-preview dz-processing dz-success dz-complete dz-image-preview">
                          <input type="hidden" value="<?= $value?>" name="images[]">
                          <div class="dz-image">
                            <img data-dz-thumbnail src="<?=base_url().'public/uploads/thumbs/'.$value ?>" >
                          </div>
                          <a class="dz-remove" data-dz-remove="">Borrar</a>
                        </div>
                      <?php }}?>                     
                  </div>
                </div>
              </div>              

              <div class="col-sm-12 form-add-inmovable text-right">
                <button type="submit" class="btn btn-default">Continuar</button>
              </div>

            </form>

          </div>
        </div> <!--container-->
    </body>
    <?php include("layaouts/footer.php");  ?>
</html>