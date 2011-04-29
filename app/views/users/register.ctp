<div class="register usuarios">
	<?php echo $form -> create("User", array("action" => "register","id"=>"registerForm"));
	$datos = explode("/", $_GET['url']);
	if(isset($datos['2']) & !empty($datos['2'])) {
		echo $form -> input("Recomendado.id", array('type' => 'hidden', 'value' => $datos['2']));
	}
	echo $form -> input("UserField.nombre");
	echo $form -> input("UserField.apellido");
	//echo $form -> input("username",array("type"=>"hidden","value"=>"web"));
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