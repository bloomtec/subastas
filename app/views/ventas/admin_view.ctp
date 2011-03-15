<div class="ventas view">
<h2><?php  __('Venta');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $venta['Venta']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subasta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($venta['Subasta']['nombre'], array('controller' => 'subastas', 'action' => 'view', $venta['Subasta']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($venta['User']['password'], array('controller' => 'users', 'action' => 'view', $venta['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estados Venta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($venta['EstadosVenta']['nombre'], array('controller' => 'estados_ventas', 'action' => 'view', $venta['EstadosVenta']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $venta['Venta']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $venta['Venta']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Venta', true), array('action' => 'edit', $venta['Venta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Venta', true), array('action' => 'delete', $venta['Venta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $venta['Venta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ventas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Venta', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subasta', true), array('controller' => 'subastas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estados Ventas', true), array('controller' => 'estados_ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estados Venta', true), array('controller' => 'estados_ventas', 'action' => 'add')); ?> </li>
	</ul>
</div>
