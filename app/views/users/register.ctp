<div id="left-content">
	<?php echo $this -> element("medio-pago");?>
	<?php echo $this -> element("ultimo-ganador");?>
	<?php echo $this -> element("proxima-oferta");?>
	<?php echo $this -> element("seguridad");?>
	<?php echo $this -> element("social");?>
	<div style="clear:both">
	</div>
</div>
<div id="right-content">
	<div class="registro corner">
		<h1 class="titulo-amarillo">Subastas activas</h1>
		<div class="form-container">
			<?php echo $html->image("5_creditos.png");?>
			<?php echo $form -> create("User", array("action" => "register", "id" => "registerForm", "novalidate" => "novalidate"));
			echo "<fieldset>";
			echo $form -> input("username", array("div" => "input text required", "label" => "Nombre de usuario:", "autofocus" => "autofocus"));
			?>
			<div class="input text required">
				<label for="UserEmail">
					Email:
				</label>
				<input type="email" id="UserEmail" maxlength="45" name="data[User][email]" required="required">
			</div>
			<?php
			echo $form -> input("password", array("div" => "input required", "required" => "required", "id" => "password", "label" => "Contraseña:"));
			echo $form -> input("password2", array("div" => "input required", "required" => "required", "id" => "password2", "type" => "password", "label" => "Confirmar Contraseña:", "data-equals" => "password", "data-message" => "Verificar contraseña"));
			//echo $form -> input("UserField.nombres",array("required"=>"required","div"=>"input required text"));
			//echo $form -> input("UserField.apellidos");
			?>

			<div class="input text required">
				<label for="UserEmail">
					Confirmar email:
				</label>
				<input type="email" id="UserEmailConfirm" maxlength="45" name="data[User][email-confirm]" required="required" data-equals="UserEmail" data-message="Verificar correo electrónico"));>
			</div>
			<?php
			//echo $form->input("UserField.fecha_de_nacimiento",array("minYear"=>date('Y') - 70));
			if(isset($email_referente)) {
				echo $form -> hidden("referido_por", array('value' => $email_referente));
			} else {
				echo $form -> input("referido_por", array("placeholder" => "Ingresa el email de quién te refirió","label"=>"Referido por:"));
			}
			echo "<div class='layer'>";
			echo $form -> checkbox("confirmacion", array("required" => "required"));
			echo "<label>Acepto los " . $this -> Html -> link("términos y condiciones", array("controller" => "pages", "action" => "view", "terminos-condiciones"))." de llévatelos.com  </label>";
			echo "</div>";
			echo $form -> end(" ");
			echo "</fieldset>";

			
			?>
			<div style="clear:both">
			</div>
		</div>
	</div>
	<?php echo $html->link($html->image("volver_al_inicio.png"),"/",array("escape"=>false,"class"=>"volver"));?>
</div>