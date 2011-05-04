<div class="paquetes form">
<?php echo $this->Form->create('Paquete');?>
	<fieldset>
		<legend><?php __('Edit Paquete'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('estado');
		echo $this->Form->input('creditos');
		echo $this->Form->input('precio');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Paquete.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Paquete.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Paquetes', true), array('action' => 'index'));?></li>
	</ul>
</div>