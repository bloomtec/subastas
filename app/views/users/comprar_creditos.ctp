<div>
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
						echo $this->Form->create(null, array('type'=>'POST', 'url'=>'http://demo.tucompra.com.co/tc/app/inputs/compra.jsp'));
						echo $this->Form->input('usuario', array('name'=>'usuario', 'value'=>'o61qja192w81o1zb'));
						$gmt = 3600*-5; // GMT -5 para hora colombiana
						$fechaActual = gmdate('YmdHis', time() + $gmt);
						$factura_id = $user_id . $fechaActual;
						echo $this->Form->input('factura', array('name'=>'factura', 'value'=>"$factura_id"));
						echo $this->Form->input('valor', array('name'=>'valor', 'value'=>$paquete['Paquete']['precio']));
						$nombre = $paquete['Paquete']['nombre'];
						echo $this->Form->input('descripcionFactura', array('name'=>'descripcionFactura', 'value'=>"Compra del paquete $nombre"));
						echo $this->Form->submit("Enviar");
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>