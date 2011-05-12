<div class="estadosSubastas view">
<h2><?php  __('Estados Subasta');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estadosSubasta['EstadosSubasta']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estadosSubasta['EstadosSubasta']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estadosSubasta['EstadosSubasta']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Udpated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estadosSubasta['EstadosSubasta']['udpated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Estados Subasta', true), array('action' => 'edit', $estadosSubasta['EstadosSubasta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Estados Subasta', true), array('action' => 'delete', $estadosSubasta['EstadosSubasta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $estadosSubasta['EstadosSubasta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Estados Subastas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estados Subasta', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subasta', true), array('controller' => 'subastas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Subastas');?></h3>
	<?php if (!empty($estadosSubasta['Subasta'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Tipo Subasta Id'); ?></th>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Descripcion'); ?></th>
		<th><?php __('Imagen Path'); ?></th>
		<th><?php __('Valor'); ?></th>
		<th><?php __('Umbral Minimo Creditos'); ?></th>
		<th><?php __('Dias Espera'); ?></th>
		<th><?php __('Contenido Pagina'); ?></th>
		<th><?php __('Posicion En Cola'); ?></th>
		<th><?php __('Fecha De Venta'); ?></th>
		<th><?php __('Estados Subasta Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($estadosSubasta['Subasta'] as $subasta):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $subasta['id'];?></td>
			<td><?php echo $subasta['tipo_subasta_id'];?></td>
			<td><?php echo $subasta['nombre'];?></td>
			<td><?php echo $subasta['descripcion'];?></td>
			<td><?php echo $subasta['imagen_path'];?></td>
			<td><?php echo $subasta['valor'];?></td>
			<td><?php echo $subasta['umbral_minimo_creditos'];?></td>
			<td><?php echo $subasta['dias_espera'];?></td>
			<td><?php echo $subasta['contenido_pagina'];?></td>
			<td><?php echo $subasta['posicion_en_cola'];?></td>
			<td><?php echo $subasta['fecha_de_venta'];?></td>
			<td><?php echo $subasta['estados_subasta_id'];?></td>
			<td><?php echo $subasta['created'];?></td>
			<td><?php echo $subasta['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'subastas', 'action' => 'view', $subasta['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'subastas', 'action' => 'edit', $subasta['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'subastas', 'action' => 'delete', $subasta['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subasta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Subasta', true), array('controller' => 'subastas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
