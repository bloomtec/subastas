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
				} else {
					alert(oferta.mensaje);
				}
			}
		});

	} else {
		$("#login-overlay").overlay().load()
	}

});
	setInterval(function(){
		jQuery.ajax({
			url:server+"subastas/getStatus?ms="+new Date().getTime(),
			type: "POST",
			cache: false,
			dataType:"json",
			data:{subastas:subastas,id:'sss'},
			success: function(subastas) {
				$.each(subastas,function(i,subasta){
				console.log(subasta.Subasta.faltante_timestamp);
				
					arregloSubastas[subasta.Subasta.id]["contador"].html(subasta.Subasta.contador_string);
					//arregloSubastas[subasta.Subasta.id]["precio"].html("$ "+addCommas(subasta.Subasta.precio));
					if(subasta.Subasta.contador_string==="00:00:00"){
						arregloSubastas[subasta.Subasta.id]["boton"].html("Procesando");
					}
					if(subasta.Subasta.estados_subasta_id==3){
							arregloSubastas[subasta.Subasta.id]["boton"].removeClass("ofertar").unbind("click").html("Vencida");
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
							arregloSubastas[subasta.Subasta.id]["boton"].html("¡Oferte ya!");
						}
					}
					//console.log(subasta.Subasta.id);
				});
			//arregloSubastas[subastas[0].Subasta.id]["contador"].html(subastas[0].Subasta.contador_string);
			}
		});
	},1000);
});