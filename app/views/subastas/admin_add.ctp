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
		echo $this->Form->input('valor', array("value" => "0","label"=>"Valor (Valor comercial de la subasta)"));
		echo $this->Form->input('umbral_minimo_creditos', array("value" => "0","label"=>"Cantidad mínima de creditos para subastar"));
		echo $this->Form->input('cantidad_creditos_puja', array("value" => "0","label"=>"Cantidad creditos por puja (se le descontarán al usuario si puja en esta subasta)"));
		echo $this->Form->input('precio', array("value" => "0","label"=>"Precio (El precio inicial de la subasta)"));
		echo $this->Form->input('aumento_precio', array("value" => "0","label"=>"Valor aumento de precio (Valor que se le aumentará al precio cada vez que se haga una subasta)"));
		echo $this->Form->input('dias_espera', array("value" => "8","label"=>"Días de espera (Días que se esperará el usuario para que pague la subasta)"));
		echo $this->Form->hidden('estados_subasta_id', array("value" => "2"));
		echo $this->Form->hidden('imagen_path', array("id"=>"single-field"));
		echo $this->Form->hidden('posicion_en_cola', array("value" => "-1"));
		echo $this->Form->hidden('fecha_de_venta',array("value" => null, "label"=>"Fecha de Venta (Fecha en la que terminará la subasta si alcanza el umbral mínimo de creditos, si no lo alcanza se cancelará la subasta)"));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>