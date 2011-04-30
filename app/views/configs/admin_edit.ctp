<div>
<?php echo $this->Form->create('Config');?>
	<fieldset>
 		<legend><?php __('Configuración'); ?></legend>
	<?php
		echo $this->Form->hidden('id', array('value'=>'1'));
		echo $this->Form->input('tamano_cola', array('label'=>'Tamaño Cola'));
		echo $this->Form->input('creditos_recomendados', array('label'=>'Creditos Por Recomendar'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>