<?php
    class pruebasShell extends Shell {
    	function main(){
    		$this->out(date('Y') . '-' . date('m') . '-' . date('d'));
    		$this->out(date('Y-m-d H:i:s', mktime(date('H')-5, date('i'), date('s'), date('m'), date('d'), date('Y'))));
    	}
    }
?>