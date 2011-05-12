<div class="listaCorreos form">
<?php echo $this->Form->create('ListaCorreo');?>
	<fieldset>
 		<legend><?php __('Add Lista Correo'); ?></legend>
	<?php
		echo $this->Form->input('correo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Lista Correos', true), array('action' => 'index'));?></li>
	</ul>
</div>