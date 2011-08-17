<div id="right-content">
	<h1 class="titulo-amarillo">Subastas Ganadas</h1>
	<?php if (!empty($subastas)): ?>
	<ul class="subastas-ganadas index" id="subastas-ganadas">
		<?php $i=0;?>
		<?php foreach ($subastas as $subasta): ?>
		<li <?php if($i%3==1) echo "class='centro'"?>  rel="<?php echo $subasta["Subasta"]["id"]; ?>">
			<div class="mascara"></div>
			<div class="fecha_vencimiento">
				<?php
					$fecha= date_create_from_format('Y-m-d H:i:s',	$subasta["Subasta"]["fecha_de_venta"]);
					echo $fecha->format('Y M d H:i:s');
				?>
			</div>
			<div class="hora_servidor">
				<?php
					$fecha= date("Y M d H:i:s",strtotime("now"));
					echo $fecha;
				?>
			</div>
			<?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
			<?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
			<?php echo $this->Html->para("pvp","PVP $".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
			<?php
				// Crear el form
				//
				$form_id = $subasta['Subasta']['id'];
				echo $this->Form->create(
										null,
										array(
											'class'=>'formCompraSubasta',
											'type'=>'POST',
											'url'=>'http://demo.tucompra.com.co/tc/app/inputs/compra.jsp'
										)
									);
				// Datos de comercio
				//
				echo $form->hidden('usuario', array('name'=>'usuario', 'value'=>'o61qja192w81o1zb'));
				$gmt = 3600*-5; // GMT -5 para hora colombiana
				$fechaActual = gmdate('YmdHis', time() + $gmt);
				$venta_id = $this->requestAction('/ventas/obtenerIdVenta/' . $subasta['Subasta']['id']);
				$factura_id = "2-" . $user_id . "-" . $venta_id . "-" . $fechaActual;
				echo $this->Form->hidden('factura', array('name'=>'factura', 'value'=>"$factura_id"));
				echo $this->Form->hidden('valor', array('name'=>'valor', 'value'=>$subasta['Subasta']['precio']));
				$nombre = $subasta['Subasta']['nombre'];
				echo $this->Form->hidden('descripcionFactura', array('name'=>'descripcionFactura', 'value'=>"Compra de la subasta ganada $nombre en llevatelos.com"));
				// Datos de usuario
				// Se pide: documento, nombre, apellido, correo,
				// direccion, telefono, celular, ciudad, pais
				$datos = $this->requestAction('/user_fields/listFields/' . $user_id);
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
				echo $this->Form->hidden('urlRetorno', array('name'=>'urlRetorno', 'value'=>'http://www.embalao.org/subastas/users/validarCompra'));
				// Finalizar el form
				//
				echo $this->Form->end("Pagar Via TuCompra");
			?>
		</li>
		<?php
			$i++;
			endforeach;
		?>
	</ul>
	<div style="clear:both"></div>
	<?php endif; ?>
</div>