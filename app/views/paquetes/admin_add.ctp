<div class="paquetes form">
<?php echo $this->Form->create('Paquete');?>
	<fieldset>
		<legend><?php __('Admin Add Paquete'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Paquetes', true), array('action' => 'index'));?></li>
	</ul>
</div>