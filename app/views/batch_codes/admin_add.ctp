<div>
<?php echo $this->Form->create('BatchCode');?>
	<fieldset>
 		<legend><?php __('Añadir PIN'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
		echo $this->Form->input('creditos_por_codigo');
		echo $this->Form->input('cantidad_de_codigos');
		echo $form->input('fecha_expiracion', array('type'=>'date', 'minYear'=>date('Y')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>