<div>
<?php echo $this->Form->create('ListaCorreo');?>
	<fieldset>
 		<legend><?php __('Editar Contacto'); ?></legend>
	<?php
		echo $this->Form->input('correo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar', true));?>
</div>