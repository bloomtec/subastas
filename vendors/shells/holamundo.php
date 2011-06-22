<?php
class HolamundoShell extends Shell {
	
	function main () {
		if (isset($this->args[0])) {
			$this->out("Hola mundo! (salida " . $this->args[0] . ")");
		} else {
			$this->out("Hola mundo!");
		}
	}
	
}
?>