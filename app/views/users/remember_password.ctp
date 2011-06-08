<div id="left-content">
	 <?php //echo $this->element("medio-pago");?>
	 <?php //echo $this->element("ultimo-ganador");?>
	 <?php //echo $this->element("proxima-oferta");?>
	 <?php //echo $this->element("seguridad");?>
	 <?php echo $this->element("social");?>
	 <div style="clear:both"></div>
</div>
<div id="right-content" class="estilo-borde">
	<div class="remember forms">
			<p>
			Por favor ingresa la dirección de correo electrónico con la que te registraste. El sistema te enviará un correo con la contraseña
			</p>
	<?php echo $this->Form->create('User');?>
		<fieldset>
			
		
		<?php
			echo $this->Form->input('email', array('label'=>'Correo electrónico',"value"=>""));
		?>
		</fieldset>
		<?php echo $this->Form->end(__('Enviar', true));?>
		<div style="clear:both;"></div>
		<div class="mensaje"><?php if (isset($mensaje)) echo $mensaje ?></div>
	</div>
</div>