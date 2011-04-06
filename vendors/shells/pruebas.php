<?php
class pruebasShell extends Shell {
	function main(){
		$datoInicial = 1;
		$datoEncriptado = crypt($datoInicial, "23()23*$%g4F^aN!^^%");
		$this->out($datoEncriptado);
		if ($datoEncriptado == crypt(1, "23()23*$%g4F^aN!^^%")) {
			$this->out("Iguales");
		} else {
			$this->out("Diferentes");
		}
	}
}
?>