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
			//Encontrar la cantidad de subastas activas
			//
			$subastasActivas = $this->Subasta->find("all", array('conditions' => array('Subasta.estados_subasta_id' => '2')));

			$cantidadSubastasActivas = 0;

			foreach($subastasActivas as $subastaActiva){
				$cantidadSubastasActivas++;
			}

			//Cambiar el estado de la subasta a 'Activa'
			//
			$this->Subasta->id=$subastaEnEspera['Subasta']['id'];
			$this->Subasta->saveField('estados_subasta_id', '2');
			$this->Subasta->saveField('posicion_en_cola', $cantidadSubastasActivas + 1);
			$this->out('Subasta '.$subastaEnEspera['Subasta']['nombre'].' esta ahora con estado "Activa"');
		}
		
		$this->out('CRON job finalizado');
		
	}

}
?>