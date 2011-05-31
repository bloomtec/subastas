<div>
	<table>
		<thead>
			<tr>
				<td>Ingrese su PIN</td>
				<td></td>
			</tr>
		</thead>
		<?php echo $this->Form->create(null, array('class'=>'formPIN', 'controller'=>'users', 'action'=>'ingresoPIN')); ?>
		<tr>
			<td>
				<?php echo $this->Form->input('pin', array('label'=>'')); ?>
			</td>
			<td>
				<?php echo $this->Form->end('Enviar'); ?>
			</td>
		</tr>
	</table>
	<table>
		<thead>
			<tr>
				<td>Paquete</td>
				<td>Valor</td>
				<td>Creditos</td>
				<td></td>
			</tr>
		</thead>
		<?php foreach($paquetes as $paquete) : ?>
			<tr>
				<td>
					<?php echo $paquete['Paquete']['nombre']; ?>
				</td>
				<td>
					<?php echo $paquete['Paquete']['precio']; ?>
				</td>
				<td>
					<?php echo $paquete['Paquete']['creditos']; ?>
				</td>
				<td>
					<?php
						// Crear el form
						//
						$form_id = $paquete['Paquete']['id'];
						echo $this->Form->create(
												null,
												array(
													'class'=>'formCompraCreditos',
													'type'=>'POST',
													'url'=>'http://demo.tucompra.com.co/tc/app/inputs/compra.jsp'
												)
											);
						// Datos de comercio
						//
						echo $form->hidden('usuario', array('name'=>'usuario', 'value'=>'o61qja192w81o1zb'));
						$gmt = 3600*-5; // GMT -5 para hora colombiana
						$fechaActual = gmdate('YmdHis', time() + $gmt);
						$factura_id = $user_id . $fechaActual;
						echo $this->Form->hidden('factura', array('name'=>'factura', 'value'=>"$factura_id"));
						echo $this->Form->hidden('valor', array('name'=>'valor', 'value'=>$paquete['Paquete']['precio']));
						$nombre = $paquete['Paquete']['nombre'];
						echo $this->Form->hidden('descripcionFactura', array('name'=>'descripcionFactura', 'value'=>"Compra del paquete $nombre de llevatelos.com"));
						// Datos de usuario
						// Se pide: documento, nombre, apellido, correo,
						// direccion, telefono, celular, ciudad, pais
						$datos = $this->requestAction('/user_fields/listFields/' . $session->read('Auth.User.id'));
						echo $this->Form->hidden('documentoComprador', array('name'=>'documentoComprador', 'value'=>$datos['UserField']['cedula']));
						echo $this->Form->hidden('nombreComprador', array('name'=>'nombreComprador', 'value'=>$datos['UserField']['nombres']));
						echo $this->Form->hidden('apellidoComprador', array('name'=>'apellidoComprador', 'value'=>$datos['UserField']['apellidos']));
						echo $this->Form->hidden('correoComprador', array('name'=>'correoComprador', 'value'=>$datos['User']['email']));
						echo $this->Form->hidden('direccionComprador', array('name'=>'direccionComprador', 'value'=>$datos['UserField']['direccion']));
						echo $this->Form->hidden('telefonoComprador', array('name'=>'telefonoComprador', 'value'=>$datos['UserField']['telefono_fijo']));
						echo $this->Form->hidden('ciudadComprador', array('name'=>'ciudadComprador', 'value'=>$datos['UserField']['ciudad']));
						echo $this->Form->hidden('paisComprador', array('name'=>'paisComprador', 'value'=>'Colombia'));
						// URL de respuesta
						//
						echo $this->Form->hidden('urlRetorno', array('name'=>'urlRetorno', 'value'=>'http://www.embalao.org/subastas/users/validarCompraCreditos'));
						// Campo extra
						// campoExtra1
						$campo_extra = $session->read('Auth.User.id') . "-" . $paquete['Paquete']['creditos'];
						echo $this->Form->hidden('campoExtra1', array('name'=>'campoExtra1', 'value'=>$campo_extra));
						// Finalizar el form
						//
						echo $this->Form->end("Enviar");
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>