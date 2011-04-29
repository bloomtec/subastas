<div id="content_wrap">
	<div class="remember form">
	<?php echo $this->Form->create('User');?>
		<fieldset>
			<p>
			Por favor ingrese la dirección de correo electrónico con la que te registraste. El sistema te enviará un correo con la contraseña
			</p>
		
		<?php
			echo $this->Form->input('email', array('label'=>'Correo electrónico',"value"=>""));
		?>
		</fieldset>
		<?php echo $this->Form->end(__('Enviar', true));?>
		<div style="clear:both;"></div>
		<div class="mensaje"><?php if (isset($mensaje)) echo $mensaje ?></div>
	</div>
</div>