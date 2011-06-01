<div id="left-content">
	 <?php echo $this->element("medio-pago");?>
	 <?php echo $this->element("ultimo-ganador");?>
	 <?php echo $this->element("proxima-oferta");?>
	 <?php echo $this->element("seguridad");?>
	 <?php echo $this->element("social");?>
	 <div style="clear:both"></div>
</div>
<div id="right-content" class="estilo-borde">
	<div class="panel index">
		<div class="datos-usuarios">
		<!--	<div class="imagen">
		</div>-->
			<div class="datos">
				<div class="info">
					<p><span>Nombres: </span><?php echo $user["UserField"]["nombres"];?></p>
					<p></p><span>Apellidos: </span><?php echo $user["UserField"]["apellidos"];?></p>
					<p><span>Email: </span><?php echo $user["User"]["email"];?></p>
					<p><span>Nombre de Usuario: </span><?php echo $user["User"]["username"];?></p>
				</div>
				<div class="menu">
					<?php echo $html->link("cambiar contraseña",array("controller"=>"users","action"=>"changePassword"));?>
					<?php echo $html->link("mis datos",array("controller"=>"users","action"=>"modificarDatos"));?>
					<?php echo $html->link("subastas finalizadas",array("controller"=>"subastas","action"=>"finalizadas"));?>
					<?php echo $html->link("subastas ganadas",array("controller"=>"subastas","action"=>"ganadas"));?>
					<?php echo $html->link("comprar creditos",array("controller"=>"users","action"=>"comprarCreditos"));?>
					<div style="clear:both;"></div>
				</div>
			</div>	
			<div class="clear"></div>
		</div>

		<div class="subastas-activas">
			<h2>Subastas Activas</h2>
			<div class="contenedor-subastas">
				<?php echo $this->element("subastas-activas"); ?>
			</div>
		</div>
	</div>
</div>