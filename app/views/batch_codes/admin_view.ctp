<div>
<h2><?php  __('Paquete PIN\'s');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $batchCode['BatchCode']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $batchCode['BatchCode']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $batchCode['BatchCode']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modificado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $batchCode['BatchCode']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php __('PIN\'s Del Paquete');?></h3>
	<?php if (!empty($batchCode['Code'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Estado'); ?></th>
		<th><?php __('Fecha Expiracion'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($batchCode['Code'] as $code):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $code['estado'];?></td>
			<td><?php echo $code['fecha_expiracion'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver', true), array('controller' => 'codes', 'action' => 'view', $code['id'])); ?>
				<?php echo $this->Html->link(__('Modificar', true), array('controller' => 'codes', 'action' => 'edit', $code['id'])); ?>
				<?php echo $this->Html->link(__('Borrar', true), array('controller' => 'codes', 'action' => 'delete', $code['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $code['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
