<?php
class TestsShell extends Shell {

	var $uses = array('Subasta');

	function main(){

		$this->out("Iniciando prueba\n");

		// metodo a probar
		//
		$this->out($this->requestAction('/ofertas/obtenerUsuarioGanadorSubasta/1')."\n");

		$this->out("Fin de la prueba\n");

	}

}
?>