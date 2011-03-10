<?php
class AddShell extends Shell {

	var $uses = array('Subasta');

	function main(){

		//Encontrar las subastas en espera de activación
		//
		$subastasEnEspera = $this->Subasta->find("all", array('conditions'=>"Subasta.estado_id = '1'"));

		//Recorrer las subastas en espera de activación
		//
		foreach($subastasEnEspera as $subastaEnEspera){
			//Encontrar la cantidad de subastas activas
			//
			$subastasActivas = $this->Subasta->find("all", array('conditions'=>"Subasta.estado_id = '2'"));
			
			$cantidadSubastasActivas = 0;
			
			foreach($subastasActivas as $subastaActiva){
				$cantidadSubastasActivas++;
			}
			
			//Cambiar el estado de la subasta a 'Activa'
			//
			$this->Subasta->id=$subastaEnEspera['Subasta']['id'];
			$this->Subasta->saveField('estado_id', '2');
			$this->Subasta->saveField('posicion_en_cola', $cantidadSubastasActivas + 1);
		}
	}

}
?>