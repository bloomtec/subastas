		Object.create=function(o,params){
		var F= function(){};
		F.prototype=o;
		return new F();
		}; 
$(function(){
	//Codigo Jquery
$(".pausado").click(function(e){
	e.preventDefault();
});
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
	
		var contadores=$(".activo .contador");
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
						this.estado="activa";
					},
					updateDiferencia:function(aumento){
						this.diferencia=parseInt(this.diferencia)+parseInt(aumento*1000);
					},
					iniciarContador: function(){
						var that=this;
						var clouser=function(){
							//that.days = that.diferencia / 1000 / 60 / 60 / 24;
							//that.daysRound = Math.floor(that.days);
							//that.hours = that.diferencia / 1000 / 60 / 60 - (24 * that.daysRound);
							//that.hoursRound = Math.floor(that.hours);
							that.minutes = that.diferencia / 1000 /60 //- (24 * 60 * that.daysRound) - (60 * that.hoursRound);
							that.minutesRound = Math.floor(that.minutes);
							that.seconds = that.diferencia / 1000- (60 *that. minutesRound);
							that.secondsRound = Math.round(that.seconds);
							that.sec = (that.secondsRound == 1) ? "seg" : "segs";
							that.min = (that.minutesRound == 1) ? "min " : "mins ";
						//	that.hr = (that.hoursRound == 1) ? "h " : "hs ";
						//	that.dy = (that.daysRound == 1) ? "d" : "d "
								if ( that.minutesRound<=0 && that.secondsRound<=0){
//CUANDO EL CONTADOR LLEGA A CERO SE DEBE PONER UN LETRERO DE PROCESANDO Y NO DEJAR SUBASTAR
							 	that.ofertar.parent().html("<div class='boton'>Procesando</div>");
							 	that.ofertar.text("Procesando").removeClass("ofertar").unbind("click").remove();
							 	that.estado="procesando";
								}else {								
								that.contador.html(that.minutesRound + that.min + that.secondsRound + that.sec);
								that.diferencia-=1000;
								that.estado="activa";
						         setTimeout(clouser, 1000);
								}
						//};
						};
						clouser();
					
					},
					setProcesing:function(){
						var that=this;
					},
					setVencida:function(){
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
						$("div[rel='"+subasta_id+"']").children(".ultimo-usuario").fadeOut("slow",function(){
						//	alert(oferta.User.creditos);
							$("#creditos").html(oferta.User.creditos);
							//conteos[subasta_id].updateDiferencia(oferta.Subasta.aumento_duracion);
							$(this).html("Última oferta "+oferta.User.username);
							$(this).fadeIn();
						});
						$("div[rel='"+subasta_id+"']").children(".precio").fadeOut("slow",function(){
							$(this).html("$ "+addCommas(oferta.Subasta.precio));
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
		function obtenerUsuarioUltimaOferta($val,ultimaOferta,subasta_id){
//			var time=(new Date()).getTime();
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
					if(ultimaOferta!=0)	{
						if(oferta.Subasta.estados_subasta_id==2){
							conteos[subasta_id].updateDiferencia(oferta.Subasta.aumento_duracion);
						}else{
							conteos[subasta_id].setVencida();	
						}
					}
//AQUI SE DEBE PONER EL CODIGO QUE EVALUA EL ESTADO DE LA SUBASTA						
						
						$("[rel='"+subasta_id+"']").children(".precio").html("$ "+addCommas(oferta.Subasta.precio));
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
	}();

	


});
function addCommas(nStr)
 {
 nStr += '';
 x = nStr.split('.');
 x1 = x[0];
 x2 = x.length > 1 ? '.' + x[1] : '';
 var rgx = /(\d+)(\d{3})/;
 while (rgx.test(x1)) {
 x1 = x1.replace(rgx, '$1' + '.' + '$2');
 }
 return x1 + x2;

 }   
