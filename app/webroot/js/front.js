$(function(){
	//Codigo Jquery
	var usuario = function(){
		//Registro
		var send=false;
		$("form#registerForm").validator({lang: 'es','position':'center right'}).submit(function(e){
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
		$(".boton-carrito").click(function(e){
			var productTalla=$("ul.cuadros-colores li.selected").attr("rel").split("-");
			var productID=productTalla[0];
			var colorID=productTalla[1];
			var tallaID=$("ul.cuadros-tallas li.selected").attr("rel");
			$.post(server+"carts/ajaxAdd",{product_id:productID,color_id:colorID,talla_id:tallaID},function(data){
				if(data){
					$(".add-cart").fadeIn().delay(1000).fadeOut();
					$("#cesta").load(server+"/carts/cesta");
				}else{
					
				}
			});
			e.preventDefault()
		});
	}();
});
