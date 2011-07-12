$(function(){
	var contadores=$(".activo .contador");
if(contadores.length) {//envia solicitud de la subasta al servidor
	var conteos=Object;//VAriable donde se guardanlos conteos regresivos
	$.each(contadores, function(index,val) {
		var ultimaOferta=0;
		var subasta_id=$(val).parent().attr("rel");
		obtenerUsuarioUltimaOferta($(val),ultimaOferta,subasta_id);
		var contador= {
			iniciar: function(subasta_id,divOfertar,divContador) {
				this.subasta_id=subasta_id;
				this.ofertar=divOfertar;
				this.contador=divContador;
				this.subasta_id=subasta_id;
				this.now = new Date();
				this.fechaFinal = new Date($("[rel='"+subasta_id+"']").children(".fecha_vencimiento").text());
				this.diferencia=this.fechaFinal-this.now ;
				this.estado="activa";
				this.hayDatos=false;
			},
			update: function(aumento,fechaVenta) {
				this.now=new Date();
				this.fechaFinal = new Date(fechaVenta);
				//console.log(this.fechaFinal);
				this.diferencia=this.fechaFinal - this.now ;
				this.minutes = this.diferencia / 1000 /60;
				this.minutesRound = Math.floor(this.minutes);
				this.seconds = this.diferencia / 1000- (60 *this. minutesRound);
				this.secondsRound = Math.round(this.seconds);
				this.hayDatos=true;
				
				
				//this.diferencia=parseInt(this.diferencia)+parseInt(aumento*900);
			},
			iniciarContador: function() {
				var that=this;
				//that.days = that.diferencia / 1000 / 60 / 60 / 24;
				//that.daysRound = Math.floor(that.days);
				//that.hours = that.diferencia / 1000 / 60 / 60 - (24 * that.daysRound);
				//that.hoursRound = Math.floor(that.hours);
				console.log("inicio el contador");
				that.minutes = that.diferencia / 1000 /60; //- (24 * 60 * that.daysRound) - (60 * that.hoursRound);
				that.minutesRound = Math.floor(that.minutes);
				that.seconds = that.diferencia / 1000- (60 *that. minutesRound);
				that.secondsRound = Math.round(that.seconds);
				that.sec = "segs";
				that.min = "mins";
				that.parent=that.ofertar.parent();
				var clouser= function() {
					//
					//console.time('timerName');
					//	that.hr = (that.hoursRound == 1) ? "h " : "hs ";
					//	that.dy = (that.daysRound == 1) ? "d" : "d "
					if(that.hayDatos==true) {
					document.getElementById("contador"+that.subasta_id).innerHTML= that.minutesRound+that.min+that.secondsRound+that.sec;		
					}

					//that.contador.html(that.minutesRound+that.min+that.secondsRound+that.sec);
					if ( that.minutesRound==0) {
						//CUANDO EL CONTADOR LLEGA A CERO SE DEBE PONER UN LETRERO DE PROCESANDO Y NO DEJAR SUBASTAR
						that.parent.html("<div class='boton'>Procesando</div>");
						that.ofertar.text("Procesando").removeClass("ofertar").unbind("click").remove();
						that.estado="procesando";
					}

					if(that.secondsRound==0) {
						that.secondsRound=60;
						that.minutesRound-=1;
					}
					if(that.estado!="vencida"&&that.estado!="reiniciando") {
						//console.timeEnd('timerName');
						setTimeout(clouser, 1000);
					}
					that.diferencia=that.diferencia-1000;
					that.secondsRound=that.secondsRound-1;

				};
				that.estado="activa";
				clouser();

			},
			setProcesing: function() {
				var that=this;
			},
			setVencida: function() {
				var that=this;
				that.ofertar.parent().html("<div class='boton'>Vencida</div>");
				that.ofertar.text("vencida").removeClass("ofertar").unbind("click").remove();
				that.estado="vencida";
			}
		}
		divOfertar=$("[rel='"+subasta_id+"'] p").children(".ofertar");
		divContador=$("[rel='"+subasta_id+"']").children('.contador');
		conteos[subasta_id]=Object.create(contador);
		conteos[subasta_id].iniciar(subasta_id,divOfertar,divContador);
		conteos[subasta_id].iniciarContador();
	});
}
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
function obtenerUsuarioUltimaOferta($val,ultimaOferta,subasta_id) {
	//			var time=(new Date()).getTime();
	setTimeout( function() {
		jQuery.ajax({
			url:server+"ofertas/obtenerUsuarioUltimaOferta",
			type: "GET",
			cache: false,
			dataType:"json",
			data: {
				subasta_id:subasta_id,
				oferta_id:ultimaOferta
			},
			success: function(oferta) {
				if(oferta.actualizada) {
					$("[rel='"+subasta_id+"']").children(".ultimo-usuario").html("Última oferta: "+oferta.User.username);
					//$(".actualizado").removeClass("actualizado");
					//$("[rel='"+subasta_id+"']").children(".ofertas").prepend("<div class='actualizado'>"+oferta.Oferta.created+"</div>");

					if(oferta.Subasta.estados_subasta_id==2) {
						conteos[subasta_id].update(oferta.Subasta.aumento_duracion,oferta.Subasta.fecha_de_venta);
					} else {
						conteos[subasta_id].setVencida();
					}

					//AQUI SE DEBE PONER EL CODIGO QUE EVALUA EL ESTADO DE LA SUBASTA

					$("[rel='"+subasta_id+"']").children(".precio").html("$ "+addCommas(oferta.Subasta.precio));
					$("[rel='"+subasta_id+"']").children(".ultimo-usuario").wrap("<div class='new' />");
					$("[rel='"+subasta_id+"']").children(".precio").wrap("<div class='new' />");
					setTimeout( function() {
						$("[rel='"+subasta_id+"']").children(".new").children(".ultimo-usuario").unwrap();
						$("[rel='"+subasta_id+"']").children(".new").children(".precio").unwrap();
					},500);
					ultimaOferta=oferta.Oferta.id;
				} else {
					if(oferta.Subasta.estados_subasta_id==3) {
						conteos[subasta_id].setVencida();
					} else {

					}
				}
				if(oferta.Subasta.estados_subasta_id==2) {
					obtenerUsuarioUltimaOferta($val,ultimaOferta,subasta_id);
				}
			}
		});
	},1000);
}
});