<div class="subastas index">
	<h2><?php __('Subastas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('tipo_subasta_id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('descripcion');?></th>
			<th><?php echo $this->Paginator->sort('imagen_path');?></th>
			<th><?php echo $this->Paginator->sort('valor_actual');?></th>
			<th><?php echo $this->Paginator->sort('umbral_minimo_creditos');?></th>
			<th><?php echo $this->Paginator->sort('dias_espera');?></th>
			<th><?php echo $this->Paginator->sort('contenido_pagina');?></th>
			<th><?php echo $this->Paginator->sort('posicion_en_cola');?></th>
			<th><?php echo $this->Paginator->sort('estado');?></th>
			<th><?php echo $this->Paginator->sort('fecha_inicio_subasta');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
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
		<td><?php echo $subasta['Subasta']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($subasta['TipoSubasta']['id'], array('controller' => 'tipo_subastas', 'action' => 'view', $subasta['TipoSubasta']['id'])); ?>
		</td>
		<td><?php echo $subasta['Subasta']['nombre']; ?>&nbsp;</td>
		<td><?php echo $subasta['Subasta']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $subasta['Subasta']['imagen_path']; ?>&nbsp;</td>
		<td><?php echo $subasta['Subasta']['valor_actual']; ?>&nbsp;</td>
		<td><?php echo $subasta['Subasta']['umbral_minimo_creditos']; ?>&nbsp;</td>
		<td><?php echo $subasta['Subasta']['dias_espera']; ?>&nbsp;</td>
		<td><?php echo $subasta['Subasta']['contenido_pagina']; ?>&nbsp;</td>
		<td><?php echo $subasta['Subasta']['posicion_en_cola']; ?>&nbsp;</td>
		<td><?php echo $subasta['Subasta']['estado']; ?>&nbsp;</td>
		<td><?php echo $subasta['Subasta']['fecha_inicio_subasta']; ?>&nbsp;</td>
		<td><?php echo $subasta['Subasta']['created']; ?>&nbsp;</td>
		<td><?php echo $subasta['Subasta']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $subasta['Subasta']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $subasta['Subasta']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $subasta['Subasta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subasta['Subasta']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Subasta', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tipo Subastas', true), array('controller' => 'tipo_subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Subasta', true), array('controller' => 'tipo_subastas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Venta', true), array('controller' => 'ventas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ofertas', true), array('controller' => 'ofertas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Oferta', true), array('controller' => 'ofertas', 'action' => 'add')); ?> </li>
	</ul>
</div>