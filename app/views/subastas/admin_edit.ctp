<div>
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
		echo $this->Form->input('valor',array("label"=>"Valor (Valor comercial de la subasta)"));
		echo $this->Form->input('umbral_minimo_creditos',array("label"=>"Cantidad mínima de creditos para subastar"));
		echo $this->Form->input('cantidad_creditos_puja',array("label"=>"Cantidad creditos por puja (se le descontarán al usuario si puja en esta subasta)"));
		echo $this->Form->input('precio',array("label"=>"Precio (El precio inicial de la subasta)"));
		echo $this->Form->input('aumento_precio',array("label"=>"Valor aumento de precio (Valor que se le aumentará al precio cada vez que se haga una subasta)"));
		echo $this->Form->input('fecha_de_venta',array("label"=>"Fecha de Venta (Fecha en la que terminará la subasta si alcanza el umbral mínimo de creditos, si no lo alcanza se cancelará la subasta)"));
		echo $this->Form->input('dias_espera',array("label"=>"Días de espera (Días que se esperará el usuario para que pague la subasta)"));
    echo $this->Form->input('estados_subasta_id');
		echo $this->Form->input('posicion_en_cola');
		echo $this->Form->input('imagen_path',array("id"=>"single-field","type"=>"hidden"));
	?>
	</fieldset>
	<?php echo $this->Form->end(__('Enviar', true));?>
</div>