$(function() {
	/**
	 * menu
	 */
	$('ul.nav').superfish();

	/**
	 * añadir subasta (admin)
	 */

	// iniciar los campos
	//
	if ($("#SubastaValor").val() == "") {
		$("#SubastaValor").val("0");
		$("#SubastaUmbralMinimoCreditos").val("0");
		$("#SubastaEstadoId").val("1");
		$("#SubastaPosicionEnCola").val("-1");
		$("#SubastaDiasEspera").val("0");
	} else {
		//
	}

	// mostrar el campo actualmente seleccionado
	//
	if ($("#SubastaTipoSubastaId option:selected").val() == "1") {
		$("#SubastaValor").parent().show();
		$("#SubastaUmbralMinimoCreditos").parent().hide();
	} else {
		$("#SubastaValor").parent().hide();
		$("#SubastaUmbralMinimoCreditos").parent().show();
	}

	// evento para mostrar el nuevo campo seleccionado
	//
	$("#SubastaTipoSubastaId").change(function() {
		if ($("#SubastaTipoSubastaId option:selected").val() == "1") {
			$("#SubastaValor").parent().show();
			$("#SubastaUmbralMinimoCreditos").parent().hide();
		} else {
			$("#SubastaValor").parent().hide();
			$("#SubastaUmbralMinimoCreditos").parent().show();
		}
	});
	
	// ocultar los campos de posicion en cola y estado si
	// se encuentra en espera
	//
	if ($("#SubastaPosicionEnCola").val() == "-1"){
		$("#SubastaPosicionEnCola").parent().hide();
		$("#SubastaEstadoId").parent().hide();
	} else {
		//
	}

});
