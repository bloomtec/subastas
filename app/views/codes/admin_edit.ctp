<div>
<?php echo $this->Form->create('Code');?>
	<fieldset>
 		<legend><?php __('Modificar PIN'); ?></legend>
	<?php
		echo $this->Form->input('batch_code_id');
		echo $this->Form->input('codigo');
		echo $this->Form->input('estado');
		echo $this->Form->input('fecha_expiracion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Modificar', true));?>
</div>