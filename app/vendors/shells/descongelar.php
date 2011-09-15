<?php
class DescongelarShell extends Shell {
	
	function main(){
		$this->requestAction('/configs/descongelar');
	}

}
?>