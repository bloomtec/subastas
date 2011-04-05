<?php
    class pruebasShell extends Shell {
    	function main(){
    		$this->out($this->requestAction('/codes/generarCodigo'));
    	}
    }
?>