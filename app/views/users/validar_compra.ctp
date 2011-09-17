<div id="left-content">
	 <?php echo $this->element("left");?>
</div>
<div id="right-content" class="pages">
<h1 class="titulo-amarillo">Confirma tu registro</h1>
<div class="WYSIWYG inactivity confirmar">
<?php
$datos = explode("-", $_POST['codigoFactura']);

if ($_POST['codigoAutorizacion'] == "00") {
	//echo "La compra no pudo realizarse";
	//
	//$this->Session->setFlash('La compra no pudo realizarse');

	echo "<p>";
	echo "La compra no pudo realizarse";
	echo "<form action='../../subastas'>";
	echo "<br><button type='submit' name='boton'>Volver Al Inicio</button>";
	echo "</form>";
	echo "</p>";

} else {
	$llaveencripcion = "6b7c2e50e9f54b3fb630197255e034ac";
	$cadena = $llaveencripcion . ";" . $_POST['codigoFactura'] . ";" . $_POST['valorFactura'] . ";" . $_POST['codigoAutorizacion'];

	if (md5($cadena) == $_POST['firmaTuCompra']) {
		// Compra realizada con exito
		//
		if ($datos[0] == 1) {
			// Se compro un paquete de creditos
			// Encontrar al usuario y sumarle los creditos
			//
			$user = $this -> User -> find('first', array('conditions' => array('User.id' => $datos[1])));
			$this -> User -> read(null, $datos[1]);
			$this -> User -> set('creditos', $user['User']['creditos'] + $datos[2]);
			$this -> User -> save();
		} else {
			if ($datos[0] == 2) {
				// Se compro una subasta ganada
				// Llamar el metodo de ventas y enviarle la id
				//
				$this -> requestAction('/ventas/pagada/' . $datos[2]);
			} else {
				//Nada por hacer bajo las condiciones actuales
				//
			}
		}

		//$this->Session->setFlash('La compra fue exitosa');

		echo "<p>";
		echo "La compra fue exitosa";
		echo "<form action='../../subastas'>";
		echo "<br><button type='submit' name='boton'>Volver Al Inicio</button>";
		echo "</form>";
		echo "</p>";
	} else {
		//la firma es invalida
		//
		//$this->Session->setFlash('La compra no pudo realizarse - La firma de confirmacion no es valida');

		echo "<p>";
		echo "La compra no pudo realizarse - La firma de confirmacion no es valida";
		echo "<form action='../../subastas'>";
		echo "<br><button type='submit' name='boton'>Volver Al Inicio</button>";
		echo "</form>";
		echo "</p>";
	}
}
?>
</div>
</div>