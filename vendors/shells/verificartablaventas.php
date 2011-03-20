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
		// al fin que estado toca revisar?
		//
		debug("Entro al shell!");
	}
	 
}
?>