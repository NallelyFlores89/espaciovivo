$(document).ready(function(){
	personal_selected();
	terms_selected();
	notifications_selected();

	$("#searchForm").submit(function(e){
		e.preventDefault();
		keys = $("#searchInput").val();
		if(keys == ""){
			data = "keys="+'all';
		}else{
			data = "keys="+keys;
		}
		$.ajax({
		    type: "POST",
		    url : base+"inmueble/search",
		    data : data,
	        success : function(results){
	        	if(results == -1){
	        		$("#immovables-list").html("<h2 class='title'>no resultados</h2>");
	        	}else{
	        		results = JSON.parse(results);
	        		string = "";
					Object.keys(results).forEach(function(item) {
						data = results[item];
						string = string + '<a href="'+base+'inmueble/detalle/'+data.code+'">';
						string += '<div id="'+data.code+'" class="immovables-box row">';
						string += '<div class="col-sm-12"><h4 class="title">'+data.title+' / '+ data.code +'</h4></div>';
						string += '<div class="col-sm-4">';
						string += '<div class="col-sm-12" style="background-image:url('+base+'public/uploads/'+ data.images[0].url +'); height:100px; background-size:cover; background-repeat:no-repeat;"></div>';
						string += '</div>';

						string += '<div class="col-sm-4">';
						string += '<p>'+data.immovables_type+'</p>';
						string += '<p> Col. '+data.suburb+'</p>';
						string += '<p>'+data.street+'</p>';
						string += '</div>';

						string += '<div class="col-sm-4">';
						string += '<p>'+data.bedroom+' Recamaras </p>';

						if(data.parking == 1){
							string += '<p>Estacionamiento</p>';
						}else{
							string += '<p>No Estacionamiento</p>';
						}

						string += '<div class="col-sm-12 text-right">';
						// string += '<a href="'+base+'inmueble/detalle/'+data.code+'"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></a>';
						string += '<a href="'+base+'inmueble/editar/'+data.code+'"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>';
						string += '<button type="button" immovablecode="'+data.code+'" class="delete-immovable-btn btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
						string += '</div>';
						string += '</div>'
						string += '</div>'
						string += '</a>'

					});
					console.log(string);
					$("#immovables-list").html(string);
	        	}
	        }
		},"json");		

	})
	$("#terms").click(function(){
		terms_selected();
	})

	$(".slider_btn_trash").click(function(){
		slide = $(this).attr("idslide");
		console.log(slide);
		data = "id="+slide;
		$.ajax({
			    type: "POST",
			    url : base+"administrador/delete_slide",
			    data : data,
		        success : function(results){
					$("#slide-preview-"+slide).remove();
		        }
		},"json");		
	})

	$("#notifications").click(function(){
		notifications_selected();
	})

	$("#personal_data").click(function(){
		personal_selected();
	})

	$("#add_suburb_btn").click(function(){
		$("#add_suburbs").toggle();
		$("#suburbs_select").toggle();

		if($("#suburbs_select").css('display').toLowerCase() == 'none'){
			$(this).find("span").removeClass("glyphicon-plus-sign").addClass("glyphicon-remove");
			$("#suburbs_select").val(-1);
		}else{
			$(this).find("span").removeClass("glyphicon-remove").addClass("glyphicon-plus-sign");
		}
	})


	$(".editAdminDataBtn, .editImmovableDataBtn").click(function(){
		var field = $(this).attr("field");
		$(this).toggleClass("clicked");
		if($(this).hasClass("clicked")){
			$("#"+field).removeAttr("readOnly").removeAttr("disabled");
			$(this).find("span").removeClass("glyphicon-pencil").addClass("glyphicon-remove");
		}else{
			$("#"+field).attr("readOnly","true").attr("disabled","disabled");
			$("#"+field).val("").val($("#bef_"+field).val());
			$(this).find("span").removeClass("glyphicon-remove").addClass("glyphicon-pencil");
		}

		if($(".editAdminDataBtn").hasClass("clicked")){
			$("#saveAdminDataChange").removeAttr("disabled");
		}else{
			$("#saveAdminDataChange").attr("disabled","true");
		}
	})


	$("#states_id").change(function(){
		bring_cities($(this).val());
	})

	$("#city_id").change(function(){
		bring_suburbs($(this).val());
	})

	$(".parking_op").click(function(){
		parking_op($(this).val());
	})

	$("#addinmovable_form").submit(function(){
		$(".form-control").removeAttr("disabled").removeAttr("readOnly");
	})

	$(".thumbnail-carousel").click(function(e){
		e.preventDefault();
		$("#imgShowed").attr("key", $(this).attr("key")).css('background-image',"url("+base+"public/uploads/"+$(this).attr("img")+")");
		// $("#imgShowed").attr("src",base+"public/uploads/"+$(this).attr("img")).attr("key", $(this).attr("key"));
		// $("#bigImage > a").attr("href",base+"public/uploads/"+$(this).attr("img"));
	})

	$(".searchBySuburb").click(function(){
		data = "suburbs_id="+$(this).attr("idsuburbsearch")+"&trade_agreements_id="+$(this).attr("tradeagreementid")+"&immovables_type_id="+$(this).attr("immovabletypeid");
		console.log(data);
		$.ajax({
		    type: "POST",
		    url : base+"inmueble/searchBySuburb",
		    data : data,
	        success : function(results){
	        	if(results == -1){
	        		$("#immovables-list").html("<h2 class='title'>no resultados</h2>");
	        	}else{
	        		results = JSON.parse(results);
	        		string = "";
					Object.keys(results).forEach(function(item) {
						console.log(results[item]);
						console.log(string);
						data = results[item];
						string = string + '<a href="'+base+'inmueble/detalle/'+data.code+'">';
						string += '<div id="'+data.code+'"class="immovables-box row">';
						string += '<div class="col-sm-12"><h4 class="title">'+data.title+' / '+ data.code +'</h4></div>';
						string += '<div class="col-sm-4">';
						if(data.images[0] != undefined){
							string += '<div class="col-sm-12" style="background-image:url('+base+'public/uploads/thumbs/'+ data.images[0].url +'); height:100px; background-size:cover; background-repeat:no-repeat;"></div>';
						}else{
							string += '<div class="col-sm-12" style="background-image:url('+base+'public/uploads/thumbs/'+ "" +'); height:100px; background-size:cover; background-repeat:no-repeat;"></div>';							
						}
						string += '</div>';

						string += '<div class="col-sm-4">';
						string += '<p>'+data.immovables_type+'</p>';
						string += '<p> Col. '+data.suburb+'</p>';
						string += '<p>'+data.street+'</p>';
						string += '</div>';

						string += '<div class="col-sm-4">';
						string += '<p>'+data.bedroom+' Recamaras </p>';

						if(data.parking == 1){
							string += '<p>Estacionamiento</p>';
						}else{
							string += '<p>No Estacionamiento</p>';
						}

						string += '<div class="col-sm-12 text-right">';
						string += '</div>';
						string += '</div>'
						string += '</div>'
						string += '</a>'

					});
					// console.log(string);
					$("#immovables-list").html(string);
	        	}
	        }
		},"json");				
	
	})

	$(".searchOption").change(function(){
		trade_agreements = $("#trade_agreements").val();
		immovable_types = $("#immovable_types").val();
		states = $("#states").val();
		// cities = $("#cities").val();
		// suburbs = $("#suburbs_select").val();

		// data = "trade_agreements_id="+trade_agreements+"&immovables_type_id="+immovable_types+"&states_id="+states+"&city_id="+cities+"&suburbs_id="+suburbs;
		data = "trade_agreements_id="+trade_agreements+"&immovables_type_id="+immovable_types+"&states_id="+states;
		$.ajax({
			    type: "POST",
			    url : base+"inmueble/search2",
			    data : data,
		        success : function(results){
		        	if(results == -1){
		        		$("#immovables-list").html("<h2 class='title'>no resultados</h2>");
		        	}else{
		        		results = JSON.parse(results);
		        		string = "";
						Object.keys(results).forEach(function(item) {
							console.log(results[item]);
							data = results[item];
							string = string + '<a href="'+base+'inmueble/detalle/'+data.code+'">';
							string += '<div id="'+data.code+'"class="immovables-box row">';
							string += '<div class="col-sm-12"><h4 class="title">'+data.title+' / '+ data.code +'</h4></div>';
							string += '<div class="col-sm-4">';
							if(data.images[0] != undefined){
								string += '<div class="col-sm-12" style="background-image:url('+base+'public/uploads/'+ data.images[0].url +'); height:100px; background-size:cover; background-repeat:no-repeat;"></div>';
							}else{
								string += '<div class="col-sm-12" style="background-image:url('+base+'public/uploads/'+ '' +'); height:100px; background-size:cover; background-repeat:no-repeat;"></div>';
							}

							string += '</div>';

							string += '<div class="col-sm-4">';
							string += '<p>'+data.immovables_type+'</p>';
							string += '<p> Col. '+data.suburb+'</p>';
							string += '<p>'+data.street+'</p>';
							string += '</div>';

							string += '<div class="col-sm-4">';
							string += '<p>'+data.bedroom+' Recamaras </p>';

							if(data.parking == 1){
								string += '<p>Estacionamiento</p>';
							}else{
								string += '<p>No Estacionamiento</p>';
							}

							string += '<div class="col-sm-12 text-right">';
							string += '<a href="'+base+'inmueble/editar/'+data.code+'"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>';
							string += '<button type="button" immovablecode="'+data.code+'" class="delete-immovable-btn btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
							string += '</div>';
							string += '</div>'
							string += '</div>'
							string += '</a>'

						});
						// console.log(string);
						$("#immovables-list").html(string);
		        	}
		        }
			},"json");				
	})

	$("#searchInput").keyup(function(e){
		if(e.keyCode == 32 || $(this).val() == ""){
			keys = $(this).val();
			if(keys == ""){
				data = "keys="+'all';
			}else{
				data = "keys="+keys;
			}
			console.log(data);
			$.ajax({
			    type: "POST",
			    url : base+"inmueble/search",
			    data : data,
		        success : function(results){
		        	if(results == -1){
		        		$("#immovables-list").html("<h2 class='title'>no resultados</h2>");
		        	}else{
		        		results = JSON.parse(results);
		        		string = "";
						Object.keys(results).forEach(function(item) {
							console.log(results[item]);
							data = results[item];
							string = string +'<a href="'+base+'inmueble/detalle/'+data.code+'">';
							string += '<div id="'+data.code+'" class="immovables-box row">';
							string += '<div class="col-sm-12"><h4 class="title">'+data.title+' / '+ data.code +'</h4></div>';
							string += '<div class="col-sm-4">';
							string += '<div class="col-sm-12" style="background-image:url('+base+'public/uploads/'+ data.images[0].url +'); height:100px; background-size:cover; background-repeat:no-repeat;"></div>';
							string += '</div>';

							string += '<div class="col-sm-4">';
							// string += '<p><b>'+data.code+'</b></p>';
							string += '<p>'+data.immovables_type+'</p>';
							string += '<p> Col. '+data.suburb+'</p>';
							string += '<p>'+data.street+'</p>';
							string += '</div>';

							string += '<div class="col-sm-4">';
							string += '<p>'+data.bedroom+' Recamaras </p>';

							if(data.parking == 1){
								string += '<p>Estacionamiento</p>';
							}else{
								string += '<p>No Estacionamiento</p>';
							}

							string += '<div class="col-sm-12 text-right">';
							// string += '<a href="'+base+'inmueble/detalle/'+data.code+'"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></a>';
							string += '<a href="'+base+'inmueble/editar/'+data.code+'"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>';
							string += '<button type="button" immovablecode="'+data.code+'" class="delete-immovable-btn btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
							string += '</div>';
							string += '</div>'
							string += '</div>'
							string += '</a>'

						});
						console.log(string);
						$("#immovables-list").html(string);
		        	}
		        }
			},"json");
		}
	})

	$(".dz-remove-generate").click(function(){
		remove = $(this).attr("photoname");
		data = "name="+remove;
		$.ajax({
			    type: "POST",
			    url : base+"administrador/delete_upload_images",
			    data : data,
		        success : function(results){
					$("div[photoname='"+remove+"']").remove();
		        }
		},"json");
	})

	$("#immovables-list").on("click", ".delete-immovable-btn",function(){
		remove = $(this).attr("immovablecode");
		console.log(remove);
		data = "code="+remove;
		$.ajax({
			    type: "POST",
			    url : base+"administrador/delete_immovable",
			    data : data,
		        success : function(results){
		        	$("#"+remove).remove();
		        }
		},"json");		
	})
})

