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
						echo $this->Form->hidden('usuario', array('value'=>'administracion@grupokotai.com'));
						echo $this->Form->hidden('factura', array('value'=>''));
						echo $this->Form->hidden('valor', array('value'=>$paquete['Paquete']['precio']));
						$nombre = $paquete['Paquete']['nombre'];
						echo $this->Form->hidden('descripcionFactura', array('value'=>"Compra del paquete $nombre"));
						echo $this->Form->submit("Enviar");
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>