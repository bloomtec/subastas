<?php $config=$this->requestAction("/configs/config");?>
<?php if (!empty($subastas)):?>
 <ul class="subastas-activas index <?php if(!$config["Config"]["congelado"]) echo "activo"?>">
	 <?php $i=0;?>
	 <?php foreach ($subastas as $subasta):?>
	 <li <?php if($i%3==1) echo "class='centro'"?>  id="<?php echo $subasta["Subasta"]["id"]; ?>" title="<?php echo $subasta["Subasta"]["nombre"]; ?>"> 
		<div class="formulario-login-subasta" rel="<?php echo $subasta["Subasta"]["id"]; ?>">
				<div class="cerrar-formulario">cerrar</div>
				<h1>Aún no has iniciado sesión</h1>
				<?php echo $form -> create('User', array("action" => "ajaxLogin", "controller" => "users","id"=>"form".$subasta["Subasta"]["id"],"class"=>"ajax-form"));?>
				<?php echo $form -> input("username", array("label" => "Usuario/Email:","id"=>"username".$subasta["Subasta"]["id"]));?>
				<div style="clear:both">
				</div>
				<?php echo $form -> input("password", array("label" => "Contraseña:","id"=>"password".$subasta["Subasta"]["id"]));?>
				<div style="clear:both">
				</div>
				<span class="error2" style="visibility:hidden;">datos no validos</span>
				<?php echo $form -> end(__(' ', true), array('div' => false));?>
				
				
				<?php echo $html -> link('¿Olvidaste tu contraseña?', array("controller" => "users", "action" => "rememberPassword"), array("id" => "olvidar"));?>
				
				<?php echo $html -> link('Registrate!!! y obtén 10 creditos', array("controller" => "users", "action" => "register"), array("id" => "resaltar-registro"));?>
				<?php echo $html -> link(' ', array("controller" => "users", "action" => "register"), array("id" => "boton-registro"));?>
		</div>
		<div class="fecha_vencimiento">
			<?php 
			 		$fecha= date_create_from_format('Y-m-d H:i:s',	$subasta["Subasta"]["fecha_de_venta"]); 
			 		echo $fecha->format('Y M d H:i:s');
			 	?>
			 </div>
			 <div class="hora_servidor">
			 	<?php 
			 		$gmt = 3600*-5;
					$fecha = gmdate('Y M d H:i:s', time() + $gmt);
			 		echo $fecha;
			 	?>
			 </div>
			 <?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
		 <?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
		 
	     <?php echo $this->Html->para("pvp","Precio Cial. $ ".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
	     <div  rel="<?php echo $subasta["Subasta"]["id"]; ?>">
	     <?php if(!$config["Config"]["congelado"]):?>
	     <p class="contador" id="contador<?php echo $subasta["Subasta"]["id"]?>">
			--:--:--
		 </p>
	     <p class="pvp">Tiempo Para termnar la oferta</p>
	     <?php endif;?>
	     <?php if($config["Config"]["congelado"]):?>
	     	<p class="pvp">La subasta se reanudara a las 8:00 am</p>
	     <?php endif;?>
	     <p class="precio"><?php echo "$ ".number_format($subasta["Subasta"]['precio'], 0, ' ', '.');?><p>
			<?php $ultimaOferta= $this->requestAction("/subastas/ultimaOferta/".$subasta["Subasta"]["id"]);?>
		<p class="ultimo-usuario" rel="<?php if($ultimaOferta) echo $ultimaOferta["Oferta"]["id"];?>">
			<?php if($ultimaOferta) echo "Última oferta ".$ultimaOferta["User"]["username"];?>
		 </p>
	     <?php 
	     	
	     	if(!$config["Config"]["congelado"])
	     		echo $this->Html->link("¡Oferte ya!",array("controller"=>"subastas","action"=>"ofertar",$subasta["Subasta"]['id']),array('class'=>'boton ofertar','rel'=>$subasta["Subasta"]['id']));
			else
				echo $this->Html->link("Pausada","#",array('class'=>'boton pausado'));
	     ?>
	 	<div>
	 </li>
	 <?php 
	 $i++;
	 endforeach; ?>
 </ul>
 <div style="clear:both"></div>
<?php endif; ?>


<?php $proximasSubastas = $this->requestAction('/subastas/proximasSubastas'); ?>
<?php if (!empty($proximasSubastas)):?>
	<ul class="proximas-subastas">
		 <h1 class="titulo-amarillo">Próximas Ofertas<h1>
		 <?php $i=0;?>
		 <?php foreach ($proximasSubastas as $subasta):?>
		 <li <?php if($i%3==1) echo "class='centro'"?> rel="<?php echo $subasta["Subasta"]["id"]; ?>"> 
			 <?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
			 <?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
		     <?php echo $this->Html->para("pvp","PVP $".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
		    
		 </li>
		 <?php 
		 $i++;
		 endforeach; ?>
 	</ul>
 <div style="clear:both"></div>
<?php endif; ?>