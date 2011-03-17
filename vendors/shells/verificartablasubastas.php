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
class VerificarTablaSubastasShell extends Shell {

	var $uses = array('Subasta');

	function main(){

		$this->out('Iniciando CRON para verificar la tabla de subastas');

		//Encontrar las subastas con estado activo
		// y que se encuentren en su 'fecha_de_venta'
		//
		$gmt = 3600*-5; // GMT -5 para hora colombiana
		$fechaActual = gmdate('Y-m-d H:i:s', time() + $gmt); // Generar la fecha actual formateada para comparar con la fecha de mysql
		$this->out('Hora actual del sistema: '.$fechaActual);
		$subastasActivasParaVender = $this->Subasta->find("all", array('conditions' => array('Subasta.estados_subasta_id' => '2', 'Subasta.fecha_de_venta <=' => $fechaActual)));

		foreach($subastasActivasParaVender as $subastaActivaParaVender){

			$this->out('------------------------------------------------------------------------------');
			$this->out('Verificando la subasta '.$subastaActivaParaVender['Subasta']['nombre'].' que se encuentra con estado "Activa" y su fecha de venta ha sido alcanzada');

			// Mostrar la fecha de venta de la subasta
			//
			$this->out('Fecha de venta para la subasta '.$subastaActivaParaVender['Subasta']['fecha_de_venta']);

			// Mostrar el tipo de venta para la subasta
			//
			$this->out('La subasta es de tipo: '.$subastaActivaParaVender['TipoSubasta']['nombre']);

			// Revisar el total de creditos descontados
			//
			$totalCreditosDescontados = 0;
			foreach($subastaActivaParaVender['Oferta'] as $oferta){
				$totalCreditosDescontados += $oferta['Oferta']['creditos_descontados'];
			}
			$this->out('Se descontaron un total de: '.$totalCreditosDescontados.' creditos');

			// Verificar que tipo de subasta es (Venta Fija == 1 || Minimo De Creditos == 2)
			//
			if($subastaActivaParaVender['TipoSubasta']['id'] == 1) {
				// Subasta tipo venta fija
				// Si una subasta está en el dia de venta y es de tipo "venta_fija"
				// invoca el metodo actualizarEstado le pasa como parametro "en_espera_de_pago"
				//
				$this->__actualizarEstado($subastaActivaParaVender, 3);
			} else {
				// Subasta tipo minimo de creditos
				//
				if($subastaActivaParaVender['Subasta']['umbral_minimo_creditos'] <= $totalCreditosDescontados){
					// Se alcanzó el umbral minimo de creditos, invocar el metodo actualizarEstado
					// y pasar como parametro "en_espera_de_pago"
					//
					$this->out('Se alcanzo el umbral minimo de creditos para la subasta ('.$subastaActivaParaVender['Subasta']['umbral_minimo_creditos'].' creditos)');
					$this->__actualizarEstado($subastaActivaParaVender, 3);
				} else {
					// NO se alcanzó el umbral minimo de creditos. Invocar el metodo actualizarEstado
					// y pasar como parametro "vencida".
					//
					$this->out('No se alcanzo el umbral minimo de creditos para la subasta ('.$subastaActivaParaVender['Subasta']['umbral_minimo_creditos'].' creditos)');
					$this->__actualizarEstado($subastaActivaParaVender, 4);
				}

			}

			$this->out('------------------------------------------------------------------------------');

		}

	}

	function __actualizarEstado($unaSubasta = null, $nuevoEstadoID = null) {
		//Cambiar el estado de la subasta al nuevo estado
		//
		$this->Subasta->id=$unaSubasta['Subasta']['id'];
		return $this->Subasta->saveField('estados_subasta_id', $nuevoEstadoID);
	}

}
?>