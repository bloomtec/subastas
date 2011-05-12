<div>
	<h2><?php __('Subastas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('valor');?></th>
			<th><?php echo $this->Paginator->sort('umbral_minimo_creditos');?></th>
			<th><?php echo $this->Paginator->sort('imagen_path');?></th>
			<th><?php echo $this->Paginator->sort('estados_subasta_id');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($subastas as $subasta):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $subasta['Subasta']['nombre']; ?>&nbsp;</td>
		<?php
			if($subasta['Subasta']['tipo_subasta_id'] == 1){
				echo '<td>'.$subasta['Subasta']['valor'].'&nbsp;</td>';
				echo '<td>'.'&nbsp;</td>';
			} else {
				echo '<td>'.'&nbsp;</td>';
				echo '<td>'.$subasta['Subasta']['umbral_minimo_creditos'].'&nbsp;</td>';
			}
		?>
		<td><?php echo $html->image($subasta['Subasta']['imagen_path'],array("width"=>"200")); ?>&nbsp;</td>
		<td><?php echo $subasta['EstadosSubasta']['nombre']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $subasta['Subasta']['id'])); ?>
			<?php echo $this->Html->link(__('Modificar', true), array('action' => 'edit', $subasta['Subasta']['id'])); ?>
			<?php echo $this->Html->link(__('Cerrar', true), array('action' => 'cerrar', $subasta['Subasta']['id']), null, sprintf(__('¿Cerrar la subasta %s?', true), $subasta['Subasta']['nombre'])); ?>
			<?php echo $this->Html->link(__('Cancelar', true), array('action' => 'cancel', $subasta['Subasta']['id']), null, sprintf(__('¿Cancelar la subasta %s?', true), $subasta['Subasta']['nombre'])); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $subasta['Subasta']['id']), null, sprintf(__('¿Eliminar la subasta %s?', true), $subasta['Subasta']['nombre'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página %page% de %pages%, mostrando %current% registros de %count% en total, mostrando desde el registro %start%, hasta el %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>