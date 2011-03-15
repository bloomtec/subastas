<div class="estadosVentas view">
<h2><?php  __('Estados Venta');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estadosVenta['EstadosVenta']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estadosVenta['EstadosVenta']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estadosVenta['EstadosVenta']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estadosVenta['EstadosVenta']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Estados Venta', true), array('action' => 'edit', $estadosVenta['EstadosVenta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Estados Venta', true), array('action' => 'delete', $estadosVenta['EstadosVenta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $estadosVenta['EstadosVenta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Estados Ventas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estados Venta', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Venta', true), array('controller' => 'ventas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Ventas');?></h3>
	<?php if (!empty($estadosVenta['Venta'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Subasta Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Estados Venta Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($estadosVenta['Venta'] as $venta):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $venta['id'];?></td>
			<td><?php echo $venta['subasta_id'];?></td>
			<td><?php echo $venta['user_id'];?></td>
			<td><?php echo $venta['estados_venta_id'];?></td>
			<td><?php echo $venta['created'];?></td>
			<td><?php echo $venta['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'ventas', 'action' => 'view', $venta['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'ventas', 'action' => 'edit', $venta['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'ventas', 'action' => 'delete', $venta['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $venta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Venta', true), array('controller' => 'ventas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
