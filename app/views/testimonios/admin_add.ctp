<div class="testimonios form">
<?php echo $this->Form->create('Testimonio');?>
	<fieldset>
 		<legend><?php __('Admin Add Testimonio'); ?></legend>
	<?php
		echo $this->Form->input('imagen_path');
		echo $this->Form->input('titulo');
		echo $this->Form->input('texto');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Testimonios', true), array('action' => 'index'));?></li>
	</ul>
</div>