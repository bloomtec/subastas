<div id="left-content">
	<?php echo $this -> element("left");?>
</div>
<div id="right-content" class="cambiar-contrasena">
	<div class="corner">
		<h1 class="titulo-amarillo">Cambiar Contraseña</h1>
		<br>
		<h1 style="margin-left:38px;">Por favor ingrese su  contraseña actual y su nueva contraseña</h1>
		<div id="crear-usuario" class="forms">
			<?php echo $this -> Form -> create('User');?>
			<fieldset>

				<?php
				echo $this -> Form -> input('actualPassword', array('label' => 'Contraseña Actual', "required" => "required", "div" => "forma-linea required", "type" => "password"));
				echo $this -> Form -> input('password', array('label' => 'Contraseña Nueva', "required" => "required", "id" => "Contraseñas"));
				echo $this -> Form -> input('password2', array('label' => 'Confirmar Contraseña', "div" => "required forma-linea", "required" => "required", "data-equals" => "Contraseñas", "type" => "password", "data-message" => "Por favor verifique este campo"));
				?>
			</fieldset>
			<?php echo $this -> Form -> end(__(' ', true));?>
			<div style="clear:both;">
			</div>
			<div class="mensaje">
				<?php if (isset($mensaje)) echo $mensaje ?>
			</div>
		</div>
	</div>
	<?php echo $html -> link($html -> image("volver_cuenta.png"), "/users", array("escape" => false, "class" => "volver"));?>
</div>
<script type="text/javascript">
	$( function() {
		$("form").validator({
			lang: 'es',
			'position':'bottom right'
		}).submit( function(e) {
			var form = $(this);
			if (!e.isDefaultPrevented()) {

				// submit with AJAX
				$.getJSON(server+"users/checkPassword?" + form.serialize(), function(json) {

					// everything is ok. (server returned true)
					if (json === true) {
						//form.load(form.attr("action"));

						location.href=server+"users/index/";

						// server-side validation failed. use invalidate() to show errors
					} else {
						form.data("validator").invalidate(json);
					}
				});
				// prevent default form submission logic
				e.preventDefault();
			}
		});
	});
</script>