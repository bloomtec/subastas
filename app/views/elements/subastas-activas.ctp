<?php $subastas=$this->requestAction("/subastas/subastasActivas");?>
<?php if (!empty($subastas)):?>
 <ul class="subastas-activas " id="user-subastas">
	 <?php $i=0;?>
	 <?php foreach ($subastas as $subasta):?>
	<li <?php if($i%3==1) echo "class='centro'"?>  rel="<?php echo $subasta["Subasta"]["id"]; ?>">
		<div class="imagen">
			<?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200")); ?>
			<?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]); ?>
		</div>
		<div class="ofertas">
				<?php $ofertas=$this->requestAction("/ofertas/getOfertas/".$subasta["Subasta"]["id"]); ?>
				<?php foreach($ofertas as $oferta):?>
					<div <?php if($i==0) echo "class='actualizado'" ?> ><?php echo $oferta["Oferta"]["created"]?></div>
				<?php endforeach;?>
		</div>
		<div class="acciones-ofertas" rel="<?php echo $subasta["Subasta"]["id"]; ?>">
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
			 <?php echo $this->Html->para("pvp","PVP $".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
		     <p class="contador">00</p>
		     <p class="precio"><?php echo "$".number_format($subasta["Subasta"]['precio'], 0, ' ', '.') ?><p>
		     <p class="ultimo-usuario"><p>
		     <?php echo $this->Html->link("¡Oferte ya!",array("controller"=>"subastas","action"=>"ofertar",$subasta["Subasta"]['id']),array('class'=>'boton ofertar')) ?>
		</div>
	 </li>
	 <?php 
	 $i++;
	 endforeach; ?>
 </ul>
 <div style="clear:both"></div>
<?php endif; ?>
<?php if(empty($subastas)): ?>
<div class="mensaje">
	No ha realizado ninguna subasta
</div>
<?php endif;?>