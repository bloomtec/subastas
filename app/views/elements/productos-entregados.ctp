<?php $config=$this->requestAction("/configs/config");?>
<?php //$subastas=$this->requestAction("/subastas/entregados");?>

<h1 class="titulo-amarillo" style="color:white; background:url(../img/trama-verde.png) repeat-x scroll 0 0 transparent">Productos Entregados</h1>
<?php if (!empty($subastas)):?>
 <ul class="productos-entregados index" id="subastas-vendidas">
	 <?php $i=0;
	 		$last=1;
			$first=0;
	 ?>
	 <?php foreach ($subastas as $subasta):?>
	 <li <?php if($last++==4){ echo "class='last'"; $last=1;}?> <?php if($last==2) echo "class='first'"?>  id="<?php echo $subasta["Subasta"]["id"]; ?>" title="<?php echo $subasta["Subasta"]["nombre"]; ?>"> 
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
			Próximamente
		 </p>
	
	     <?php endif;?>

	     <p class="precio" title="pesos colombianos"><?php echo "$ ".number_format($subasta["Subasta"]['precio'], 0, ' ', '.');?><p>
			<?php $ultimaOferta= $this->requestAction("/subastas/ultimaOferta/".$subasta["Subasta"]["id"]);?>
		<p class="ultimo-usuario" rel="<?php if($ultimaOferta) echo $ultimaOferta["Oferta"]["id"];?>">
			Ofertante
		 </p>
	     <?php 
	     	
	     	if(!$config["Config"]["congelado"])
	     		echo $this->Html->link("En espera",array("controller"=>"subastas","action"=>"ofertar",$subasta["Subasta"]['id']),array('class'=>'boton ofertar','rel'=>$subasta["Subasta"]['id']));
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