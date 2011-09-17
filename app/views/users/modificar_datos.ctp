<div id="left-content">
	<?php echo $this -> element("left");?>
</div>
<div id="right-content">
	<div class="corner">
		<h1 class="titulo-amarillo">Mis datos</h1>
		<?php if($user['User']['datos_ingresados'] == 0): ?>
		<h1 class="titleForms">
		Llena todos tus datos y te regalamos
		<br />
		<span> 5 créditos </span>

		<?php endif?>
		<div class="forms">
			
			<?php echo $this -> Form -> create('User');?>

			<fieldset>
				<?php
				echo $this -> Form -> hidden('username', array("disabled" => "disabled", "value" => $user['User']['username']));
				echo $this -> Form -> input('UserField.id');
				echo $this -> Form -> input('UserField.user_id', array("type" => "hidden", "value" => $user['User']['id']));
				echo $this -> Form -> input('UserField.nombres');
				echo $this -> Form -> input('UserField.apellidos');
				echo $this -> Form -> input('UserField.cedula');
				echo $this -> Form -> input('UserField.fecha_de_nacimiento');
				echo $this -> Form -> input('UserField.sexo',array("options"=>array("hombre"=>"Hombre","mujer"=>"Mujer")));
				echo $this -> Form -> hidden('email');
				echo $this -> Form -> input('UserField.direccion', array("type" => "hidden", "value" => $user['User']['email']));
				echo $this -> Form -> input('UserField.direccion', array("label" => "Dirección"));
				echo $this -> Form -> input('UserField.ciudad');
				echo $this -> Form -> input('UserField.telefono_fijo', array("label" => "Teléfono Fijo"));
				echo $this -> Form -> input('UserField.ocupacion', array("label" => "Ocupación"));
		?>
			</fieldset>
			<?php echo $this -> Form -> end(__(' ', true));?>
			<div style="clear:both;"></div>
		</div>
		
	</div>
	<?php echo $html -> link($html -> image("volver_cuenta.png"), "/users", array("escape" => false, "class" => "volver"));?>
</div>