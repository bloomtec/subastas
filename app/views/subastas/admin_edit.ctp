<div class="subastas form">
<?php echo $this->Form->create('Subasta');?>
	<fieldset>
 		<legend><?php __('Modificar Subasta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
	?>
	
	<div class="images">
		<div class="preview">
			<?php echo $html->image($this->data["Subasta"]["imagen_path"]);?>
		</div>
		<div id="single-upload" controller="subastas"> </div>
		
	</div>
	
	<?php
		echo $this->Form->input('tipo_subasta_id');
		echo $this->Form->input('valor');
		echo $this->Form->input('umbral_minimo_creditos');
		echo $this->Form->input('cantidad_creditos_puja');
		echo $this->Form->input('dias_espera');
		echo $this->Form->input('posicion_en_cola');
		echo $this->Form->input('fecha_de_venta');
		echo $this->Form->input('estados_subasta_id');
		echo $this->Form->input('imagen_path',array("id"=>"single-field","type"=>"hidden"));
	?>
	</fieldset>
	<?php echo $this->Form->end(__('Enviar', true));?>
</div>
<div class="actions">
	<h3><?php __('Menú'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Subastas', true), array('action' => 'index'));?></li>
		<i>
			<li><?php echo $this->Html->link(__('Eliminar Subasta', true), array('action' => 'delete', $this->Form->value('Subasta.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Subasta.id'))); ?></li>
		</i>
		<!-- <li><?php echo $this->Html->link(__('List Tipo Subastas', true), array('controller' => 'tipo_subastas', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New Tipo Subasta', true), array('controller' => 'tipo_subastas', 'action' => 'add')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('List Estados Subastas', true), array('controller' => 'estados_subastas', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New Estados Subasta', true), array('controller' => 'estados_subastas', 'action' => 'add')); ?> </li> -->
		<li><?php echo $this->Html->link(__('Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('New Venta', true), array('controller' => 'ventas', 'action' => 'add')); ?> </li> -->
		<li><?php echo $this->Html->link(__('Ofertas', true), array('controller' => 'ofertas', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('New Oferta', true), array('controller' => 'ofertas', 'action' => 'add')); ?> </li> -->
		<li><?php echo $this->Html->link(__('Usuarios', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
	</ul>
</div>