<div class="estadosSubastas form">
<?php echo $this->Form->create('EstadosSubasta');?>
	<fieldset>
 		<legend><?php __('Add Estados Subasta'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('udpated');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Estados Subastas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subasta', true), array('controller' => 'subastas', 'action' => 'add')); ?> </li>
	</ul>
</div>