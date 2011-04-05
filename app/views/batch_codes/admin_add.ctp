<div class="batchCodes form">
<?php echo $this->Form->create('BatchCode');?>
	<fieldset>
 		<legend><?php __('Admin Add Batch Code'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
		echo $this->Form->input('creditos_por_codigo');
		echo $this->Form->input('cantidad_de_codigos');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Batch Codes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Codes', true), array('controller' => 'codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Code', true), array('controller' => 'codes', 'action' => 'add')); ?> </li>
	</ul>
</div>