$( function() {
	//Codigo Jquery
	
	$(".pausado").click( function(e) {
		e.preventDefault();
	});
	var usuario= function() {
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
		$("form#registerForm").validator({
			lang: 'es'
		}).submit( function(e) {
			var form = $(this);
			if (!e.isDefaultPrevented()) {
				// submit with AJAX
				$.getJSON(server+"users/checkEmail?" + form.serialize(), function(json) {
					if (json === true) {
						$("form#registerForm").unbind('submit').submit();
						return true;
						// server-side validation failed. use invalidate() to show errors
					} else {
						form.data("validator").invalidate(json);
					}
				});
				// prevent default form submission logic
				e.preventDefault();
			} else {
				return true;
			}
		});
	}();
});
function addCommas(nStr) {
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
function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}