<div class="form2">
<?php echo $this->Form->create('Subasta');?>
	<fieldset>
 		<legend><?php __('Añadir Subasta'); ?></legend>
	<?php
		echo $this->Form->input('tipo_subasta_id', array("value" => "1"));
		echo $this->Form->input('nombre');
		echo $this->Form->input('descripcion');
	?>
	<div class="smalls">
	<?php
		
		echo $this->Form->input('valor', array("value" => "0","label"=>"Valor (Valor comercial)"));
		echo $this->Form->input('umbral_minimo_creditos', array("value" => "1","label"=>"Cantidad mínima de creditos para subastar"));
		echo $this->Form->input('cantidad_creditos_puja', array("value" => "1","label"=>"Cantidad creditos a descontars"));
		echo $this->Form->input('iva', array("value" => "0","label"=>"% De I.V.A. (Por ejemplo: 16)"));
		echo $this->Form->input('precio', array("value" => "0","label"=>"Precio (El precio inicial de la subasta)"));
		echo $this->Form->input('aumento_precio', array("value" => "20","label"=>"Valor que se le aumento al precio"));
		echo $this->Form->input('dias_espera', array("value" => "8","label"=>"Días que se esperará el usuario para que pague la subasta"));
		echo $this->Form->input('duracion_inicial', array("value" => "59", "label" => "Duración inicial de la subasta en minutos)"));
		echo $this->Form->input('aumento_duracion', array("value" => "20", "label" => "Aumento a la duración en segundos"));
		echo $this->Form->hidden('estados_subasta_id', array("value" => "2"));
		echo $this->Form->hidden('imagen_path', array("id"=>"single-field","value"=>"jugador_lateral.png"));
		echo $this->Form->hidden('posicion_en_cola', array("value" => "-1"));
	?>
	</div>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>
<div class="images">
		<h2>Imagen</h2>
		<div class="wrapper">
			<div class="preview">
			</div>
		</div>
		<div id="single-upload" controller="subastas"> </div>			
	</div>