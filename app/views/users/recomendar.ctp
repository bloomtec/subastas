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
				echo $this -> Form -> input('user_id', array('type' => 'hidden', 'value' => $user['User']['id']));
				echo $this -> Form -> input('correo_recomendado_1');
				echo $this -> Form -> input('correo_recomendado_2');
				echo $this -> Form -> input('correo_recomendado_3');
				echo $this -> Form -> input('correo_recomendado_4');
				echo $this -> Form -> input('correo_recomendado_5');
				?>
				<?php echo $this -> Form -> end(__(' ', true));?>
			<div style="clear:both;"></div>
			</div>
			</fieldset>
			<div>
			
		</div>
	</div>

<?php echo $html -> link($html -> image("volver_cuenta.png"), "/users", array("escape" => false, "class" => "volver"));?>
</div>