<div class="subastas index">
	<h2><?php __('Subastas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('imagen_path');?></th>
			<th><?php echo $this->Paginator->sort('estado_id');?></th>
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
	<tr<?php echo $class;?>
		<td><?php echo $subasta['Subasta']['nombre']; ?>&nbsp;</td>
		<td><?php echo $html->image($subasta['Subasta']['imagen_path'],array("width"=>"200")); ?>&nbsp;</td>
		<td><?php echo $subasta['Estado']['nombre']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $subasta['Subasta']['id'])); ?>
			<?php echo $this->Html->link(__('Modificar', true), array('action' => 'edit', $subasta['Subasta']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $subasta['Subasta']['id']), null, sprintf(__('Esta seguro de querer borrar # %s?', true), $subasta['Subasta']['id'])); ?>
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
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nueva Subasta', true), array('action' => 'add')); ?></li>
	</ul>
</div>