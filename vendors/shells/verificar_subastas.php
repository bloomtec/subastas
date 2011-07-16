<?php
/**
 *
 * Evalua todas las subastas que tenga estado="activo".
 *
 * Si una subasta está en el dia de venta y es de tipo "venta_fija"
 * invoca el metodo actualizarEstado le pasa como parametro "en_espera_de_pago"
 *
 * Si una subasta está en el dia de venta y es de tipo "minimo_creditos"
 * y se alcanzó el umbral minimo de creditos, invoca el metodo actualizarEstado
 * le pasa como parametro "en_espera_de_pago"
 *
 * Si una subasta está en el dia de venta y es de tipo "minimo_creditos"
 * y NO se alcanzó el umbral minimo de creditos invoca el metodo actualizarEstado
 * le pasa como parametro "vencida".
 *
 * @author Julio César Domínguez Giraldo
 *
 */
class VerificarSubastasShell extends Shell {

	var $uses = array('Subasta');

	private function now() {
		// Generar la fecha actual formateada para comparar con la fecha de mysql
		// GMT -5 para hora colombiana
		//
		return gmdate('Y-m-d H:i:s', time() + (3600 * -5) - 1);
	}
	
	public function main(){
		$this->out('Iniciando CRON para verificar la tabla de subastas');

		// Encontrar las subastas con estado activo
		// y que se encuentren en su 'fecha_de_venta'
		//
		$this->out("\nHora actual del sistema: " . $this->now() . "\n");

		$subastasActivasParaVender = $this->Subasta->find("all",
										array('conditions' => array('Subasta.estados_subasta_id' => '2',
																	'Subasta.fecha_de_venta <=' => $this->now())));

		foreach($subastasActivasParaVender as $subastaActivaParaVender){

			$this->out("\n------------------------------------------------------------------------------\n");
			$this->out("Verificando la subasta " . $subastaActivaParaVender['Subasta']['nombre']." que se encuentra con estado 'Activa' y su fecha de venta ha sido alcanzada");

			// Mostrar la fecha de venta de la subasta
			//
			$this->out("Fecha de venta para la subasta " . $subastaActivaParaVender['Subasta']['fecha_de_venta']);
			
			// Verificar que se hayan hecho ofertas por la subasta
			//
			$ofertasRealizadas = $this->requestAction('/ofertas/getOfertas/' . $subastaActivaParaVender['Subasta']['id']);
			
			if(empty($ofertasRealizadas)) {
				// En este caso cancelar la subasta
				// Actualizar el estado de la subasta a cancelado
				//
				$this->requestAction('/subastas/actualizarEstadoSubasta/' . $subastaActivaParaVender['Subasta']['id'] . '/5');
			} else {
				// Revisar el total de creditos descontados
				//
				$totalCreditosDescontados = $this->requestAction('/ofertas/obtenerTotalCreditosDescontados/' . $subastaActivaParaVender['Subasta']['id']);
	
				// Segun el cambio toca verificar que $totalCreditosDescontados >= $minimoDeCreditos
				// si no se alcanza dicho minimo se cancela la subasta
				//
				$minimoDeCreditos = $subastaActivaParaVender['Subasta']['umbral_minimo_creditos'];
					
				// Validar la condicion ya mencionada
				//
				if ($totalCreditosDescontados < $minimoDeCreditos) {
					// En este caso cancelar la subasta
					// Actualizar el estado de la subasta a cancelado
					//
					$this->requestAction('/subastas/actualizarEstadoSubasta/' . $subastaActivaParaVender['Subasta']['id'] . '/5');
				} else {
					// En este caso se pone la subasta en espera de pago
					//
					$this->requestAction('/subastas/actualizarEstadoSubasta/' . $subastaActivaParaVender['Subasta']['id'] . '/3');
				}	
			}				

			$this->out("\n------------------------------------------------------------------------------\n");
		}

		$this->out("Sincronizar los puestos");
		$this->requestAction('/subastas/sync');

	} // END main()
}
?>