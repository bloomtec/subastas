<?php
class CongelarShell extends Shell {
	
	function main(){
		
		$duracion = 60; // Tiempo en minutos
		
		$this->requestAction('/configs/congelar/' . $duracion);
		
	}

}
?>