<div class="codes form">
<?php echo $this->Form->create('Code');?>
	<fieldset>
 		<legend><?php __('Admin Add Code'); ?></legend>
	<?php
		echo $this->Form->input('batch_code_id');
		echo $this->Form->input('codigo');
		echo $this->Form->input('estado');
		echo $this->Form->input('fecha_experacion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Codes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Batch Codes', true), array('controller' => 'batch_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Batch Code', true), array('controller' => 'batch_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>