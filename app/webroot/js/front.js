$(function(){
	//Codigo Jquery
var usuario=function(){
	//Registro
	var send=false;
	$("form#registerForm").validator({lang: 'es','position':'center right'}).submit(function(e){
		var form = $(this);
	if (!e.isDefaultPrevented()) {	
			// submit with AJAX
			$.getJSON(server+"users/checkEmail?" + form.serialize(), function(json) {
				if (json === true)  {
					$("form#UserRegisterForm").unbind('submit').submit();
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
});
