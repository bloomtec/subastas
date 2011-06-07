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
		
		<?php echo $this -> Form -> create(array('action' => 'login'));
			echo $this -> Form -> inputs(
				array(
					'legend' => '',
					'username' => array(
									'label' => 'Usuario / Correo'
								),
					'password' => array(
									'label' => 'Contraseña'
								),
				)
			);
			echo $this -> Form -> end('Ingresar');
			
		?>
		<div style="clear:both;"></div>	
		<br />
		<?php echo $session->flash(); ?>
	</div>
	
</div>