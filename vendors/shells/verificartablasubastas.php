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

		//Encontrar las subastas con estado activo
		// y que se encuentren en su 'fecha_de_venta'
		//
		$gmt = 3600*-5; // GMT -5 para hora colombiana
		$fechaActual = gmdate('Y-m-d H:i:s', time() + $gmt); // Generar la fecha actual formateada para comparar con la fecha de mysql
		$subastasActivasParaVender = $this->Subasta->find("all", array('conditions' => array('Subasta.estados_subasta_id' => '2', 'Subasta.fecha_de_venta <=' => $fechaActual)));

		foreach($subastasActivasParaVender as $subastaActivaParaVender){

			// Mostrar la fecha de venta de la subasta
			//
			try {
				$this->out($subastaActivaParaVender['Subasta']['fecha_de_venta']);
			} catch (Exception $e) {
				$this->out($e->getMessage());
			}

			// Verificar que tipo de subasta es (Venta Fija == 1 || Minimo De Creditos == 2)
			//
			if($subastaActivaParaVender['TipoSubasta']['id'] == 1) {
				// Subasta tipo venta fija
				//
			} else {
				// Subasta tipo minimo de creditos
				//
			}
		}

	}

}
?>