<div class="login usurios">
	<h1> <?php __("Ingrese su Nombre y contraseña")?> </h1>
	<?php echo $session->flash('auth'); ?>
	<?php echo $this->Form->create('User');?>
	<fieldset>
	<?php
		echo $this->Form->input('email', array('label'=>'Usuario'));
		echo $this->Form->input('password',array('type'=>'password'));
		//echo $this->Form->input('rol',array('type'=>'hidden','value'=>'x'));
	?>
	</fieldset>
	<?php echo $this->Form->end(__('Ingresar', true));?>
</div>
