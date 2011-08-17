<div>
<?php echo $this->Form->create('BatchCode');?>
	<fieldset>
 		<legend><?php __('Modificar Fecha De Vencimiento'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nueva_fecha_de_vencimiento', array('type' => 'date'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Modificar', true));?>
</div>