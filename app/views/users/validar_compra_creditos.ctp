<div id="left-content">
	<?php echo $this -> element("left");?>
</div>
<div id="right-content" class="pages">
	<h1 class="titulo-amarillo">Confirma tu registro</h1>
	<div class="WYSIWYG inactivity confirmar-compra">
		<?php
		$factura = $this -> requestAction('/facturas/getFactura/' . $_POST['codigoFactura']);

		if ($_POST['codigoAutorizacion'] == "00") {
			// La compra no pudo realizarse
			//
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
				$this -> requestAction('/users/pasoFinalValidarCompra/' . $user['User']['id'] . '/' . $factura['Factura']['creditos']);
				$this -> requestAction(
					'/facturas/recibirDatosCallback/'
					. $_POST['codigoFactura'] . '/'
					. $_POST['transaccionAprobada'] . '/'
					. $_POST['valorFactura'] . '/'
					. $_POST['tipoMoneda'] . '/'
					. $_POST['codigoAutorizacion'] . '/'
					. $_POST['numeroTransaccion'] . '/'
					. $_POST['metodoPago'] . '/'
					. $_POST['nombreMetodoPago']
				);
				echo "<p>";
				echo "La compra fue exitosa";
				echo "<form action='../../subastas'>";
				echo "<br><button type='submit' name='boton'>Volver Al Inicio</button>";
				echo "</form>";
				echo "</p>";
			} else {
				//la firma no es valida
				//
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