function personal_selected(){
	if($('#personal_data').is(':checked') ){
		$('input[name="personal_data"]').val(1);
	}else{
		$('input[name="personal_data"]').val(-1);
	}
}

function notifications_selected(){
	if($('#notifications').is(':checked') ){
		$('input[name="notifications"]').val(1);
	}else{
		$('input[name="notifications"]').val(0);
	}
}
function terms_selected(){
	if($('#terms').is(':checked') ){
		$('input[name="terms"]').val(1);
	}else{
		$('input[name="terms"]').val(-1);
	}
}
function parking_op(value){
	if(value == "1"){
		$("#parking-cant").show();
	}else{
		$("#parking-cant").hide();
		$("#parking").val(0);
	}
}
function bring_suburbs(city_id){
	data = "city_id="+city_id;
	console.log(data);
    suburb_selected = $("#suburb_selected").val();
    console.log(suburb_selected);
    if(!isNaN(suburb_selected)){
    	suburb_selected = $("#new_suburb_id").val();
    }else{
    	console.log("chle");
    }
    console.log(suburb_selected);
	$.ajax({
    type: "POST",
    url : base+"administrador/bringme_suburbs",
    data : data,
        success : function(suburbs){
        	suburbs_options = "";
        	suburbs = JSON.parse(suburbs);
		    for(var i=0;i<suburbs.length;i++){
		    	if(suburbs[i].id == suburb_selected){
		    		suburbs_options = suburbs_options + "<option value='"+suburbs[i].id+"' selected>"+suburbs[i].name+"</option>";
		    		console.log("ya");
		    	}else{
		    		suburbs_options = suburbs_options + "<option value='"+suburbs[i].id+"'>"+suburbs[i].name+"</option>";
		    	}
		    }
		    $("#suburbs_id").html("<pre>"+suburbs_options+"</pre>");
        }
	},"json");	
}

