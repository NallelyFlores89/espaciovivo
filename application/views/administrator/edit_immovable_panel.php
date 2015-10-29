<!doctype html>
<html>

    <title>Espacio Vivo - Administrador - Panel</title>
    <?php include("layaouts/header.php");  ?>

    <script>
      $(document).ready(function() {

          if($("body").hasClass("editModal")){
            images_backup = $("input[name='images[]']");
            for(i=0; i<images_backup.length; i++){
              console.log(images_backup[i].value);
            }
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
                      // console.log(fileList);
                      string = "";
                      Object.keys(fileList).forEach(function(key) {
                          string = string + "<input type='hidden' name='images[]' value='"+ fileList[key].serverFileName+"'>";
                          console.log(string);
                      });

/*                     for(i=0; i<images_backup.length; i++){
                        string = string + "<input type='hidden' name='images[]' value='"+ images_backup[i].value+"'>";
                        console.log(string)
                      }  */                    
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
    <body class="editModal">
        <div class="container">
          <?= $navbar ?>        
          <div class="row">
            <h1 class="title">CONFIRMAR INMUEBLE</h1>
            <form id="addinmovable_form" class="col-sm-9" method="post" action="<?= base_url()?>administrador/approve_inmovable" enctype="multipart/form-data">
              <div class="row form-add-inmovable">
                <div class="col-sm-2"><label for="title">Título</label></div>
                <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <input type="text" value="<?= set_value('title', isset($immovable['title']) ? $immovable['title'] : '');
 ?>" class="form-control" id="title" name="title" readonly>
                      <input id="bef_title" type="hidden" value="<?= set_value('title', isset($immovable['title']) ? $immovable['title'] : ''); ?>">
                      <button field="title" class="editImmovableDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>                      
                    </span>
                  </div>
                </div>
                <div class="col-sm-10 col-sm-offset-2"><?php echo form_error('title'); ?></div>
              </div>  

              <div class="col-sm-12"><hr></div>
            
              <div class="row form-add-inmovable">
                <div class="col-sm-2"><label for="street" class="">Calle</label></div>
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <input type="text" value="<?=set_value('street', isset($immovable['street']) ? $immovable['street'] : '')?>" class="form-control " id="street" name="street" readonly>
                      <input id="bef_street" type="hidden" value="<?= set_value('street', isset($immovable['street']) ? $immovable['street'] : '') ?>">
                      <button field="street" class="editImmovableDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>                       
                    </span>
                  </div>
                </div>
                <div class="col-sm-6 col-sm-offset-2"><?php echo form_error('street'); ?></div>
              </div>   

              <div class="row form-add-inmovable">
                <div class="col-sm-4 noPaddingLeft">
                  <div class="col-sm-6"><label for="number_ext" class="">Num. Ext.</label></div>
                  <div class="col-sm-6">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <input type="text" value="<?=set_value('number_ext', isset($immovable['number_ext']) ? $immovable['number_ext'] : '')?>" class="form-control " id="number_ext" name="number_ext" readonly>
                        <input id="bef_number_ext" type="hidden" value="<?= set_value('number_ext', isset($immovable['number_ext']) ? $immovable['number_ext'] : '')?>">
                        <button field="bef_number_ext" class="editImmovableDataBtn btn btn-default" type="button">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-6 col-sm-offset-6"><?php echo form_error('number_ext'); ?></div>
                </div>
                <div class="col-sm-4 noPaddingRight">
                  <div class="col-sm-6"><label for="number_int" class="">Num. Int.</label></div>
                  <div class="col-sm-6">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <input type="text" value="<?= set_value('number_int', isset($immovable['number_int']) ? $immovable['number_int'] : '')?>" class="form-control " id="number_int" name="number_int" readonly>
                        <input id="bef_number_int" type="hidden" value="<?= set_value('number_int', isset($immovable['number_int']) ? $immovable['number_int'] : '')?>">
                        <button field="number_int" class="editImmovableDataBtn btn btn-default" type="button">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-6 col-sm-offset-6"><?php echo form_error('number_int'); ?>  </div>
                </div>
              </div>  

              <div class="row form-add-inmovable ui-widget">
                <div class="col-sm-2"><label>Estado</label></div>
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <input id="bef_states_id" type="hidden" value="<?= set_value('states_id', isset($immovable['states_id']) ? $immovable['states_id'] : '')?>">
                      <select name="states_id" id="states_id" class="form-control" readonly disabled>
                        <option value="-1">Estado</option>
                        <?php foreach ($allstates as $key => $value) { ?>
                          <option value="<?= $value['id']?>" <?= set_select('states_id', $value['id']) ?>><?= $value['name']?></option>
                        <?php } ?>
                      </select>
                      <button field="states_id" class="editImmovableDataBtn btn btn-default" type="button">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>                      
                    </span>
                  </div>
                </div>
                 <div class="col-sm-6 col-sm-offset-2"><?php echo form_error('states_id'); ?>  </div>
              </div>

              <div class="row form-add-inmovable">
                <div class="col-sm-3"><label for="city_id" class="">Delegación / Municipio</label></div>
                <div class="col-sm-5">
                  <div class="input-group">
                      <span class="input-group-btn">
                        <input id="bef_city_id" type="hidden" value="<?= set_value('city_id', isset($immovable['city_id']) ? $immovable['city_id'] : '')?>">
                        <select name="city_id" id="city_id" class="form-control" readonly disabled>
                          <?php foreach ($cities as $key => $value) { ?>
                            <option value="<?= $value['id']?>" <?= set_select('city_id', $value['id']) ?>><?= $value['name']?></option>
                          <?php } ?>                    
                        </select>
                        <input type="hidden" value="<?= set_value('city_id')?>" id="city_selected">
                        <button field="city_id" class="editImmovableDataBtn btn btn-default" type="button">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>                           
                      </span>
                    </div>
                </div>
                <div class="col-sm-5 col-sm-offset-3"><?php echo form_error('city_id'); ?></div>
              </div>  

              <div class="row form-add-inmovable">
                <div class="col-sm-2"><label for="suburbs_id" class="">Colonia</label></div>
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <input id="bef_suburbs_id" type="hidden" value="<?= set_value('suburbs_id')?>">
                      <select name="suburbs_id" id="suburbs_id" class="form-control" readonly disabled>
                        <?php foreach ($suburbs as $key => $value) { ?>
                          <option value="<?= $value['id']?>" <?= set_select('suburbs_id', $value['id']) ?>><?= $value['name']?></option>
                        <?php } ?>                      
                      </select>
                      <input type="hidden" value="<?= set_value('suburbs_id')?>" id="suburb_selected">

                      <button field="suburbs_id" class="editImmovableDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>                        
                    </span>
                  </div>
                </div>
                <div class="col-sm-6 col-sm-offset-2"><?php echo form_error('suburbs_id'); ?></div>
              </div>                                                             

              <div class="row form-add-inmovable">
                <div class="col-sm-2"><label for="town" class="">Ciudad</label></div>
                <div class="col-sm-6">
                 <div class="input-group">
                    <span class="input-group-btn">
                      <input id="bef_town" type="hidden" value="<?= set_value('town', isset($immovable['town']) ? $immovable['town'] : '')?>">
                      <input type="text" value="<?= set_value('town', isset($immovable['town']) ? $immovable['town'] : '')?>" class="form-control " id="town" name="town" readonly>
                      <button field="town" class="editImmovableDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>                      
                    </span>
                  </div>
                </div>
                <div class="col-sm-6 col-sm-offset-2"><?php echo form_error('town'); ?></div>
              </div> 

              <div class="col-sm-12"><hr></div>

              <div class="row form-add-inmovable">
                <div class="col-sm-3"><label for="immovables_type_id" class="">Tipo de inmueble</label></div>
                <div class="col-sm-5">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <input id="bef_immovables_type_id" type="hidden" value="<?= set_value('immovables_type_id')?>">
                      <select disabled name="immovables_type_id" id="immovables_type_id" class="form-control" readonly>
                          <option value="-1">Selecciona un tipo de inmueble</option>
                          <?php foreach ($allimmovablestype as $key => $value) { ?>
                            <option value="<?= $value['id']?>" <?= set_select('immovables_type_id',$value['id'])?>><?= $value['name']?></option>
                          <?php }?>
                      </select>
                      <button field="immovables_type_id" class="editImmovableDataBtn btn btn-default" type="button">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>                        
                    </span>
                  </div>
                </div>
                <div class="col-sm-5 col-sm-offset-3"><?php echo form_error('immovables_type_id'); ?></div>
              </div> 

              <div class="row form-add-inmovable">
                <div class="col-sm-2"><label for="immovables_type_id" class="">Acuerdo comercial</label></div>
                <div class="col-sm-6">
                    <?php foreach ($alltradeagreements as $key => $value) {?>
                      <div class="col-sm-4">
                        <label class="col-sm-6"><?= $value['name']?></label>
                        <input class="col-sm-6" type="checkbox" name="trade_agreements_id" id="trade_agreements_id" value="<?= $value['id']?>" <?= set_checkbox('trade_agreements_id', $value['id'])?>>
                      </div>
                    <?php } ?>
                </div>
                <div class="col-sm-8"><?php echo form_error('trade_agreements_id'); ?></div>
              </div>            

              <div class="row form-add-inmovable">
                <div class="col-sm-4 noPaddingLeft ">
                  <div class="col-sm-4"><label for="price">Precio</label></div>
                  <div class="col-sm-8 ">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <input id="bef_price" type="hidden" value="<?= set_value('price',isset($immovable['price']) ? $immovable['price'] : '')?>">
                        <input name="price" id="price" value="<?= set_value('price',isset($immovable['price']) ? $immovable['price'] : '')?>" type="text" class="form-control" readonly>
                        <button field="price" class="editImmovableDataBtn btn btn-default" type="button">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>                          
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-8 col-sm-offset-4"><?php echo form_error('price'); ?></div>
                </div>
                <div class="col-sm-4">
                  <div class="col-sm-4"><label for="contract_id">Contrato</label></div>
                  <div class="col-sm-8 ">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <input id="bef_contract_id" type="hidden" value="<?= set_value('contract_id')?>">
                          <select disabled name="contract_id" id="contract_id" class="form-control" readonly>
                           <option value="-1">Tipo de contrato</option>
                            <?php foreach ($allcontracts as $key => $value) { ?>
                              <option value="<?= $value['id']?>" <?= set_select('contract_id',$value['id'])?>><?= $value['name']?></option>
                            <?php }?>
                          </select>
                          <button id="contract_id" class="editImmovableDataBtn btn btn-default" type="button">
                            <span class="glyphicon glyphicon-pencil"></span>
                          </button>                                
                        </span>
                    </div>
                  </div>
                  <div class="col-sm-8 col-sm-offset-4 noPaddingRight"><?php echo form_error('contract_id'); ?></div>

                </div>
                <div class="col-sm-4 noPaddingRight">
                  <div class="col-sm-4"><label for="">Moneda</label></div>
                  <div class="col-sm-8 noPaddingRight">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <input id="bef_currency" type="hidden" value="<?= set_value('currency')?>">
                        <select disabled class="form-control" id="currency" name="currency" readonly>
                          <option value="MXN" <?= set_select('currency', 'MXN')?>>MXN</option>
                          <option value="USD" <?= set_select('currency', 'USD')?>>USD</option>
                        </select>
                        <button field="currency" class="editImmovableDataBtn btn btn-default" type="button">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>                           
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-8 col-sm-offset-4 noPaddingRight"><?php echo form_error('money'); ?></div>
                </div>
              </div>

              <div class="row form-add-inmovable">
                <div class="col-sm-4 noPaddingLeft">
                  <div class="col-sm-6 noPaddingRight"><label for="extra_costs">Costos extras</label></div>
                  <div class="col-sm-6 noPaddingRight noPaddingLeft">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <input id="bef_extra_costs" type="hidden" value="<?= set_value('extra_costs')?>">
                        <input type="text" value="<?= set_value('extra_costs') ?>" class="form-control" name="extra_costs" id="extra_costs" readonly>
                        <button field="extra_costs" class="editImmovableDataBtn btn btn-default" type="button">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>                         
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-8 noPaddingRight">
                  <div class="col-sm-2"><label for="concept">Concepto</label></div>
                  <div class="col-sm-10 noPaddingRight">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <input id="bef_concept" type="hidden" value="<?= set_value('concept', isset($immovable['concept']) ? $immovable['concept'] : '')?>">
                        <input type="text" value="<?= set_value('concept', isset($immovable['concept']) ? $immovable['concept'] : '')?>" class="form-control" name="concept" id="concept" readonly>
                        <button field="concept" class="editImmovableDataBtn btn btn-default" type="button">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>  
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-10 col-sm-offset-2 noPaddingRight"><?php echo form_error('concept'); ?></div>                  
                </div>
              </div>

              <div class="col-sm-12"><hr></div>

              <div class="row form-add-inmovable">
                <div class="col-sm-4  noPaddingLeft">
                  <div class="col-sm-6"><label for="bedroom">Recámaras</label></div>
                  <div class="col-sm-6">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <input id="bef_bedroom" type="hidden" value="<?= set_value('bedroom', isset($immovable['bedroom']) ? $immovable['bedroom'] : '')?>">
                        <input type="text" class="form-control" value="<?= set_value('bedroom', isset($immovable['bedroom']) ? $immovable['bedroom'] : '')?>" name="bedroom" id="bedroom" readonly>
                        <button field="bedroom" class="editImmovableDataBtn btn btn-default" type="button">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>                          
                        <div class="col-sm-6 col-sm-offset-6"><?php echo form_error('bedroom'); ?></div>                  
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="col-sm-2"><label for="toilet">Baños</label></div>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <input id="bef_toilet" type="hidden" value="<?= set_value('toilet', isset($immovable['toilet']) ? $immovable['toilet'] : '')?>">
                        <input type="text" class="form-control" value="<?= set_value('toilet', isset($immovable['toilet']) ? $immovable['toilet'] : '')?>" name="toilet" id="toilet" readonly>
                        <button field="toilet" class="editImmovableDataBtn btn btn-default" type="button">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>                          
                        <div class="col-sm-10 col-sm-offset-2"><?php echo form_error('bedroom'); ?></div>                  
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row form-add-inmovable">
                <div class="col-sm-6 noPaddingLeft">
                  <div class="col-sm-3"><label for="parking">Estacionamiento</label></div>
                  <div class="col-sm-9">
                    <div class="col-sm-6">
                      <label class="col-sm-4">Sí</label> 
                      <input class="col-sm-8 parking_op" type="radio" name="parking_op" value="yes" <?= set_checkbox('parking_op','yes')?>>
                    </div>                    
                    <div class="col-sm-6">
                      <label class="col-sm-4">No</label>
                      <input class="col-sm-8 parking_op" type="radio" name="parking_op" value="no" <?= set_checkbox('parking_op','no')?>>
                    </div>  
                    <div class="col-sm-12"><?php echo form_error('parking_op'); ?></div>                  
                  </div>
                </div>
                <div class="col-sm-6" id="parking-cant">
                  <div class="col-sm-2"><label for="parking">Cantidad</label></div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="parking" id="parking">
                    <div class="col-sm-12 noPaddingLeft noPaddingRight"><?php echo form_error('parking'); ?></div>                  
                  </div>
                </div>                
              </div>

              <div class="row form-add-inmovable">
                <div class="col-sm-6 noPaddingLeft">
                  <div class="col-sm-3"><label for="kitchen">Cocina</label></div>
                  <div class="col-sm-9">
                    <div class="col-sm-6">
                      <label class="col-sm-4">Sí</label>
                      <input class="col-sm-8" type="radio" name="kitchen" id="kitchen" value="yes" <?= set_checkbox('kitchen','yes')?>>
                    </div>                    
                    <div class="col-sm-6">
                      <label class="col-sm-4">No</label>
                      <input class="col-sm-8" type="radio" name="kitchen" id="kitchen" value="no" <?= set_checkbox('kitchen','no')?>>
                    </div>                      
                  </div>
                </div>           
              </div>
              
              <div class="row form-add-inmovable">
                <div class="col-sm-8 noPaddingLeft">
                  <div class="col-sm-3"><label for="description">Descripción</label></div>
                  <div class="col-sm-9 noPaddingLeft">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <input id="bef_description" type="hidden" value="<?= set_value('description', isset($immovable['description']) ? $immovable['description'] : '')?>">
                        <textarea class="form-control" name="description" id="description" readonly=""><?= set_value('description', isset($immovable['description']) ? $immovable['description'] : '')?></textarea>
                        <button field="description" class="editImmovableDataBtn btn btn-default" type="button">
                          <span class="glyphicon glyphicon-pencil"></span>
                        </button>                          
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-9 col-sm-offset-3 noPaddingLeft"><?php echo form_error('description'); ?></div>                                    
                </div>
              </div>

              <div class="row form-add-inmovable">
                <div class="col-sm-8 noPaddingLeft">
                  <div class="col-sm-3"><label for="comments">Observaciones</label></div>
                  <div class="col-sm-9 noPaddingLeft">
                    <div class="input-group">
                        <span class="input-group-btn">
                          <input id="bef_comments" type="hidden" value="<?= set_value('comments',isset($immovable['comments']) ? $immovable['comments'] : '')?>">
                          <textarea class="form-control" name="comments" id="comments" readonly><?= set_value('comments',isset($immovable['comments']) ? $immovable['comments'] : '')?></textarea>
                          <button field="comments" class="editImmovableDataBtn btn btn-default" type="button">
                            <span class="glyphicon glyphicon-pencil"></span>
                          </button>                             
                        </span>
                    </div>
                  </div>                  
                </div>
              </div>


              <div class="row form-add-inmovable">
                <div class="col-sm-12 noPaddingLeft noPaddingRight">
                  <div class="col-sm-2"><label for="file">Imágenes</label></div>
                  <div action="<?= base_url()?>administrador/upload_images" class="dropzone col-sm-10">
                    <div class="fallback noPaddingLeft">
                      <input name="file" type="file" multiple />
                    </div>
                    <?php foreach ($images as $key => $value) { ?>
                        <div class="dz-preview dz-processing dz-success dz-complete dz-image-preview">
                          <!-- <input type="hidden" value="<?= $value?>" name="images[]"> -->
                          <div class="dz-image">
                            <img data-dz-thumbnail src="<?=base_url().'public/uploads/thumbs/'.$value ?>" >
                          </div>
                          <a class="dz-remove" data-dz-remove="">Borrar</a>
                        </div>
                      <?php }?>                    
                  </div>
                </div>
              </div>              
              <div class="col-sm-12"><hr></div>
              <div class="row form-add-inmovable">
                <div class="col-sm-12 noPaddingLeft noPaddingRight">
                  <div class="col-sm-2"><label for="comments">Código</label></div>
                  <div class="col-sm-10"><?=$code?></div>
                  <input type="hidden" value="<?= $code ?>" name="code">
                </div>
              </div>

              <div class="row form-add-inmovable text-right">
                <button type="submit" class="btn btn-default">Agregar</button>
              </div>

            </form>

          </div>
        </div> <!--container-->
    </body>
    <?php include("layaouts/footer.php");  ?>
</html>
