<div class="subastas form">
<?php echo $this->Form->create('Subasta');?>
	<fieldset>
 		<legend><?php __('Crear Una Subasta'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
	?>
	<div class="images">
		<h2>Imagen</h2>
		<div class="preview">
		</div>
		<div id="single-upload" controller="subastas"> </div>			
	</div>
	<?php
		echo $this->Form->input('tipo_subasta_id', array("value" => "1"));
		echo $this->Form->input('valor', array("value" => "0"));
		echo $this->Form->input('umbral_minimo_creditos', array("value" => "0"));
		echo $this->Form->input('fecha_de_venta');
		echo $this->Form->input('dias_espera', array("value" => "0"));
		echo $this->Form->input('estados_subasta_id', array("type"=>"hidden", "value" => "1"));
		echo $this->Form->input('imagen_path', array("id"=>"single-field","type"=>"hidden"));
		echo $this->Form->input('posicion_en_cola', array("type" => "hidden", "value" => "-1"));
		// echo $this->Form->input('contenido_pagina');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>
<div class="actions">
	<h3><?php __('Menú'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Subastas', true), array('action' => 'index'));?></li>
		<!-- <li><?php echo $this->Html->link(__('Tipos De Subasta', true), array('controller' => 'tipo_subastas', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('Nuevo Tipo De Subasta', true), array('controller' => 'tipo_subastas', 'action' => 'add')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('Estados De Una Subasta', true), array('controller' => 'estados_subastas', 'action' => 'index')); ?> </li> -->
		<!-- <li><?php echo $this->Html->link(__('New Estados Subasta', true), array('controller' => 'estados_subastas', 'action' => 'add')); ?> </li> -->
		<li><?php echo $this->Html->link(__('Ventas', true), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('Nueva Venta', true), array('controller' => 'ventas', 'action' => 'add')); ?> </li> -->
		<li><?php echo $this->Html->link(__('Ofertas', true), array('controller' => 'ofertas', 'action' => 'index')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('Nueva Oferta', true), array('controller' => 'ofertas', 'action' => 'add')); ?> </li> -->
		<li><?php echo $this->Html->link(__('Usuarios', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
	</ul>
</div>