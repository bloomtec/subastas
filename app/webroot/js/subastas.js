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
    });
	$("a.ofertar").click( function(e) {
	var link=$(this);
	var ruta=link.attr("href");
	subasta_id=link.parent().parent().attr("rel");
	e.preventDefault();
	if(auth!=undefined && auth!=null) {
		jQuery.ajax({
			url:ruta,
			type: "GET",
			cache: false,
			dataType:"json",
			data: {
				subasta_id:subasta_id
			},
			success: function(oferta) {
				if(oferta.success) {
					$("div[rel='"+subasta_id+"']").children(".ultimo-usuario").fadeOut("slow", function() {
						//	alert(oferta.User.creditos);
						$("#creditos").html(oferta.User.creditos);
						//conteos[subasta_id].updateDiferencia(oferta.Subasta.aumento_duracion);
						$(this).html("Última oferta "+oferta.User.username);
						$(this).fadeIn();
					});
					$("div[rel='"+subasta_id+"']").children(".precio").fadeOut("slow", function() {
						$(this).html("$ "+addCommas(oferta.Subasta.precio));
						$(this).fadeIn();
					});
				} else {
					alert(oferta.mensaje);
				}
			}
		});

	} else {
		$("#register-overlay").overlay().load()
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
					arregloSubastas[subasta.Subasta.id]["contador"].html(subasta.Subasta.contador_string);
					arregloSubastas[subasta.Subasta.id]["precio"].html(subasta.Subasta.precio);
					if(subasta.Oferta.length){//si hay nueva oferta
							arregloSubastas[subasta.Subasta.id]["usuario"].fadeOut("fast", function() {
								$(this).html("$ "+addCommas(subasta.Subasta.precio));
								$(this).fadeIn();
							});
					}
					if(subasta.Subasta.contador_string==="00:00:00"){
						arregloSubastas[subasta.Subasta.id]["boton"].html("Procesando");
					}
					if(subasta.Subasta.estados_subasta_id==3){
							arregloSubastas[subasta.Subasta.id]["boton"].removeClass("ofertar").unbind("click").html("Vencida");
					}
					//console.log(subasta.Subasta.id);
				});
			//arregloSubastas[subastas[0].Subasta.id]["contador"].html(subastas[0].Subasta.contador_string);
			}
		});
	},1000);
});