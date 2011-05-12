<div class="ofertas form">
<?php echo $this->Form->create('Oferta');?>
	<fieldset>
 		<legend><?php __('Modificar Oferta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('subasta_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('creditos_descontados');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>
<div class="actions">
	<h3><?php __('Menú'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Ofertas', true), array('action' => 'index'));?></li>
		<i>
			<li><?php echo $this->Html->link(__('Eliminar Oferta', true), array('action' => 'delete', $this->Form->value('Oferta.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Oferta.id'))); ?></li>
		</i>
		<li><?php echo $this->Html->link(__('Subastas', true), array('controller' => 'subastas', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('New Subasta', true), array('controller' => 'subastas', 'action' => 'add')); ?> </li> -->
		<li><?php echo $this->Html->link(__('Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Usuarios', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li> -->
	</ul>
</div>