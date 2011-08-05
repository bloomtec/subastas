$(function(){
	var subastas=new Array();
	var arregloSubastas=new Array();
	var indice=0;
	$(".subastas-activas li").each(function(){
		var subastaId=$(this).attr("id");
		var subastaTitle=$(this).attr("title");
		subastas[indice++]=subastaId;
         // collect the id for post data
         // auctions = auctions + auctionId + '=' + auctionTitle + '&';
         // collect the object
		arregloSubastas[subastaId]=$("#"+subastaId);
		arregloSubastas[subastaId]['contador']=$("#"+subastaId+" .contador");
		arregloSubastas[subastaId]['precio']=$("#"+subastaId+" .precio"); 
        arregloSubastas[subastaId]['usuario']=$("#"+subastaId+" .ultimo-usuario");  
		arregloSubastas[subastaId]['boton']=$("#"+subastaId+" .boton");
		arregloSubastas[subastaId]['ultimaOferta']=arregloSubastas[subastaId]['usuario'].attr("rel");
    });
	$("a.ofertar").click( function(e) {
	var link=$(this);
	var ruta=link.attr("href")+"?ms="+new Date().getTime();
	var subastaId=link.parent().parent().attr("rel");
	e.preventDefault();
	if(auth!=undefined && auth!=null) {
		jQuery.ajax({
			url:ruta,
			type: "GET",
			cache: false,
			dataType:"json",
			data: {
				subasta_id:subastaId
			},
			success: function(oferta) {
			console.log(oferta);
				if(oferta.success) {
				$("#creditos").html(oferta.User.creditos);
				$("#bonos").html(oferta.User.bonos);
				} else {
					alert(oferta.mensaje);
				}
			}
		});

	} else {
		$(".formulario-login-subasta").hide();
		$(".formulario-login-subasta").filter("[rel='"+$(this).attr("rel")+"']").show();
	}

	});
	$(".ajax-form").submit(function(e){
		e.preventDefault();
		var url = $(this).attr('action');  
		var datos=$(this).serialize();
				jQuery.ajax({
			url:url,
			type: "post",
			cache: false,
			dataType:"json",
			data: datos,
			success: function(oferta) {
				if(oferta){
				location.reload(true);
				}else{
				//DATOS NO VALIDOS
				}
			}
		});
	});
	$(".cerrar-formulario").click(function(){
		$(this).parent().hide();
	});
	setInterval(function(){
		jQuery.ajax({
			url:server+"subastas/getStatus?ms="+new Date().getTime(),
			type: "POST",
			cache: false,
			dataType:"json",
			data:{subastas:subastas,id:'sss'},
			success: function(subastas) {
			console.log(subastas);
				$.each(subastas,function(i,subasta){
				console.log(subasta.Subasta.faltante_timestamp);
				
					if(subasta.Subasta.contador_string=="::"){
						arregloSubastas[subasta.Subasta.id]["contador"].html("--:--:--");
					}else{
						arregloSubastas[subasta.Subasta.id]["contador"].html(subasta.Subasta.contador_string);
					}
					//arregloSubastas[subasta.Subasta.id]["precio"].html("$ "+addCommas(subasta.Subasta.precio));
					if(subasta.Subasta.contador_string==="00:00:00"){
					arregloSubastas[subasta.Subasta.id]["contador"].html("--:--:--");
						arregloSubastas[subasta.Subasta.id]["boton"].unbind("click").bind("click",function(e){e.preventDefault();}).html("Procesando");
					}
					if(subasta.Subasta.estados_subasta_id==3||(arregloSubastas[subasta.Subasta.id]["boton"].html()=="Procesando")&&subasta.Subasta.faltante_timestamp<-3){
							arregloSubastas[subasta.Subasta.id]["boton"].removeClass("ofertar").unbind("click").bind("click",function(e){e.preventDefault();}).html("Terminada");
					}
					if(subasta.Subasta.estados_subasta_id==4){
							arregloSubastas[subasta.Subasta.id]["boton"].removeClass("ofertar").unbind("click").bind("click",function(e){e.preventDefault();}).html("Vencida");
					}
					if(subasta.Subasta.estados_subasta_id==5){
							arregloSubastas[subasta.Subasta.id]["boton"].removeClass("ofertar").unbind("click").bind("click",function(e){e.preventDefault();}).html("Cancelada");
					}
					if(subasta.Oferta.length){					
						if(subasta.Oferta[0].id!=arregloSubastas[subasta.Subasta.id]["ultimaOferta"]){
							arregloSubastas[subasta.Subasta.id]["ultimaOferta"]=subasta.Oferta[0].id;
							arregloSubastas[subasta.Subasta.id]["precio"].fadeOut("fast",function(){
								$(this).html("$ "+addCommas(subasta.Subasta.precio));
								$(this).fadeIn();
							});
							arregloSubastas[subasta.Subasta.id]["usuario"].fadeOut("fast",function(){
								$(this).html("Última oferta "+subasta.Oferta[0].User.username);
								$(this).fadeIn();
							});
							if(arregloSubastas[subasta.Subasta.id]["boton"].html()=="Procesando"){
							arregloSubastas[subasta.Subasta.id]["boton"].bind("click", function(e) {
											var link=$(this);
											var ruta=link.attr("href")+"?ms="+new Date().getTime();
											var subastaId=link.parent().parent().attr("rel");
											e.preventDefault();
											if(auth!=undefined && auth!=null) {
												jQuery.ajax({
													url:ruta,
													type: "GET",
													cache: false,
													dataType:"json",
													data: {
														subasta_id:subastaId
													},
													success: function(oferta) {
													console.log(oferta);
														if(oferta.success) {
														$("#creditos").html(oferta.User.creditos);
														} else {
															alert(oferta.mensaje);
														}
													}
												});

											} else {
												$("#login-overlay").overlay().load()
											}

										}).html("¡Oferte ya!");
										}
						}
					}
					//console.log(subasta.Subasta.id);
				});
			//arregloSubastas[subastas[0].Subasta.id]["contador"].html(subastas[0].Subasta.contador_string);
			}
		});
	},1000);
});