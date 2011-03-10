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
		$("#SubastaEstado").val("Esperando Activación");
		$("#SubastaPosicionEnCola").val("-1");
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

});
