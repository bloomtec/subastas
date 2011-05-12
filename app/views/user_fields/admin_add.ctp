<div class="userFields form">
<?php echo $this->Form->create('UserField');?>
	<fieldset>
		<legend><?php __('Admin Add User Field'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('nombres');
		echo $this->Form->input('apellidos');
		echo $this->Form->input('cedula');
		echo $this->Form->input('fecha_de_nacimiento');
		echo $this->Form->input('sexo');
		echo $this->Form->input('email');
		echo $this->Form->input('direccion');
		echo $this->Form->input('ciudad');
		echo $this->Form->input('telefono_fijo');
		echo $this->Form->input('ocupacion');
		echo $this->Form->input('lugar_ocupacion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Fields', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>