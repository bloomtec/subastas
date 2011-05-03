
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
				iniciarContador($(val));
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
					$("[rel='"+subasta_id+"']").children(".ultimo-usuario").html("Última oferta "+oferta.User.username);
					$(".actualizado").removeClass("actualizado");
					$("[rel='"+subasta_id+"']").children(".ofertas").prepend("<div class='actualizado'>"+oferta.Oferta.created+"</div>");
					$("[rel='"+subasta_id+"']").children(".precio").html(oferta.Oferta.precio);
					
					ultimaOferta=oferta.Oferta.id;
				}else{
					
				}
				obtenerUsuarioUltimaOferta($val,ultimaOferta)
			});
		},1000);
		
	}
function iniciarContador($val){
	var subasta_id=$val.parent().attr("rel");
	var now = new Date($(".hora_servidor").text());
	var fechaFinal = new Date($(".fecha_vencimiento").text());
	diferencia=(fechaFinal - now);
	contador();
	function contador () {
		
		days = diferencia / 1000 / 60 / 60 / 24;
		daysRound = Math.floor(days);
		hours = diferencia / 1000 / 60 / 60 - (24 * daysRound);
		hoursRound = Math.floor(hours);
		minutes = diferencia / 1000 /60 - (24 * 60 * daysRound) - (60 * hoursRound);
		minutesRound = Math.floor(minutes);
		seconds = diferencia / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
		secondsRound = Math.round(seconds);
		sec = (secondsRound == 1) ? "seg" : "segs";
		min = (minutesRound == 1) ? "min " : "mins ";
		hr = (hoursRound == 1) ? "h " : "hs ";
		dy = (daysRound == 1) ? "d" : "d "
			if (daysRound==0 && hoursRound==0 && minutesRound==0 && secondsRound==0)
		 	$("[rel='"+subasta_id+"']").children(".ofertar").text("vencida").removeClass(".ofertar");
			else {
			$("[rel='"+subasta_id+"']").children(".contador").html(daysRound + dy + hoursRound + hr + minutesRound + min + secondsRound + sec);
			diferencia-=1000;
			newtime = window.setTimeout(contador, 1000);
			}
	};
	
}

});
