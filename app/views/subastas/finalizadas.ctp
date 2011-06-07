<div id="left-content">
	 <?php echo $this->element("medio-pago");?>
	 <?php echo $this->element("ultimo-ganador");?>
	 <?php echo $this->element("proxima-oferta");?>
	 <?php echo $this->element("seguridad");?>
	 <?php echo $this->element("social");?>
	 <div style="clear:both"></div>
</div>
<div id="right-content">
	<h1 class="titulo-amarillo">Subastas Finalizadas</h1>
<?php if (!empty($subastas)):?>
 <ul class="subastas-activas index" id="subastas-vendidas">
	 <?php $i=0;?>
	 <?php foreach ($subastas as $subasta):?>
	 <li <?php if($i%3==1) echo "class='centro'"?>  rel="<?php echo $subasta["Subasta"]["id"]; ?>"> 
		  <div class="mascara"></div>
		  <div class="fecha_vencimiento">
			 	<?php 
			 		$fecha= date_create_from_format('Y-m-d H:i:s',	$subasta["Subasta"]["fecha_de_venta"]); 
			 		echo $fecha->format('Y M d H:i:s');
			 	?>
			 </div>
			 <div class="hora_servidor">
			 	<?php 
			 		$fecha= date("Y M d H:i:s",strtotime("now")); 
			 		echo $fecha;
			 	?>
			 </div>
		 <?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
		 <?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
	     <?php echo $this->Html->para("pvp","PVP $".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
	 
	     <?php echo $this->Html->link("¡Entregado!",("#"),array('class'=>'boton',"id"=>"vendido")) ?>
	 </li>
	 <?php 
	 $i++;
	 endforeach; ?>
 </ul>
 <div style="clear:both"></div>
<?php endif; ?>



</div>