<div>
<?php echo $this->Form->create('BatchCode');?>
	<fieldset>
 		<legend><?php __('Modificar Paquete De PIN\'s'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Modificar', true));?>
</div>