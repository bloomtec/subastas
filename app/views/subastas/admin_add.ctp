<div>
<?php echo $this->Form->create('Subasta');?>
	<fieldset>
 		<legend><?php __('Añadir Subasta'); ?></legend>
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
		echo $this->Form->input('cantidad_creditos_puja', array("value" => "0"));
		echo $this->Form->input('precio', array("value" => "0"));
		echo $this->Form->input('aumento_creditos', array("value" => "0"));
		echo $this->Form->input('fecha_de_venta');
		echo $this->Form->input('dias_espera', array("value" => "0"));
		echo $this->Form->input('estados_subasta_id', array("type"=>"hidden", "value" => "1"));
		echo $this->Form->input('imagen_path', array("id"=>"single-field","type"=>"hidden"));
		echo $this->Form->input('posicion_en_cola', array("type" => "hidden", "value" => "-1"));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>