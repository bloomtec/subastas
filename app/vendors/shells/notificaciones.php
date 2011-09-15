<?php
/**
 *
 * CRON para enviar las notificaciones de las 8 am y las 8 pm.
 *
 * @author Julio César Domínguez Giraldo
 *
 */
class NotificacionesShell extends Shell {
	
	var $uses = array('ListaCorreo', 'Subasta', 'Config');

	function main(){
		// Obtener el tamaño de la cola
		//
		$tamaño_cola = $this->Config->find('first', array('fields' => array('tamano_cola')));
		$tamaño_cola = $tamaño_cola['Config']['tamano_cola'];
		
		// Obtener las subastas activas
		//
		$subastas_activas = $this->Subasta->find("all", array('conditions' => array('Subasta.estados_subasta_id' => '2'), 'order' => array('Subasta.posicion_en_cola')));
		
		$mensaje = "El estado actual de las subastas activas en cola es:\n\n";
		
		for ($i = 0; $i < $tamaño_cola; $i++) {
			if(isset($subastas_activas[$i])){
				$mensaje = $mensaje .
				"\tSubasta: " . $subastas_activas[$i]['Subasta']['nombre'] .
				"\n\tValor comercial de la subasta: " . $subastas_activas[$i]['Subasta']['valor'] .
				"\n\tCantidad mínima de creditos para subastar: " . $subastas_activas[$i]['Subasta']['umbral_minimo_creditos'] .
				"\n\tCantidad creditos por puja: " . $subastas_activas[$i]['Subasta']['cantidad_creditos_puja'] .
				"\n\tPrecio: " . $subastas_activas[$i]['Subasta']['precio'] .
				"\n\tAumento del precio x puja: " . $subastas_activas[$i]['Subasta']['aumento_precio'] .
				"\n\tFecha de Venta: " . $subastas_activas[$i]['Subasta']['fecha_de_venta'] .
				"\n\tDías de espera luego de la venta: " . $subastas_activas[$i]['Subasta']['dias_espera'] .
				"\n\n";
			}
		}
		
		// Correos lista correos
		//
		$correos = $this->ListaCorreo->find('list');

		foreach ($correos as $correo) {

			$para = $correo;
			$asunto = "Informe de subastas";
				
			$cabeceras = "From: webmaster@example.com" .
				"\r\n" . 
				'Reply-To: webmaster@example.com' . "\r\n" . 
				"X-Mailer: PHP/" . phpversion();

			if(mail($para, $asunto, $mensaje, $cabeceras)) {
				// TODO
			} else {
				// TODO
			}

		}
	}
	
}
?>