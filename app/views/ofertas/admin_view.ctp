<div class="ofertas view">
<h2><?php  __('Oferta');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt> -->
		<!-- <dd<?php if ($i++ % 2 == 0) echo $class;?>> -->
			<!-- <?php echo $oferta['Oferta']['id']; ?> -->
			<!-- &nbsp; -->
		<!-- </dd> -->
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subasta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($oferta['Subasta']['nombre'], array('controller' => 'subastas', 'action' => 'view', $oferta['Subasta']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($oferta['User']['password'], array('controller' => 'users', 'action' => 'view', $oferta['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creditos Descontados'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $oferta['Oferta']['creditos_descontados']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $oferta['Oferta']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $oferta['Oferta']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Menú'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Modificar Oferta', true), array('action' => 'edit', $oferta['Oferta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Borrar Oferta', true), array('action' => 'delete', $oferta['Oferta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $oferta['Oferta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ofertas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Oferta', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subasta', true), array('controller' => 'subastas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
