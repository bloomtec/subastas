<div>
<?php echo $this->Form->create('ListaCorreo');?>
	<fieldset>
 		<legend><?php __('Añadir Contacto'); ?></legend>
	<?php
		echo $this->Form->input('correo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Añadir', true));?>
</div>