<div id="left-content">
	 <?php echo $this->element("medio-pago");?>
	 <?php echo $this->element("ultimo-ganador");?>
	 <?php echo $this->element("proxima-oferta");?>
	 <?php echo $this->element("seguridad");?>
	 <?php echo $this->element("social");?>
	 <div style="clear:both"></div>
</div>
<div id="right-content" class="estilo-borde">
<?php if (!empty($subastas)):?>
 <ul class="subastas-activas">
	 <?php $i=0;?>
	 <?php foreach ($subastas as $subasta):?>
	 <li class="finalizada"> 
		 <?php echo $this->Html->image($subasta['Subasta']['imagen_path'],array("width"=>"200"))?>
		 <?php echo $this->Html->para("nombre",$subasta["Subasta"]["nombre"]) ?>
	     <?php echo $this->Html->para("pvp","PVP $".number_format($subasta["Subasta"]['valor'], 0, ' ', '.')) ?>
	     <p class="precio"><?php echo $subasta["Subasta"]['valor'];?><p>
	     
	     <?php echo $this->Html->link("¡Oferte ya!",array("controller"=>"subastas","action"=>"ofertar",$subasta["Subasta"]['id']),array('class'=>'boton')) ?>
	 </li>
	 <?php 
	 $i++;
	 endforeach; ?>
 </ul>
 <div style="clear:both"></div>
<?php endif; ?>
<?php if(empty($subastas)): ?>
<div class="mensaje">
	No ha finalizado ninguna subasta finalizada en la que estes registrado
</div>
<?php endif;?>
</div>