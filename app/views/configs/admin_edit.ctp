<div>
<?php echo $this->Form->create('Config');?>
	<fieldset>
 		<legend><?php __('Configuración'); ?></legend>
	<?php
		echo $this->Form->hidden('id', array('value'=>'1'));
		echo $this->Form->input('tamano_cola', array('label'=>'Tamaño Cola'));
		echo $this->Form->input('creditos_iniciales', array('label'=>'Creditos Iniciales Del Usuario'));
		echo $this->Form->input('creditos_recomendados', array('label'=>'Creditos Por Recomendar'));
		echo $this->Form->input('congelado', array('label'=>'Sitio Pausado'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>