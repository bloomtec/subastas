<div class="listaCorreos form">
<?php echo $this->Form->create('ListaCorreo');?>
	<fieldset>
 		<legend><?php __('Edit Lista Correo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('correo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ListaCorreo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ListaCorreo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Lista Correos', true), array('action' => 'index'));?></li>
	</ul>
</div>