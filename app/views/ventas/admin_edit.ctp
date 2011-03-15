<div class="ventas form">
<?php echo $this->Form->create('Venta');?>
	<fieldset>
 		<legend><?php __('Admin Edit Venta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('subasta_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('estados_venta_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Venta.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Venta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ventas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subasta', true), array('controller' => 'subastas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Estados Ventas', true), array('controller' => 'estados_ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estados Venta', true), array('controller' => 'estados_ventas', 'action' => 'add')); ?> </li>
	</ul>
</div>