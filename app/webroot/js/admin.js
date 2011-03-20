$(function() {
	/**
	 * menu
	 */
	$('ul.nav').superfish();

	/**
	 * añadir subasta (admin)
	 */

	// mostrar el campo que corresponde al tipo de subasta
	// actualmente seleccionado
	//
	if ($("#SubastaTipoSubastaId option:selected").val() == "1") {
		$("#SubastaValor").parent().show();
		$("#SubastaUmbralMinimoCreditos").parent().hide();
	} else {
		$("#SubastaValor").parent().hide();
		$("#SubastaUmbralMinimoCreditos").parent().show();
	}

	// evento para mostrar el nuevo campo seleccionado que
	// corresponde al tipo de subasta
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
