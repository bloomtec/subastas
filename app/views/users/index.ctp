<?php echo $this -> Html -> script("subastas.js"); ?>
<div id="left-content">
	<?php echo $this->element("left");?>
	
</div>
<div id="right-content">
	<div class="corner">
	<h1 class="titulo-amarillo">Mi cuenta</h1>
	<div class="panel mi-cuenta">
		<div class="datos-usuarios">
		<!--	<div class="imagen">
		</div>-->
			<div class="datos">
				<div class="info">
					<p><span>Email: </span><?php echo $user["User"]["email"];?></p>
					<p><span>Nombre de Usuario: </span><?php echo $user["User"]["username"];?></p>
				<div style="clear:both;"></div>
				</div>
				<div class="menu">
					<?php echo $html->link("Mis datos",array("controller"=>"users","action"=>"modificarDatos"),array("escape"=>false));?>
					<?php echo $html->link("Comprar créditos",array("controller"=>"users","action"=>"comprarCreditos"),array("escape"=>false));?>
					<?php echo $html->link("Recomendar",array("controller"=>"users","action"=>"recomendar"),array("escape"=>false));?>
					<?php echo $html->link("Productos Ganados",array("controller"=>"subastas","action"=>"ganadas"),array("escape"=>false));?>
					<?php echo $html->link("Cambiar contraseña",array("controller"=>"users","action"=>"changePassword"),array("escape"=>false));?>
					<div style="clear:both;"></div>
				</div>
			</div>	
			<div class="clear"></div>
		</div>
		<?php if($user['User']['datos_ingresados'] == 0): ?>
		<div class="elemento ingreso-datos">
			<?php //echo $this->element("ingrese-datos"); ?>
		<div style="clear:both;"></div>
		</div>
		<?php endif; ?>
		<?php echo $this->element("subastas-ganadas"); ?>
		<div class="subastas-activas delusuario">
			<h2 class="titulo-amarillo">Mis Ofertas</h2>
			<div class="contenedor-subastas">
				<?php echo $this->element("subastas-activas"); ?>
			</div>
		</div>
	</div>
	
</div>
<?php echo $html->link($html->image("volver_al_inicio.png"),"/",array("escape"=>false,"class"=>"volver"));?>
</div>