<div class="ventas index">
	<h2><?php __('Ventas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<!-- <th><?php echo $this->Paginator->sort('id');?></th> -->
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('subasta_id');?></th>
			<th><?php echo $this->Paginator->sort('estados_venta_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<!-- <th><?php echo $this->Paginator->sort('updated');?></th> -->
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($ventas as $venta):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $venta['Venta']['id']; ?>&nbsp;</td> -->
		<td>
			<?php echo $this->Html->link($venta['User']['username'], array('controller' => 'users', 'action' => 'view', $venta['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($venta['Subasta']['nombre'], array('controller' => 'subastas', 'action' => 'view', $venta['Subasta']['id'])); ?>
		</td>
		<!-- <td> -->
			<!-- <?php echo $this->Html->link($venta['EstadosVenta']['nombre'], array('controller' => 'estados_ventas', 'action' => 'view', $venta['EstadosVenta']['id'])); ?> -->
		<td><?php echo $venta['EstadosVenta']['nombre']; ?>&nbsp;</td>
		<!-- </td> -->
		<td><?php echo $venta['Venta']['created']; ?>&nbsp;</td>
		<!-- <td><?php echo $venta['Venta']['updated']; ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $venta['Venta']['id'])); ?>
			<?php echo $this->Html->link(__('Modificar', true), array('action' => 'edit', $venta['Venta']['id'])); ?>
			<?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $venta['Venta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $venta['Venta']['id'])); ?>
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
<div class="actions">
	<h3><?php __('Menú'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Crear Una Venta', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('New Subasta', true), array('controller' => 'subastas', 'action' => 'add')); ?> </li> -->
		<li><?php echo $this->Html->link(__('Ofertas', true), array('controller' => 'ofertas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Usuarios', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('List Estados Ventas', true), array('controller' => 'estados_ventas', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New Estados Venta', true), array('controller' => 'estados_ventas', 'action' => 'add')); ?> </li> -->
	</ul>
</div>