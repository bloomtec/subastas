<?php
class TestsShell extends Shell {

	var $uses = array('Subasta', 'Venta');

	function main(){

		$this->out("Iniciando prueba\n");

		// metodo a probar
		//
		$gmt = 3600*-5; // GMT -5 para hora colombiana
		$fechaActual = gmdate('Y-m-d H:i:s', time() + $gmt); // Generar la fecha actual formateada para comparar con la fecha de mysql
		$this->out('Hora actual del sistema: '.$fechaActual);
		$diasEspera = 5;
		
		$this->out('Fecha de vencimiento: '.$fechaVencimiento);
		$this->out("Fin de la prueba\n");

	}

}
?>