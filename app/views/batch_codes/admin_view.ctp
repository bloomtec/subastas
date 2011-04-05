<div class="batchCodes view">
<h2><?php  __('Batch Code');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $batchCode['BatchCode']['id']; ?>
			&nbsp;
		</dd>
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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $batchCode['BatchCode']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $batchCode['BatchCode']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Batch Code', true), array('action' => 'edit', $batchCode['BatchCode']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Batch Code', true), array('action' => 'delete', $batchCode['BatchCode']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $batchCode['BatchCode']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Batch Codes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Batch Code', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Codes', true), array('controller' => 'codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Code', true), array('controller' => 'codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Codes');?></h3>
	<?php if (!empty($batchCode['Code'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Batch Code Id'); ?></th>
		<th><?php __('Estado'); ?></th>
		<th><?php __('Fecha Experacion'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
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
			<td><?php echo $code['id'];?></td>
			<td><?php echo $code['batch_code_id'];?></td>
			<td><?php echo $code['estado'];?></td>
			<td><?php echo $code['fecha_experacion'];?></td>
			<td><?php echo $code['created'];?></td>
			<td><?php echo $code['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'codes', 'action' => 'view', $code['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'codes', 'action' => 'edit', $code['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'codes', 'action' => 'delete', $code['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $code['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Code', true), array('controller' => 'codes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
