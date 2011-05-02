<div>
<?php echo $this->Form->create('Testimonio');?>
	<fieldset>
 		<legend><?php __('Ingrese Su Testimonio'); ?></legend>
	<?php
		echo $this->Form->input('titulo', array('label'=>'Título'));
		echo $this->Form->input('texto', array('label'=>'Descripción'));
		echo $this->Form->input('imagen_path', array('label'=>'Imagen'));
	?>
	</fieldset>
	<?php echo $this->Form->end(__('Enviar', true));?>
</div>