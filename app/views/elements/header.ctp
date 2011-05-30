<div class="header_wrap">
	<h1><a href="<?php echo $base_url;?>">Llevatelos.com</a></h1>
	<div class="info">
		<p class="slogan">Lo que más deseas el <strong>15%</strong> del precio comercial</p>
		<div class="reloj">
			<?php echo $html->image('reloj.png', array('alt' => 'reloj')); ?>
			<div class="plugin-hora">
				<p class="dia">Dia</p>
				<p class="hora">HH:MM:SS m.m</p>
				<p class="fecha">DD Mes año</p>
			</div>
		</div>
	</div>	
	<div style="clear:both"></div>
</div>
<div class="contenido_header">
	
	<?php echo $this->element("main-nav");?>
	<div class="prueba">
	<div class="banner-falabella">
			<?php echo $html->image('falabella.png', array('alt' => 'falabella')); ?>
			<p> <strong>Todos</strong> los productos de llévatelos.com tienen la garantía de falabella</p>
	</div>
	<div class="banner-registro">
		<?php if(!$session->read("Auth.User.id")){?>
		<div class="leyenda">
			<strong>¿Aún no eres miembro?</strong>
			<p>Házlo en menos de 60 segundos</p>
		</div>
			<?php echo $html->link("Registrate",array("controller"=>"users","action"=>"register"),array("class"=>"registro"));?>
		<?php }else{?>
			<div class="leyenda">
			<strong>¿Se te acaban tus creditos?</strong>
			<p>Compra mas creditos y aprovecha nuestra ofertas!</p>
		</div>
			<?php echo $html->link("Comprar",array("controller"=>"users","action"=>"comprarCreditos"),array("class"=>"registro"));?>
		<?php }?>
	</div>
	<div class="login">
		 
		<?php if(!$session->read("Auth.User.id")){?>
		 <?php echo $form->create("User",array("action"=>"login","controller"=>"users"));?>
        <h1>Mi cuenta</h1>
         <?php echo $form->input("email",array("label"=>"Usuario:"));?>
         <div style="clear:both"></div>   
         <?php echo $form->input("password",array("label"=>"Contraseña:"));?>
         <div style="clear:both"></div>
         <?php echo $form->end(__('Ingresar', true), array('div' => false));?> 
         <?php echo $html->link('¿Olvidó su contraseña?',array("controller"=>"users","action"=>"rememberPassword"), array("id"=>"olvidar"));?>  
		<?php }else{ ?>
			<h2 class="logueado"><?php echo $html->link("Mi cuenta",array("controller"=>"users","action"=>"index"));?></h2>
			<div class="logueado"><span>Usuario: </span><?php echo $session->read("Auth.User.username")?></div>
			<div class="logueado"><span>Creditos: </span><?php echo $this->requestAction("/users/getCreditos"); ?></div>
			<?php echo $html->link('Salir',array("controller"=>"users","action"=>"logout"), array("id"=>"olvidar"));?>  
		<?php }?>
	</div>
	<div style="clear:both"></div>
	</div>

</div>
