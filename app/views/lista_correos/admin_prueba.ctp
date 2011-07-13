<div>
	<?php echo $this->Form->create(null, array('controller' => '', 'action' => 'prueba'));?>
		<fieldset>
	 		<legend><?php __('Pruebas Mad Mimi'); ?></legend>
		<?php
			echo $this->Form->input('correos', array('type' => 'select', 'multiple' => 'checkbox'));
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Probar Mad Mimi', true));?>
</div>