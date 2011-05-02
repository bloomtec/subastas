<div>
<?php echo $this->Form->create('Testimonio');?>
	<fieldset>
 		<legend><?php __('Ingrese Su Testimonio'); ?></legend>
		<?php
			echo $this->Form->input('titulo', array('label'=>'Título'));
			echo $this->Form->input('texto', array('label'=>'Descripción'));
			echo $this->Form->hidden('imagen_path', array('id'=>'single-field'));
		?>
		<div class="images">
			<h2>Imagen</h2>
			<div class="preview">
			</div>
			<div id="single-upload" controller="subastas"> </div>			
		</div>
	</fieldset>
	<?php echo $this->Form->end(__('Enviar', true));?>
</div>