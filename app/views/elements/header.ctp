<div class="header_wrap">
	<h1>
	<a href="<?php echo $base_url;?>">Llévatelos.com</a>
	</h1>
	<div class="info">
		<p class="slogan">
			<?php echo $html->image("atrapa.png");?>
		</p>
		<div class="reloj">
			<?php echo $html -> image('reloj.png', array('alt' => 'reloj'));?>
			<div class="plugin-hora">
				<p class="dia">
					Dia
				</p>
				<p class="digitos" name="digitos">
					HH:MM:SS m.m
				</p>
				<p class="fecha">
					DD Mes año
				</p>
			</div>
		</div>
	</div>
	<div style="clear:both">
	</div>
</div>
<div class="contenido_header">
	<?php echo $this -> element("main-nav");?>
	<div class="prueba">
		<div class="banner-falabella">
			
		</div>
		<?php if(!$session->read("Auth.User.id")){
		?>
		<div class="banner-registro">
			<div class="leyenda">
				<p>
					En solo 60 segundos podrás
				</p>
				<strong>ganarte 10 créditos</strong>
				
			</div>
			<?php echo $html -> link("Regístrate gratis", array("controller" => "users", "action" => "register"), array("class" => "registro"));?>
			<?php }else{?>
			<div class="banner-registro" id="banner-compra">
				<div class="leyenda">
					<strong>¿Se te acaban tus creditos?</strong>
					<p>
						Compra mas creditos y aprovecha nuestra ofertas!
					</p>
				</div>
				<?php echo $html -> link("Comprar", array("controller" => "users", "action" => "comprarCreditos"), array("class" => "registro", "id" => "compra-creditos"));?>
				<?php }?>
			</div>
			<div class="login">
				<?php if(!$session->read("Auth.User.id")){
				?>
				<?php echo $form -> create('User', array("action" => "login", "controller" => "users"));?>
				<h1>Mi cuenta</h1>
				<?php echo $form -> input("username", array("label" => "Usuario/Correo:"));?>
				<div style="clear:both">
				</div>
				<?php echo $form -> input("password", array("label" => "Contraseña:"));?>
				<div style="clear:both">
				</div>
				<?php echo $form -> end(__('Ingresar', true), array('div' => false));?>
				<?php echo $html -> link('¿Olvidó su contraseña?', array("controller" => "users", "action" => "rememberPassword"), array("id" => "olvidar"));?>
				<?php }else{?>
				<h2 class="logueado">
				<?php echo $html -> link("Mi cuenta", array("controller" => "users", "action" => "index"));?>
				</h2>
				<div class="logueado">
					<span>Usuario: </span><?php echo $session->read("Auth.User.username")
					?>
				</div>
				<div class="logueado">
					<span>Creditos: </span>
					<span id="creditos">
						<?php echo $this -> requestAction("/users/getCreditos");?>
					</span>
				</div>
				<?php $bonos = $this->requestAction("/users/getBonos"); 
				?>
				<div class="logueado">
					<span>Bonos: </span>
					<span id="bonos">
						<?php echo $bonos;?>
					</span>
				</div>
				<?php echo $html -> link('Salir', array("controller" => "users", "action" => "logout"), array("id" => "olvidar"));?>
				<?php }?>
			</div>
			<div style="clear:both">
			</div>
		</div>

	</div>
