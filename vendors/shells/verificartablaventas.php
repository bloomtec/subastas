<?php
/**
 *
 * Evalua todas las ventas que estan en estado pendiente_de_pago, si ya han
 * pasado los dias de espera (campo dias_espera tabla subastas) la venta pasa
 * a estado no_pagada y envia correo a los webmasters del sitio.
 *
 * @author Julio César Domínguez Giraldo
 *
 */
class VerificarTablaVentasShell extends Shell {

	var $uses = array('Venta');

	function main(){
		$this->out('Iniciando CRON para verificar la tabla de ventas');

		//Encontrar las ventas con estado pendiente de pago
		// y que se hayan pasado los dias de espera en la 'fecha_de_venta'
		//
		$ventasPendientesDePago = $this->find("all", array('conditions' => array('Venta.estados_venta_id' => '1', )));
		foreach ($ventasPendientesDePago as $ventaPendienteDePago) {
			$this->requestAction('/ventas/verificarFechaVencimiento/'.$ventaPendienteDePago['Venta']['id']);
		}
	}

}
?>