<div>
<?php echo $this->Form->create('BatchCode');?>
	<fieldset>
 		<legend><?php __('Admin Edit Batch Code'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>