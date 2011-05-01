<div id="left-content">
	 <?php echo $this->element("medio-pago");?>
	 <?php //echo $this->element("ultimo-ganador");?>
	 <?php //echo $this->element("proxima-oferta");?>
	 <?php echo $this->element("seguridad");?>
	 <?php //echo $this->element("social");?>
	 <div style="clear:both"></div>
</div>
<div id="right-content" class="estilo-borde">
	<div class="register usuarios   forms">
		<h2>Registrate YA!!!</h2>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
		</p>
		<?php echo $form -> create("User", array("action" => "register","id"=>"registerForm"));
		$datos = explode("/", $_GET['url']);
		if(isset($datos['2']) & !empty($datos['2'])) {
			echo $form -> input("Recomendado.id", array('type' => 'hidden', 'value' => $datos['2']));
		}
		echo $form -> input("UserField.nombres");
		echo $form -> input("UserField.apellidos");
		echo $form -> input("username",array("div"=>"input text required","value"=>"web","label"=>"Nombre de usuario"));
		?>
		<div class="input text required">
			<label for="UserEmail">Email</label>
			<input type="email" id="UserEmail" maxlength="45" name="data[User][email]">
		</div>
		<?php
		echo $form -> input("password");
		echo $form -> end("Guardar");
		?>
	</div>
</div>