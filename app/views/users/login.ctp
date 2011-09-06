<div id="left-content">
	 <?php echo $this->element("left");?>
</div>
<div id="right-content">
	
	<div class="corner">
		<h1 class="titulo-amarillo" >Iniciar sesión</h1>
		<br>
		<h1  style="margin-left:38px;"> <?php __("Ingrese su Nombre y contraseña")?> </h1>
		
	<div class="login usurios forms">
		
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
			echo $this -> Form -> end(' ');
			
		?>
		<div style="clear:both;"></div>	
		<br />
		<?php echo $session->flash(); ?>
	</div>
	</div>
	<?php echo $html -> link($html -> image("volver_inicio.png"), "/", array("escape" => false, "class" => "volver"));?>
</div>