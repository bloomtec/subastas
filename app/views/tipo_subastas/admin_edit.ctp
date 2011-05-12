<div class="tipoSubastas form">
<?php echo $this->Form->create('TipoSubasta');?>
	<fieldset>
 		<legend><?php __('Admin Edit Tipo Subasta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('TipoSubasta.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('TipoSubasta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tipo Subastas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subasta', true), array('controller' => 'subastas', 'action' => 'add')); ?> </li>
	</ul>
</div>