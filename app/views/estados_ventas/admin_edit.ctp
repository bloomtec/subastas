<div class="estadosVentas form">
<?php echo $this->Form->create('EstadosVenta');?>
	<fieldset>
 		<legend><?php __('Admin Edit Estados Venta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('EstadosVenta.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('EstadosVenta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Estados Ventas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Venta', true), array('controller' => 'ventas', 'action' => 'add')); ?> </li>
	</ul>
</div>