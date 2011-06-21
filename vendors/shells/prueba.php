<?php
class PruebaShell extends Shell {

	var $uses = array('Subasta');
	
	function main(){
		
		$subasta = $this->Subasta->read(null, 4);
		debug($subasta);
		$fecha_de_venta = date($subasta['Subasta']['fecha_de_venta']);
		debug($fecha_de_venta);
		$fecha_de_venta = strtotime(date("Y-m-d H:i:s", strtotime($fecha_de_venta)) . " +" . $subasta['Subasta']['aumento_duracion'] . " seconds");
		$fecha_de_venta = date("Y-m-d H:i:s", $fecha_de_venta);
		$fecha_de_venta = new DateTime($fecha_de_venta);
		debug($fecha_de_venta);
		$this->Subasta->set('fecha_de_venta', $fecha_de_venta);
		
	}

}
?>