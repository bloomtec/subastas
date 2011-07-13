<?php $config=$this->requestAction("/configs/config");?>
<?php if (!empty($subastas)):?>
 <ul class="subastas-activas index <?php if(!$config["Config"]["congelado"]) echo "activo"?>">
	 <?php $i=0;?>
	 <?php foreach ($subastas as $subasta):?>
	 <li <?php if($i%3==1) echo "class='centro'"?>  id="<?php echo $subasta["Subasta"]["id"]; ?>" title="<?php echo $subasta["Subasta"]["nombre"]; ?>"> 
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
		 <?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
		 <?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
	     <?php echo $this->Html->para("pvp","Precio Cial. $ ".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
	     <div  rel="<?php echo $subasta["Subasta"]["id"]; ?>">
	     <?php if(!$config["Config"]["congelado"]):?>
	     <p class="contador" id="contador<?php echo $subasta["Subasta"]["id"]?>"></p>
	     <p class="pvp">Tiempo Para termnar la oferta</p>
	     <?php endif;?>
	     <?php if($config["Config"]["congelado"]):?>
	     	<br />
	     	<p class="pvp">La subasta se reanudara a las 8:00 am</p>
	     	<br />
	     <?php endif;?>
	     <p class="precio"><?php echo "$ ".number_format($subasta["Subasta"]['precio'], 0, ' ', '.');?><p>
	     <p class="ultimo-usuario"> <p>
	     <?php 
	     	
	     	if(!$config["Config"]["congelado"])
	     		echo $this->Html->link("¡Oferte ya!",array("controller"=>"subastas","action"=>"ofertar",$subasta["Subasta"]['id']),array('class'=>'boton ofertar'));
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
		 <h1 class="titulo-amarillo">Próximas subastas<h1>
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