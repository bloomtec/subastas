<div id="left-content">
	 <?php //echo $this->element("medio-pago");?>
	 <?php echo $this->element("ultimo-ganador");?>
	 <?php //echo $this->element("proxima-oferta");?>
	 <?php //echo $this->element("seguridad");?>
	 <?php //echo $this->element("social");?>
	 <div style="clear:both"></div>
</div>
<div id="right-content" class="estilo-borde">
	<div class="login usurios forms">
		<h1> <?php __("Ingrese su Nombre y contraseña")?> </h1>
		<?php echo $session->flash('auth'); ?>
		<?php echo $this->Form->create('User');?>
		<fieldset>
		<?php
			echo $this->Form->input('username', array('label'=>'Usuario / Correo'));
			echo $this->Form->input('password',array('type'=>'password'));
			//echo $this->Form->input('rol',array('type'=>'hidden','value'=>'x'));
		?>
		</fieldset>
		<?php echo $this->Form->end(__('Ingresar', true));?>
	</div>
</div>