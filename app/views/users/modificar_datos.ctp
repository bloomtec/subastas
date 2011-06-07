<div id="left-content">
	 <?php echo $this->element("medio-pago");?>
	 <?php echo $this->element("ultimo-ganador");?>
	 <?php echo $this->element("proxima-oferta");?>
	 <?php echo $this->element("seguridad");?>
	 <?php //echo $this->element("social");?>
	 <div style="clear:both"></div>
</div>
<div id="right-content" class="estilo-borde">
	<div class="forms">
	<?php echo $this->Form->create('User');?>
		<fieldset>
			<legend><?php __('Mis Datos'); ?></legend>
		<?php
			echo $this->Form->input('username',array("disabled"=>"disabled"));
			echo $this->Form->input('UserField.id');
			echo $this->Form->input('UserField.user_id',array("type"=>"hidden"));
			echo $this->Form->input('UserField.nombres');
			echo $this->Form->input('UserField.apellidos');
			echo $this->Form->input('UserField.cedula');
			echo $this->Form->input('UserField.fecha_de_nacimiento');
			echo $this->Form->input('UserField.sexo');
			echo $this->Form->input('email');
			echo $this->Form->input('UserField.direccion',array("label"=>"Dirección"));
			echo $this->Form->input('UserField.ciudad');
			echo $this->Form->input('UserField.telefono_fijo',array("label"=>"Teléfono Fijo"));
			echo $this->Form->input('UserField.ocupacion',array("label"=>"Ocupación"));
			echo $this->Form->input('UserField.lugar_ocupacion',array("label"=>"Lugar Ocupación"));
		?>
		</fieldset>
	<?php echo $this->Form->end(__('guardar', true));?>
	</div>
</div>