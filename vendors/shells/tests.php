<?php
class TestsShell extends Shell {

	var $uses = array('Subasta');

	function main(){

		$this->out("Iniciando prueba cancelar subasta\n");

		// metodo a probar
		//
		$id = 1;
		$resultado = $this->requestAction('/subastas/__cancelarSubasta/'.$id);

		$this->out("Fin de la prueba\n");

	}

}
?>