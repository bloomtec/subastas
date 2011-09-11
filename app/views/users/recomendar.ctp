<div id="left-content">
	<?php echo $this -> element("left");?>
</div>
<div id="right-content">
	<div class="recomendar corner">
		<h1 class="titulo-amarillo">Recomendar</h1>
		<h1 class="titleForms">
		Recomienda y obtén
		<br />
		<span>10 créditos </span>
		</h1>
		<div class="form-container">

			<?php echo $this -> Form -> create('User');?>
			<fieldset>

				<?php
				$user = $this -> Session -> read('Auth');
				?>
				<div class="input text">
					<label for="UserCorreoRecomendado1">
						Correo Recomendado 1
					</label>
					<input name="data[User][correo_recomendado_1]" type="text" id="UserCorreoRecomendado1">
				</div>
				<div class="input text">
					<label for="UserCorreoRecomendado2">
						Correo Recomendado 2
					</label>
					<input name="data[User][correo_recomendado_2]" type="text" id="UserCorreoRecomendado2">
				</div>
				<div class="input text">
					<label for="UserCorreoRecomendado3">
						Correo Recomendado 3
					</label>
					<input name="data[User][correo_recomendado_3]" type="text" id="UserCorreoRecomendado3">
				</div>
				<div class="input text">
					<label for="UserCorreoRecomendado4">
						Correo Recomendado 4
					</label>
					<input name="data[User][correo_recomendado_4]" type="text" id="UserCorreoRecomendado4">
				</div>
				<div class="input text">
					<label for="UserCorreoRecomendado5">
						Correo Recomendado 5
					</label>
					<input name="data[User][correo_recomendado_5]" type="text" id="UserCorreoRecomendado5">
				</div>

				<?php echo $this -> Form -> end(__(' ', true));?>
			<div style="clear:both;"></div>
			</div>
			</fieldset>
			<div>
			
		</div>
	</div>

<?php echo $html -> link($html -> image("volver_cuenta.png"), "/users", array("escape" => false, "class" => "volver"));?>
</div>