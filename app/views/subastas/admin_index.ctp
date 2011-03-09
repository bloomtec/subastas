<div class="subastas index">
	<h2><?php __('Subastas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('imagen_path');?></th>
			<th><?php echo $this->Paginator->sort('estado');?></th>
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
		<td><?php echo $subasta['Subasta']['estado']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $subasta['Subasta']['id'])); ?>
			<?php echo $this->Html->link(__('Modificar', true), array('action' => 'edit', $subasta['Subasta']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $subasta['Subasta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subasta['Subasta']['id'])); ?>
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
		<!--
		<li><?php echo $this->Html->link(__('Tipos De Subasta', true), array('controller' => 'tipo_subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Tipo De Subasta', true), array('controller' => 'tipo_subastas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado De Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Venta', true), array('controller' => 'ventas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listado De Ofertas', true), array('controller' => 'ofertas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nueva Oferta', true), array('controller' => 'ofertas', 'action' => 'add')); ?> </li>
		-->
	</ul>
</div>