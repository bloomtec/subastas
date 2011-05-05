<div>
<?php echo $this->Form->create('Paquete');?>
	<fieldset>
		<legend><?php __('Añadir Paquetes'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('estado');
		echo $this->Form->input('creditos');
		echo $this->Form->input('precio');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>