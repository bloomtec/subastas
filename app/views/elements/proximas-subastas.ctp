<?php $proximasSubastas = $this->requestAction('/subastas/proximasSubastas'); ?>
<?php $proximasSubastas = $subastas; //QUITAR ESTO******************************?>
<?php $config=$this->requestAction("/configs/config");?>
 <h1 class="titulo-amarillo">Próximas Ofertas </h1>
<?php if (!empty($proximasSubastas)):?>
	<ul class="proximas-subastas index">
	 <?php $i=0;
	 		$last=1;
			$first=0;
	 ?>
	 <?php foreach ($subastas as $subasta):?>
	 <li <?php if($last++==4){ echo "class='last'"; $last=1;}?> <?php if($last==2) echo "class='first'"?>  id="<?php echo $subasta["Subasta"]["id"]; ?>" title="<?php echo $subasta["Subasta"]["nombre"]; ?>"> 
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