		Object.create=function(o,params){
		var F= function(){};
		F.prototype=o;
		return new F();
		}; 
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
	$.tools.validator.fn("[data-equals]", " $1 diferentes", function(input) {
	var name = input.attr("data-equals"),
		 field = this.getInputs().filter("[id='" + name + "']"); 
	return input.val() == field.val() ? true : [name]; 
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
			var conteos=Object;//VAriable donde se guardanlos conteos regresivos 
			$.each(contadores,function(index,val){
				var ultimaOferta=0;
				var subasta_id=$(val).parent().attr("rel");
				obtenerUsuarioUltimaOferta($(val),ultimaOferta,subasta_id);
				var contador={
					iniciar:function(subasta_id,divOfertar,divContador){
						this.subasta_id=subasta_id;
						this.ofertar=divOfertar;
						this.contador=divContador;
						this.subasta_id=subasta_id;
						this.now = new Date($("[rel='"+subasta_id+"']").children(".hora_servidor").text());
						this.fechaFinal = new Date($("[rel='"+subasta_id+"']").children(".fecha_vencimiento").text());
						this.diferencia=this.fechaFinal-this.now ;
					},
					iniciarContador: function(){
						var that=this;
						var clouser=function(){
							that.days = that.diferencia / 1000 / 60 / 60 / 24;
							that.daysRound = Math.floor(that.days);
							that.hours = that.diferencia / 1000 / 60 / 60 - (24 * that.daysRound);
							that.hoursRound = Math.floor(that.hours);
							that.minutes = that.diferencia / 1000 /60 - (24 * 60 * that.daysRound) - (60 * that.hoursRound);
							that.minutesRound = Math.floor(that.minutes);
							that.seconds = that.diferencia / 1000 - (24 * 60 * 60 * that.daysRound) - (60 * 60 * that.hoursRound) - (60 *that. minutesRound);
							that.secondsRound = Math.round(that.seconds);
							that.sec = (that.secondsRound == 1) ? "seg" : "segs";
							that.min = (that.minutesRound == 1) ? "min " : "mins ";
							that.hr = (that.hoursRound == 1) ? "h " : "hs ";
							that.dy = (that.daysRound == 1) ? "d" : "d "
								if (that.daysRound==0 && that.hoursRound==0 && that.minutesRound==0 && that.secondsRound==0){
							 	that.ofertar.parent().html("<div class='boton'>Vencida</div>");
							 	that.ofertar.text("vencida").removeClass("ofertar").unbind("click").remove();
								}else {								
								that.contador.html(that.daysRound + that.dy + that.hoursRound + that.hr + that.minutesRound + that.min + that.secondsRound + that.sec);
								that.diferencia-=1000;
						         setTimeout(clouser, 1000);
								}
						//};
						};
						clouser();
					
					}
				}
				divOfertar=$("[rel='"+subasta_id+"'] p").children(".ofertar");
				divContador=$("[rel='"+subasta_id+"']").children('.contador');
				conteos[subasta_id]=Object.create(contador);
				conteos[subasta_id].iniciar(subasta_id,divOfertar,divContador);
				conteos[subasta_id].iniciarContador();
			});
			
		}
		$("a.ofertar").click(function(e){
			var link=$(this);
			var ruta=link.attr("href");
			subasta_id=link.parent().parent().attr("rel");
			e.preventDefault();
			if(auth!=undefined && auth!=null){
							jQuery.ajax({
				 url:ruta,
				 type: "GET",
				 cache: false,
				 dataType:"json",
				 data:{subasta_id:subasta_id},
				 success:function(oferta){
					if(oferta.success){
						$("li[rel='"+subasta_id+"']").children(".ultimo-usuario").fadeOut("slow",function(){
							$("#creditos").html(oferta.User.creditos);
							$(this).html("Última oferta "+oferta.User.username);
							$(this).fadeIn();
						});
						$("li[rel='"+subasta_id+"']").children(".precio").fadeOut("slow",function(){
							$(this).html(oferta.Subasta.precio);
							$(this).fadeIn();
						});
					
					}else{
						alert(oferta.mensaje);
					}
				}
			 }); 

			}else{
				$("#register-overlay").overlay().load()
			}
			
		});
		
	}();
	function obtenerUsuarioUltimaOferta($val,ultimaOferta,subasta_id){
		setTimeout(function(){
			jQuery.ajax({
				 url:server+"ofertas/obtenerUsuarioUltimaOferta",
				 type: "GET",
				 cache: false,
				 dataType:"json",
				 data:{subasta_id:subasta_id,oferta_id:ultimaOferta},
				 success:function(oferta){
					if(oferta){					
						$("[rel='"+subasta_id+"']").children(".ultimo-usuario").html("Última oferta: "+oferta.User.username);
						//$(".actualizado").removeClass("actualizado");
						//$("[rel='"+subasta_id+"']").children(".ofertas").prepend("<div class='actualizado'>"+oferta.Oferta.created+"</div>");
						$("[rel='"+subasta_id+"']").children(".precio").html(oferta.Subasta.precio);
						$("[rel='"+subasta_id+"']").children(".ultimo-usuario").wrap("<div class='new' />");
						$("[rel='"+subasta_id+"']").children(".precio").wrap("<div class='new' />");
						setTimeout(function(){
							$("[rel='"+subasta_id+"']").children(".new").children(".ultimo-usuario").unwrap();
							$("[rel='"+subasta_id+"']").children(".new").children(".precio").unwrap();
						},500);
						
						ultimaOferta=oferta.Oferta.id;
					}else{
						
					}
					obtenerUsuarioUltimaOferta($val,ultimaOferta,subasta_id)
				}
			 });
		},1000);		
	}
	


});

//RELOJ

  
var RelojID24 = null  
var RelojEjecutandose24 = false  
  
function DetenerReloj24 (){  
    if(RelojEjecutandose24)  
        clearTimeout(RelojID24)  
    RelojEjecutandose24 = false  
}  
  
function MostrarHora24 () {  
    var ahora = new Date()  
    var horas = ahora.getHours()  
    var minutos = ahora.getMinutes()  
    var segundos = ahora.getSeconds()  
    var ValorHora  
  
    //establece las horas  
    if (horas < 10)  
            ValorHora = "0" + horas  
    else  
        ValorHora = "" + horas  
  
     //establece los minutos  
    if (minutos < 10)  
        ValorHora += ":0" + minutos  
    else  
        ValorHora += ":" + minutos  
  
     //establece los segundos  
    if (segundos < 10)  
        ValorHora += ":0" + segundos  
    else  
        ValorHora += ":" + segundos  
          
   $("#digitos").text(ValorHora);  
     //si se desea tener el reloj en la barra de estado, reemplazar la anterior por esta  
     //window.status = ValorHora  
  
    RelojID24 = setTimeout("MostrarHora24()",1000)  
    RelojEjecutandose24 = true  
}  
  
function IniciarReloj24 () {  
    DetenerReloj24()  
    MostrarHora24()  
}  
  
window.onload = IniciarReloj24;  
if (document.captureEvents) {            //N4 requiere invocar la funcion captureEvents  
    document.captureEvents(Event.LOAD)  
}  
  
