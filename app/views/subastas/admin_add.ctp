<div class="subastas image-form">
<?php echo $this->Form->create('Subasta');?>
	<fieldset>
 		<legend><?php __('Añadir Subasta'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
		echo $this->Form->input('tipo_subasta_id');
		echo $this->Form->input('valor');
		echo $this->Form->input('umbral_minimo_creditos');
		echo $this->Form->input('posicion_en_cola', array("type" => "hidden"));
		echo $this->Form->input('estado_id', array("type" => "hidden"));
		echo $this->Form->input('imagen_path',array("id"=>"single-field","type"=>"hidden"));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
	<div class="images">
			<h2>Imagen</h2>
			<div class="preview">
			</div>
			<div id="single-upload" controller="subastas"> </div>			
	</div>
</div>