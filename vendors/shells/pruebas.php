<?php
    class pruebasShell extends Shell {
    	function main(){
    		$string_fecha_1 = '2011-4-10';
    		$fecha_1 = date('Y-m-d', strtotime($string_fecha_1));
    		$fecha_2 = date('Y-m-d', time('now'));
    		if ($fecha_1 >= $fecha_2) {
    			$this->out('Valido');
    		} else {
    			$this->out('Expirado');
    		}
    	}
    }
?>