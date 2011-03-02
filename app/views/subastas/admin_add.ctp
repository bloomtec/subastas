<div class="subastas image-form">
<?php echo $this->Form->create('Subasta');?>
	<fieldset>
 		<legend><?php __('Admin Add Subasta'); ?></legend>
	<?php
		echo $this->Form->input('tipo_subasta_id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
		echo $this->Form->input('imagen_path',array("id"=>"single-field","type"=>"hidden"));
		echo $this->Form->input('valor_actual');
		echo $this->Form->input('umbral_minimo_creditos');
		echo $this->Form->input('dias_espera');
		echo $this->Form->input('contenido_pagina');
		echo $this->Form->input('posicion_en_cola');
		echo $this->Form->input('estado');
		echo $this->Form->input('fecha_inicio_subasta');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
	<div class="images">
			<h2>Imagen</h2>
			<div class="preview">
			</div>
			<div id="single-upload" controller="colecciones"> </div>			
	</div>
</div>