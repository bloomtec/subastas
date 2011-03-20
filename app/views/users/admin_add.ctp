<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Crear Un Usuario'); ?></legend>
	<?php
		echo $this->Form->input('role_id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Menú'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Usuarios', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Ofertas', true), array('controller' => 'ofertas', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('List Roles', true), array('controller' => 'roles', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New Role', true), array('controller' => 'roles', 'action' => 'add')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('List User Fields', true), array('controller' => 'user_fields', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New User Field', true), array('controller' => 'user_fields', 'action' => 'add')); ?> </li> -->
	</ul>
</div>