function bring_cities(state_id){
	if(state_id == -1){

	}else{
		data = "state_id="+state_id;
		$.ajax({
	    type: "POST",
	    url : base+"administrador/bringme_cities",
	    data : data,
	        success : function(cities){
	        	city_selected = $("#city_selected").val();
	        	city_options = "";
	        	cities = JSON.parse(cities);
			    for(var i=0;i<cities.length;i++){
			    	if(cities[i].id == city_selected){
						city_options = city_options + "<option value='"+cities[i].id+"' selected>"+cities[i].name+"</option>";
			    	}else{
			    		city_options = city_options + "<option value='"+cities[i].id+"'>"+cities[i].name+"</option>";
			    	}
			    }
			    $("#city_id").html(city_options);
				bring_suburbs(cities[0].id);
	        }
		},"json");	
	}
}

function check_favorite(immovable_id){
	data = "id="+immovable_id;
	$.ajax({
	    type: "POST",
	    url : base+"inmueble/check_favorite",
	    data : data,
        success : function(response){
        	if(response == -1){
        		alert("Necesitas iniciar sesión");
        	}else{
        		if(response == 1){
        			$("#favorite-icon").removeClass('glyphicon-star-empty').addClass('glyphicon-star');
        			$("#tag-favorite").html("Favorito");
        		}else{
        			if(response == 0){
	        			$("#favorite-icon").addClass('glyphicon-star-empty').removeClass('glyphicon-star');
	        			$("#tag-favorite").html("Marcar como favorito");
        			}
        		}
        	}
        }
	},"json");	
}

function delete_favorite(immovable_id){
	data = "id="+immovable_id;
	$.ajax({
	    type: "POST",
	    url : base+"inmueble/delete_favorite",
	    data : data,
        success : function(response){
        	$("#user_favorite_"+immovable_id).remove();
        }
	},"json");
}