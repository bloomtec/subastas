<div class="codes view">
<h2><?php  __('Code');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $code['Code']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Batch Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($code['BatchCode']['nombre'], array('controller' => 'batch_codes', 'action' => 'view', $code['BatchCode']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $code['Code']['codigo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $code['Code']['estado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha Experacion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $code['Code']['fecha_experacion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $code['Code']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $code['Code']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Code', true), array('action' => 'edit', $code['Code']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Code', true), array('action' => 'delete', $code['Code']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $code['Code']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Codes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Code', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Batch Codes', true), array('controller' => 'batch_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Batch Code', true), array('controller' => 'batch_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
