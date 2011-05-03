
$(function(){
	//Codigo Jquery
var usuario=function(){
	$.tools.validator.localize("es", {
		'*'			: 'Virheellinen arvo',
		':email'  	: 'Correo electronico no valido',
		':number' 	: 'El campo debe ser numerico',
		':url' 		: 'El campo debe ser una URL',
		'[max]'	 	: 'El campo debe ser mayot a $1',
		'[min]'		: 'El campo debe ser menor a $1',
		'[required]'	: 'Este campo es obligatorio '
	});
	//Registro
	var send=false;
	$("form#registerForm").validator({lang: 'es'}).submit(function(e){
		var form = $(this);
	if (!e.isDefaultPrevented()) {	
			// submit with AJAX
			$.getJSON(server+"users/checkEmail?" + form.serialize(), function(json) {
				if (json === true)  {
					$("form#registerForm").unbind('submit').submit();
					return true;	
				// server-side validation failed. use invalidate() to show errors
				} else {
					form.data("validator").invalidate(json);
					}
				});	
				// prevent default form submission logic
				 e.preventDefault();
			}else{
				return true;
			}
		});
	}();
	
	var subasta = function () {
		var contadores=$(".contador");
		if(contadores.length){//envia solicitud de la subasta al servidor
			$.each(contadores,function(index,val){
				var ultimaOferta=0;
				obtenerUsuarioUltimaOferta($(val),ultimaOferta);
				
			});
			
		}
		$("a.ofertar").click(function(e){
			var link=$(this);
			var ruta=link.attr("href");
			e.preventDefault();
			$.getJSON(ruta,{subasta_id:link.parent().parent().attr("rel")},function(oferta){
				if(oferta){
					$("li[rel='"+subasta_id+"']").children(".ultimo-usuario").html(oferta.User.username);
					$("li[rel='"+subasta_id+"']").children(".precio").html(oferta.Oferta.precio);
					$("li[rel='"+subasta_id+"']").children(".contador").html(oferta.Oferta.cantidad);
				}
			});
		});
		
	}();
	function obtenerUsuarioUltimaOferta($val,ultimaOferta){
		setTimeout(function(){
			subasta_id=$val.parent().attr("rel");
			$.getJSON(server+"ofertas/obtenerUsuarioUltimaOferta",{subasta_id:subasta_id,oferta_id:ultimaOferta},function(oferta){
				if(oferta){
					$("li[rel='"+subasta_id+"']").children(".ultimo-usuario").html(oferta.User.username);
					$("li[rel='"+subasta_id+"']").children(".precio").html(oferta.Oferta.precio);
					$("li[rel='"+subasta_id+"']").children(".contador").html(oferta.Oferta.cantidad);
					ultimaOferta=oferta.Oferta.id;
				}else{
					
				}
				obtenerUsuarioUltimaOferta($val,ultimaOferta)
			});
		},1000);
		
	}
});
