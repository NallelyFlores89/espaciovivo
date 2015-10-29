<!doctype html>
<html>
    <title>Espacio Vivo - Administrador - Panel</title>
    <?php include("layaouts/header.php");  ?>
    <link rel="stylesheet" href="<?= base_url()?>public/css/cropbox.css" type="text/css" />
    <script src="<?= base_url()?>public/lib/cropbox/cropbox.js"></script>
    <script>
      var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        imgaux = "url:('"+URL.createObjectURL(event.target.files[0])+"');";        
      };
    </script>
    <body>
        <div class="container">
          <?= $navbar ?> 
          <form id="editSliderForm" action="<?=base_url()?>administrador/new_slider_submit" class="grayForm col-sm-12 noPadding" method="post" enctype="multipart/form-data">

            <label>Sube una imagen y recortala para poder agregar un nuevo slider.</label> <br>
            <input type="file" class="btn btn-default col-sm-6" id="file" name="photo" ><br><br>
            <div class="imageBox col-sm-12">
                <div class="thumbBox"></div>
                <div class="spinner" style="display: none">No foto</div>
            </div>
            <div class="action col-sm-12"><br><br>
                <button type="button" class="btn btn-default col-sm-1 btn-lg"  id="btnCrop" title="Recortar imagen">
                    <span class="glyphicon glyphicon-ok-sign"  aria-hidden="true"></span>
                </button>
                <button type="button" class="btn btn-default col-sm-1 btn-lg"  id="btnZoomIn" title="Acercar">
                    <span class="glyphicon glyphicon-plus-sign"  aria-hidden="true"></span>
                </button>
                <button type="button" class="btn btn-default col-sm-1 btn-lg"  id="btnZoomOut" title="Alejar">
                    <span class="glyphicon glyphicon-minus-sign"  aria-hidden="true"></span>
                </button>               
            </div>
            <div class="cropped"></div>
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
            <div class="col-sm-12"><input type="hidden" id="url" name="url" value="<?=set_value('url', isset($sliders['url']) ? $sliders['url'] : '')?>"></div>
            <div class="col-sm-12"><?php echo form_error('url'); ?></div>


            <div class="col-sm-12 form-add-inmovable text-right">
              <button id="saveSlider" type="submit" class="btn btn-default">Guardar slider</button>
            </div>   
          </form>                   
        </div> <!--container-->

      
    </body>
<script type="text/javascript">
    $(window).load(function() {
        // $("#saveSlider").hide();
        var options =
        {
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            // imgSrc: '<?= base_url() ?>' + 'public/images/avatar.png'
        }
        var cropper = $('.imageBox').cropbox(options);
        $('#file').on('change', function(){
            var reader = new FileReader();
            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = $('.imageBox').cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
            this.files = [];
        })
        $('#btnCrop').on('click', function(){
            var img = cropper.getDataURL();
            $.ajax({
                type: "POST",
                url : base+"administrador/decodeimagebase64/",
                data : 'img='+img,
                success : function(results){
                    console.log(results);
                    if(results != -1){
                        $(".imageBox, .action").hide();
                        $("#url").val(results);
                        $("#saveSlider").show();
                    }
                }
            },"json");  
            $('.cropped').html('<a download href="'+img+'">'+'<img src="'+img+'"></a>');

        })
        $('#btnZoomIn').on('click', function(){
            cropper.zoomIn();
        })
        $('#btnZoomOut').on('click', function(){
            cropper.zoomOut();
        })
    });
</script>    
    <?php include("layaouts/footer.php");  ?>
</html>
