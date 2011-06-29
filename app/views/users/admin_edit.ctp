<div>
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Modificar Usuario'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('role_id');
		echo $this->Form->input('username');
		echo $this->Form->input('password', array("label"=>"password"));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>