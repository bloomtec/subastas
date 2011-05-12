<div class="batchCodes form">
<?php echo $this->Form->create('BatchCode');?>
	<fieldset>
 		<legend><?php __('Edit Batch Code'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('BatchCode.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('BatchCode.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Batch Codes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Codes', true), array('controller' => 'codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Code', true), array('controller' => 'codes', 'action' => 'add')); ?> </li>
	</ul>
</div>