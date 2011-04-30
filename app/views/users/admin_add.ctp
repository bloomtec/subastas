<div>
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Añadir Usuario'); ?></legend>
	<?php
		echo $this->Form->input('role_id');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>