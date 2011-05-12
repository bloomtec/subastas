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
		echo $this->Form->input('valor');
		echo $this->Form->input('umbral_minimo_creditos');
		echo $this->Form->input('cantidad_creditos_puja');
		echo $this->Form->input('precio');
		echo $this->Form->input('aumento_creditos');
		echo $this->Form->input('dias_espera');
		echo $this->Form->input('posicion_en_cola');
		echo $this->Form->input('fecha_de_venta');
		echo $this->Form->input('estados_subasta_id');
		echo $this->Form->input('imagen_path',array("id"=>"single-field","type"=>"hidden"));
	?>
	</fieldset>
	<?php echo $this->Form->end(__('Enviar', true));?>
</div>