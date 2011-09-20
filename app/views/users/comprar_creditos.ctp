<div id="left-content">
	<?php echo $this -> element("left");?>
</div>
<div id="right-content">
	<div class="corner">
		<h1 class="titulo-amarillo">Mi cuenta</h1>
		<div class="paquetes">
			<?php echo $html -> image("se_te_acabaron_los_creditos.png");?>
			<table class="creditos">
				<thead>
					<tr>
						<td>Paquete</td>
						<td>Valor</td>
						<td>Creditos</td>
						<td>Comprar</td>
					</tr>
				</thead>
				<?php foreach($paquetes as $paquete) :
				?>
				<tr>
					<td><?php echo $paquete['Paquete']['nombre'];?></td>
					<td><?php echo("$" . number_format($paquete['Paquete']['precio'], 0, ' ', '.'));?></td>
					<td><?php echo $paquete['Paquete']['creditos'];?></td>
					<td><?php

					// Crear el form
					//
					echo $this -> Form -> create(null, array('class' => 'formCompraCreditos', 'type' => 'POST', 'url' => 'http://demo.tucompra.com.co/tc/app/inputs/compra.jsp'));

					/**
					 * Datos de comercio
					 */
					echo $form -> hidden('usuario', array('name' => 'usuario', 'value' => 'o61qja192w81o1zb'));

					// Crear el código de factura
					//
					$factura_id = $this -> requestAction('/facturas/generarCodigoFactura');
					$this -> requestAction('/facturas/crearFactura/' . $factura_id . '/' . $user_id . '/0/' . $paquete['Paquete']['creditos']);
					echo $this -> Form -> hidden('factura', array('name' => 'factura', 'value' => "$factura_id"));
					echo $this -> Form -> hidden('valor', array('name' => 'valor', 'value' => $paquete['Paquete']['precio']));
					$nombre = $paquete['Paquete']['nombre'];
					echo $this -> Form -> hidden('descripcionFactura', array('name' => 'descripcionFactura', 'value' => "Compra del paquete $nombre de llevatelos.com"));

					/**
					 * Datos de usuario, se pide:
					 * documento, nombre, apellido, correo, direccion, telefono, celular, ciudad, pais
					 */
					$datos = $this -> requestAction('/user_fields/listFields/' . $user_id);
					echo $this -> Form -> hidden('documentoComprador', array('name' => 'documentoComprador', 'value' => $datos['UserField']['cedula']));
					echo $this -> Form -> hidden('nombreComprador', array('name' => 'nombreComprador', 'value' => $datos['UserField']['nombres']));
					echo $this -> Form -> hidden('apellidoComprador', array('name' => 'apellidoComprador', 'value' => $datos['UserField']['apellidos']));
					echo $this -> Form -> hidden('correoComprador', array('name' => 'correoComprador', 'value' => $datos['User']['email']));
					echo $this -> Form -> hidden('direccionComprador', array('name' => 'direccionComprador', 'value' => $datos['UserField']['direccion']));
					echo $this -> Form -> hidden('telefonoComprador', array('name' => 'telefonoComprador', 'value' => $datos['UserField']['telefono_fijo']));
					echo $this -> Form -> hidden('ciudadComprador', array('name' => 'ciudadComprador', 'value' => $datos['UserField']['ciudad']));
					echo $this -> Form -> hidden('paisComprador', array('name' => 'paisComprador', 'value' => 'Colombia'));

					// URL de respuesta
					//
					echo $this -> Form -> hidden('urlRetorno', array('name' => 'urlRetorno', 'value' => 'http://www.llevatelos.com/users/validarCompraCreditos'));

					// Finalizar el form
					//
					echo $this -> Form -> end(" ");
					?></td>
				</tr>
				<?php endforeach;?>
			</table>
			<div class="pins">
				<h2>Si compraste en efectivo</h2>
				<?php echo $this -> Form -> create(null, array('class' => 'formPIN', 'controller' => 'users', 'action' => 'ingresoPIN'));?>
				<?php echo $this -> Form -> input('pin', array('label' => 'Código PIN'));?>
				<?php echo $this -> Form -> end(' ');?>
			</div>
		</div>
	</div>
	<?php echo $html -> link($html -> image("volver_cuenta.png"), "/users", array("escape" => false, "class" => "volver"));?>
</div>