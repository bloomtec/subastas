<?php
class ActivarSubastasShell extends Shell {

	var $uses = array('Subasta');

	function main(){

		$this->out('Iniciando CRON para activar subastas en estado "Esperando Activacion"');

		//Encontrar las subastas en espera de activación
		//
		$subastasEnEspera = $this->Subasta->find("all", array('conditions' => array('Subasta.estados_subasta_id' => '1')));

		//Recorrer las subastas en espera de activación
		//
		foreach($subastasEnEspera as $subastaEnEspera){
			//Cambiar el estado de la subasta a 'Activa'
			//
			$actualizado = $this->requestAction('/subastas/actualizarEstadoSubasta/'.$subastaEnEspera['Subasta']['id'].'/2');
		}

		$this->out('CRON job finalizado');

	}

}
?>