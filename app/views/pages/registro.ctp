<div id="registro_wrap">
	<div id="registro">
		<h1>INICIA SESIÓN O CREA UNA CUENTA</h1>
		<div class="registro-izquierda">
			<h2>Nuevos Clientes PriceShoes</h2>
			<p>Al crear una cuenta en nuestra tienda, usted será podrá moverse a través del proceso de pago más rápido, guardar múltiples direcciones para sus envíos, ver y guardar sus favoritos y mas.</p>
			<div class="espacio-crear">
				<?php echo $html->link('Crear',array("controller"=>"pages","action"=>"crear_usuario"), array("id"=>"crear"));?>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div class="registro-derecha">
			<h2>Clientes PriceShoes</h2>
			<?php echo $form->create("usurio",array("action"=>"login","controller"=>"users"));?>
			<p>Sí ya dispone de una cuenta con nosotros por favor ingrese sus datos.</p>
				<?php echo $form->input("email",array('div' => 'email-login',"label"=>"Dirección E-mail"));?>
				<?php echo $form->input("password",array('div' => 'password-login',"label"=>"Contraseña"));?>
				<div style="clear:both"></div>
				<div class="espacio-ingresar">
	            <?php echo $html->link('¿Olvidó su contraseña?',array("controller"=>"users","action"=>"olvidar"), array("id"=>"olvidar"));?>  
	            <?php echo $form->end(__('Ingresar', true), array('div' => false));?> 
	            <div style="clear:both;"></div>
				</div>
				<div style="clear:both;"></div>
				
		</div>
		<div style="clear:both;"></div>
	</div>
</div>
