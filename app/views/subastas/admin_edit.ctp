<div class="subastas form">
<?php echo $this->Form->create('Subasta');?>
	<fieldset>
 		<legend><?php __('Admin Edit Subasta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tipo_subasta_id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
		echo $this->Form->input('imagen_path');
		echo $this->Form->input('valor_actual');
		echo $this->Form->input('umbral_minimo_creditos');
		echo $this->Form->input('dias_espera');
		echo $this->Form->input('contenido_pagina');
		echo $this->Form->input('posicion_en_cola');
		echo $this->Form->input('estado');
		echo $this->Form->input('fecha_inicio_subasta');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Subasta.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Subasta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Subastas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Tipo Subastas', true), array('controller' => 'tipo_subastas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Subasta', true), array('controller' => 'tipo_subastas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Venta', true), array('controller' => 'ventas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ofertas', true), array('controller' => 'ofertas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Oferta', true), array('controller' => 'ofertas', 'action' => 'add')); ?> </li>
	</ul>
</div>