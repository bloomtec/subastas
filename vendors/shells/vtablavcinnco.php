<?php
/**
 * Evalua todas las ventas que estan en estado pendiente_de_pago, si ya han
 * pasado los dias de espera (campo dias_espera tabla subastas) la venta pasa
 * a estado no_pagada y envia correo a los webmasters del sitio.
 *
 * @author Julio César Domínguez Giraldo
 */
class VtablavcinncoShell extends Shell {

	var $uses = array('Venta');

	function main(){

		$this->out("\nInicio del CRON para verificar la tabla de ventas\n");

		// Encontrar las ventas con estado pendiente de pago
		// y que se hayan pasado los dias de espera en la 'fecha_de_venta'
		//
		$ventasPendientesDePago = $this->Venta->find("all", array('conditions' => array('Venta.estados_venta_id' => '1')));

		foreach ($ventasPendientesDePago as $ventaPendienteDePago) {
			$fechaCreacionVenta = $this->requestAction('/ventas/fechaCreacionVenta/' . $ventaPendienteDePago['Venta']['id']);
			$diasEspera = $this->requestAction('/subastas/diasEspera/' . $ventaPendienteDePago['Venta']['subasta_id']);
			
			$this->out("Fecha de creacion de la venta\t: " . $fechaCreacionVenta);
			$this->out("Dias de espera para la venta\t: " . $diasEspera);

			$date1 = new DateTime($fechaCreacionVenta);
			$date1->add(new DateInterval('P' . $diasEspera . 'D'));

			$fechaVencimientoVenta = $date1->format('Y-m-d H:i:s');

			$this->out("Fecha de vencimiento de la venta: " . $fechaVencimientoVenta);

			$gmt = 3600*-5; // GMT -5 para hora colombiana
			$date2 = new DateTime(gmdate('Y-m-d H:i:s', time() + $gmt)); // Generar la fecha actual formateada para comparar con la fecha de mysql
			$fechaActual = $date2->format('Y-m-d H:i:s');
			
			$this->out("Fecha actual del sistema\t: " . $fechaActual);
				
			if ($date1 > $date2) {
				$this->out("NO VENCIDA");
			} else {
				$this->out("VENCIDA");
				$this->requestAction('ventas/noPagada/' . $ventaPendienteDePago['Venta']['id']);
			}
				
		}

		$this->out("\nFin del CRON para verificar la tabla de ventas\n");

	}

}
?>